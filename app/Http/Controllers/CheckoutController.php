<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
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
                    'product_name' => $product->name ?? ($item['product_name'] ?? 'Unknown Product'),
                    'variant_name' => $variant ? ($variant->name ?? ($item['variant_name'] ?? null)) : ($item['variant_name'] ?? null),
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

        // Create order WITHOUT transaction to avoid PostgreSQL transaction issues
        try {
            $user = auth()->user();
            \Log::info('Creating order', ['user_id' => $user->id, 'total' => $total, 'subtotal' => $subtotal]);
            
            // Use direct DB insert to bypass any model event issues
            $orderId = \DB::table('orders')->insertGetId([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . date('YmdHis') . '-' . $user->id,
                'status' => 'pending',
                'customer_name' => $user->name,
                'customer_email' => $user->email,
                'payment_method' => 'cash',
                'payment_status' => 'pending',
                'subtotal' => $subtotal,
                'discount' => 0,
                'tax' => 0,
                'total' => $total,
                'notes' => $validated['notes'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            \Log::info('Order created', ['order_id' => $orderId]);
            
            // Create order items using direct DB insert
            foreach ($order_items as $itemData) {
                \DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $itemData['product_id'],
                    'product_variant_id' => $itemData['product_variant_id'],
                    'product_name' => $itemData['product_name'] ?? 'Unknown Product',
                    'variant_name' => $itemData['variant_name'] ?? null,
                    'quantity' => $itemData['quantity'],
                    'unit_price' => $itemData['unit_price'],
                    'total_price' => $itemData['total_price'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                \Log::info('Order item created', ['order_id' => $orderId, 'product_id' => $itemData['product_id']]);
            }

            // Decrement stock (product or variant) in real time, skipping null/unlimited stock
            foreach ($order_items as $itemData) {
                if (!empty($itemData['product_variant_id'])) {
                    $variant = $variants->get($itemData['product_variant_id']);
                    if ($variant && !is_null($variant->stock_quantity)) {
                        $newStock = max(0, $variant->stock_quantity - $itemData['quantity']);
                        ProductVariant::where('id', $variant->id)->update(['stock_quantity' => $newStock]);
                        \Log::info('Variant stock decremented', ['variant_id' => $variant->id, 'from' => $variant->stock_quantity, 'to' => $newStock]);
                    }
                } else {
                    $product = $products->get($itemData['product_id']);
                    if ($product && !is_null($product->current_stock)) {
                        $newStock = max(0, $product->current_stock - $itemData['quantity']);
                        Product::where('id', $product->id)->update(['current_stock' => $newStock]);
                        \Log::info('Product stock decremented', ['product_id' => $product->id, 'from' => $product->current_stock, 'to' => $newStock]);
                    }
                }
            }
            
            // Clear cart
            session()->forget('cart');

            // Get the order for redirect
            $order = Order::find($orderId);

            return redirect()->route('orders.show', $order)
                ->with('success', 'Order placed successfully! Your order has been received.');
                
        } catch (\Throwable $e) {
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
