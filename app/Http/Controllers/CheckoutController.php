<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page with order summary.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $items = [];
        $subtotal = 0;

        // Bulk load products and variants to prevent N+1 queries
        $productIds = array_column($cart, 'product_id');
        $variantIds = array_filter(array_column($cart, 'variant_id'));
        
        $products = \App\Models\Product::whereIn('id', $productIds)->get()->keyBy('id');
        $variants = !empty($variantIds) ? \App\Models\ProductVariant::whereIn('id', $variantIds)->get()->keyBy('id') : collect();

        \Log::info('Loaded products/variants for checkout', [
            'product_count' => count($products),
            'variant_count' => count($variants),
            'product_ids' => $productIds,
            'variant_ids' => $variantIds,
        ]);

        // Reconstruct cart items with product details
        foreach ($cart as $key => $item) {
            $product = $products->get($item['product_id']);
            $variant = $item['variant_id'] ? $variants->get($item['variant_id']) : null;

            if ($product) {
                $price = $variant ? $variant->getFinalPrice() : $product->base_price;
                $item_total = $price * $item['quantity'];
                $subtotal += $item_total;

                $items[] = [
                    'key' => $key,
                    'product' => $product,
                    'variant' => $variant,
                    'price' => $price,
                    'quantity' => $item['quantity'],
                    'total' => $item_total,
                ];
            }
        }

        $total = $subtotal;

        return view('checkout.index', [
            'items' => $items,
            'subtotal' => $subtotal,
            'total' => $total,
        ]);
    }

    /**
     * Process the checkout and create an order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Debug logging
        \Log::info('Checkout POST received', [
            'request_all' => $request->all(),
            'session_id' => session()->getId(),
            'user_id' => auth()->id(),
            'cart_before' => session()->get('cart', []),
        ]);

        $validated = $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        // Start with session cart but prefer the form-submitted cart_payload when present
        $cart = session()->get('cart', []);

        if ($request->filled('cart_payload')) {
            try {
                $decoded = json_decode($request->input('cart_payload'), true);
                if (is_array($decoded) && count($decoded) > 0) {
                    $cart = $decoded;
                    \Log::info('Using cart_payload explicitly for checkout', ['cart_count' => count($cart)]);
                } else {
                    \Log::warning('cart_payload present but invalid (empty/invalid json)', ['payload_sample' => substr($request->input('cart_payload'), 0, 500)]);
                }
            } catch (\Throwable $e) {
                \Log::error('Failed to decode cart_payload', ['error' => $e->getMessage()]);
            }
        }

        // More debug logging
        \Log::info('Cart retrieved', [
            'cart' => $cart,
            'cart_count' => count($cart),
        ]);

        if (empty($cart)) {
            \Log::warning('Cart is empty in checkout');
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $subtotal = 0;
        $order_items = [];

        // Bulk load products and variants to prevent N+1 queries
        $productIds = array_column($cart, 'product_id');
        $variantIds = array_filter(array_column($cart, 'variant_id'));
        
        $products = \App\Models\Product::whereIn('id', $productIds)->get()->keyBy('id');
        $variants = !empty($variantIds) ? \App\Models\ProductVariant::whereIn('id', $variantIds)->get()->keyBy('id') : collect();

        // Calculate totals and prepare order items
        try {
            foreach ($cart as $item) {
                \Log::info('Processing cart item', ['item' => $item]);
                $product = $products->get($item['product_id']);
                $variant = $item['variant_id'] ? $variants->get($item['variant_id']) : null;

                if (!$product) {
                    \Log::warning('Product not found in cart', ['product_id' => $item['product_id']]);
                    return redirect()->route('cart.index')
                        ->with('error', 'One of the products in your cart is no longer available. Please remove it and try again.');
                }

                if ($product) {
                // Validate stock availability
                $availableStock = $variant ? $variant->stock_quantity : $product->current_stock;
                \Log::info('Stock check for checkout item', ['product_id' => $product->id, 'variant_id' => $item['variant_id'] ?? null, 'available_stock' => $availableStock, 'requested' => $item['quantity']]);
                    // Only enforce stock when availableStock is explicitly set (not null)
                    if (!is_null($availableStock) && $availableStock < $item['quantity']) {
                        \Log::warning('Insufficient stock during checkout', ['product' => $product->id, 'available' => $availableStock, 'requested' => $item['quantity']]);
                        return redirect()->route('cart.index')
                            ->with('error', "Insufficient stock for {$product->name}. Only {$availableStock} available.");
                    } elseif (is_null($availableStock)) {
                        \Log::info('No stock limit set for item — allowing checkout to proceed', ['product' => $product->id, 'variant' => $item['variant_id'] ?? null]);
                    }

                $price = $variant ? $variant->getFinalPrice() : $product->base_price;
                $item_total = $price * $item['quantity'];
                $subtotal += $item_total;

                $order_items[] = [
                    'product_id' => $item['product_id'],
                    'product_variant_id' => $item['variant_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $price,
                    'total_price' => $item_total,
                ];
            }
            }
        } catch (\Throwable $e) {
            \Log::error('Exception while preparing order items', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->route('cart.index')->with('error', 'An error occurred while preparing your order. Please try again.');
        }

        \Log::info('Prepared order items', ['order_items_count' => count($order_items), 'subtotal' => $subtotal, 'order_items' => $order_items]);

        // Check if we have any valid order items
        if (empty($order_items)) {
            \Log::warning('No valid order items could be prepared from cart');
            return redirect()->route('cart.index')->with('error', 'Could not process your cart items. Please try adding items again.');
        }

        $total = $subtotal;

        // Create order with database transaction
        try {
            \DB::beginTransaction();
            
            \Log::info('Creating order', ['user_id' => auth()->id(), 'total' => $total, 'subtotal' => $subtotal]);
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . date('YmdHis') . '-' . auth()->id(),
                'status' => 'pending',
                'subtotal' => $subtotal,
                'tax' => 0,
                'total' => $total,
                'notes' => $validated['notes'] ?? null,
            ]);

            \Log::info('Order created', ['order_id' => $order->id, 'order_number' => $order->order_number]);
            
            // Create order items
            foreach ($order_items as $itemData) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $itemData['product_id'],
                    'product_variant_id' => $itemData['product_variant_id'],
                    'quantity' => $itemData['quantity'],
                    'unit_price' => $itemData['unit_price'],
                    'total_price' => $itemData['total_price'],
                ]);
                \Log::info('Order item created', ['order_id' => $order->id, 'product_id' => $itemData['product_id'], 'quantity' => $itemData['quantity']]);
            }
            
            \DB::commit();
            
            // Clear cart
            session()->forget('cart');

            return redirect()->route('orders.show', $order)
                ->with('success', 'Order placed successfully! Your order has been received.');
                
        } catch (\Throwable $e) {
            \DB::rollBack();
            \Log::error('Failed to create order', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => auth()->id(),
            ]);
            
            return redirect()->route('cart.index')
                ->with('error', 'Failed to place your order. Please try again. Error: ' . $e->getMessage());
        }
    }
}
