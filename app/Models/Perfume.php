<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Perfume extends Model
{
    protected $table = 'perfumes';

    protected $fillable = [
        'name',
        'slug',
        'brand_id',
        'category_id',
        'description',
        'top_notes',
        'middle_notes',
        'base_notes',
        'price_old',
        'price',
        'size',
        'sex',
        'concentration',
        'stock',
        'price_id',
        'active',
    ];

    protected $casts = [
        'brand_id' => 'integer',
        'category_id' => 'integer',
        'price' => 'float',
        'stock' => 'integer',
    ];

    protected $appends = [
        'main_image_url',
        'gallery_images'
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function getMainImageUrlAttribute(): string
    {
        return asset('images/default-parfum.jpg');
    }

    public function getGalleryImagesAttribute(): array
    {
        return [];
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        $slug = Str::slug($value);
        $counter = 1;

        while (static::where('slug', $slug)
            ->where('id', '!=', $this->id ?? null)
            ->exists()) {
            $slug = Str::slug($value) . '-' . $counter;
            $counter++;
        }

        $this->attributes['slug'] = $slug;
    }
}
