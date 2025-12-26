<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Traits\AuditableTrait;

class Service extends Model
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'icon',
        'price_bw',
        'price_color',
        'price_label',
        'category',
        'category_description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price_bw' => 'decimal:2',
        'price_color' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });

        static::updating(function ($service) {
            if ($service->isDirty('title')) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    /**
     * Get the options for this service.
     */
    public function options()
    {
        return $this->hasMany(ServiceOption::class)->orderBy('sort_order');
    }

    /**
     * Scope for active services.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for filtering by category.
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope for ordering.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at');
    }
}
