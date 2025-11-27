<?php

namespace App\Models;

use App\Traits\AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Product Model
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string|null $image_path
 * @property int $current_stock
 * @property int $low_stock_threshold
 * @property float $base_price
 * @property string $status
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Product extends Model
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_path',
        'current_stock',
        'low_stock_threshold',
        'base_price',
        'status',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'current_stock' => 'integer',
        'low_stock_threshold' => 'integer',
    ];

    /**
     * Get the variants for the product.
     */
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * Get the inventory history for the product.
     */
    public function inventoryHistory(): HasMany
    {
        return $this->hasMany(InventoryHistory::class);
    }

    /**
     * Get the reviews for the product.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get average rating for the product.
     */
    public function averageRating(): float
    {
        return round($this->reviews()->avg('rating') ?? 0, 1);
    }

    /**
     * Get total review count.
     */
    public function reviewCount(): int
    {
        return $this->reviews()->count();
    }

    /**
     * Use slug as route key for implicit model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Check if product is low on stock.
     */
    public function isLowStock(): bool
    {
        return $this->current_stock <= $this->low_stock_threshold;
    }

    /**
     * Get the full image URL, handling both external URLs and local storage paths.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->image_path)) {
            return null;
        }
        
        // If already a full URL, return as-is
        if (str_starts_with($this->image_path, 'http')) {
            return $this->image_path;
        }
        
        // If starts with /storage, use asset() directly
        if (str_starts_with($this->image_path, '/storage')) {
            return asset($this->image_path);
        }
        
        // Otherwise, prepend storage/
        return asset('storage/' . $this->image_path);
    }

    /**
     * Get total stock from all active variants.
     */
    public function getTotalStockFromVariants(): int
    {
        return (int) $this->variants()
            ->where('status', 'active')
            ->sum('stock_quantity');
    }

    /**
     * Get total stock from all variants (including inactive).
     */
    public function getTotalAllVariantsStock(): int
    {
        return (int) $this->variants()->sum('stock_quantity');
    }

    /**
     * Check if product has any stock in active variants.
     */
    public function hasStock(): bool
    {
        return $this->variants()
            ->where('status', 'active')
            ->where('stock_quantity', '>', 0)
            ->exists();
    }

    /**
     * Check if product is low on stock (any variant).
     */
    public function isLowStockVariant(): bool
    {
        $lowStockVariants = $this->variants()
            ->where('status', 'active')
            ->where('stock_quantity', '<=', $this->low_stock_threshold ?? 10)
            ->exists();

        return $lowStockVariants;
    }

    /**
     * Scope to get only active products.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to get low stock items.
     */
    public function scopeLowStock($query)
    {
        return $query->whereRaw('current_stock <= low_stock_threshold');
    }
}
