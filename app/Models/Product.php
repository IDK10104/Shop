<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id','name','slug','description','short_description',
        'price','compare_price','image','images','stock','sku','featured','active','badge',
    ];

    protected $casts = [
        'images' => 'array',
        'featured' => 'boolean',
        'active' => 'boolean',
    ];

    public function category() { return $this->belongsTo(Category::class); }

    public function getPriceFormattedAttribute(): string {
        return '$' . number_format($this->price / 100, 2);
    }

    public function getComparePriceFormattedAttribute(): ?string {
        return $this->compare_price ? '$' . number_format($this->compare_price / 100, 2) : null;
    }

    public function getDiscountPercentAttribute(): ?int {
        if (!$this->compare_price || $this->compare_price <= $this->price) return null;
        return round((1 - $this->price / $this->compare_price) * 100);
    }

    public function scopeActive($q) { return $q->where('active', true); }
    public function scopeFeatured($q) { return $q->where('featured', true); }
}
