<?php

namespace App\Models;

use App\Services\NotificationService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Order Model
 *
 * @property int $id
 * @property int $user_id
 * @property string $order_number
 * @property string $status
 * @property int|null $assigned_staff_id
 * @property float $subtotal
 * @property float $tax
 * @property float $total
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $completed_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'assigned_staff_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'shipping_city',
        'shipping_postal_code',
        'payment_method',
        'payment_status',
        'subtotal',
        'discount',
        'tax',
        'total',
        'notes',
        'completed_at',
    ];

    /**
     * Default attribute values for pickup-based system.
     */
    protected $attributes = [
        'payment_method' => 'cash',
        'payment_status' => 'pending',
        'discount' => 0,
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
        'completed_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function booted(): void
    {
        static::updating(function (Order $order) {
            // Trigger notification when status changes
            if ($order->isDirty('status')) {
                $oldStatus = $order->getOriginal('status');
                $newStatus = $order->status;
                
                NotificationService::orderStatusChanged($order, $oldStatus, $newStatus);
                
                // Send special thank you message and deduct inventory when order is completed
                if ($newStatus === 'completed' && $oldStatus !== 'completed') {
                    NotificationService::orderCompleted($order);
                    
                    // Deduct inventory for completed orders
                    foreach ($order->items as $item) {
                        $product = $item->product;
                        if ($product) {
                            $oldStock = $product->current_stock;
                            $product->current_stock = max(0, $product->current_stock - $item->quantity);
                            $product->save();

                            // Log inventory history (use the canonical column names)
                            \App\Models\InventoryHistory::create([
                                'product_id' => $product->id,
                                'type' => 'sale',
                                // quantity_changed is required by DB (negative for sale)
                                'quantity_changed' => -($item->quantity),
                                'quantity_before' => $oldStock,
                                'quantity_after' => $product->current_stock,
                                // keep a short reference and a human-readable note
                                'reference' => 'order:' . $order->order_number,
                                'notes' => 'Order #' . $order->order_number . ' completed',
                                'user_id' => $order->user_id,
                            ]);

                            // Check if product is now low stock - notify all admins
                                if ($product->current_stock <= $product->low_stock_threshold && $oldStock > $product->low_stock_threshold) {
                                // users.roles is a JSON array (e.g. ["admin"]). Use whereJsonContains to find admins
                                $admins = \App\Models\User::whereJsonContains('roles', 'admin')->get();
                                foreach ($admins as $admin) {
                                    NotificationService::lowStockAlert($admin->id, $product->name, $product->current_stock);
                                }
                            }
                        }
                    }
                }
            }

            // Trigger notification when staff is assigned
            if ($order->isDirty('assigned_staff_id') && $order->assigned_staff_id) {
                NotificationService::orderAssignedToStaff($order);
            }
        });
    }

    /**
     * Get the customer for the order.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user (alias for customer).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the assigned staff member.
     */
    public function assignedStaff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_staff_id');
    }

    /**
     * Get the items in the order.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Scope to get pending orders.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get completed orders.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed')->whereNotNull('completed_at');
    }

    /**
     * Check if order can be cancelled.
     */
    public function canBeCancelled(): bool
    {
        return $this->status === 'pending';
    }
}
