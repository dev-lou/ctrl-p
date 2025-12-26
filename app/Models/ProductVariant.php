<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\AuditableTrait;

class ProductVariant extends Model
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        'product_id',
        'name',
        'size',
        'color',
        'weight',
        'price_modifier',
        'stock_quantity',
        'status',
    ];

    protected $casts = [
        'price_modifier' => 'decimal:2',
        'stock_quantity' => 'integer',
    ];

    /**
     * Get the product for the variant.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get inventory history for this variant.
     */
    public function inventoryHistory(): HasMany
    {
        return $this->hasMany(InventoryHistory::class);
    }

    /**
     * Get the final price (base + modifier).
     */
    public function getFinalPrice(): float
    {
        return (float)($this->product->base_price + $this->price_modifier);
    }

    /**
     * Scope to get only active variants.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
