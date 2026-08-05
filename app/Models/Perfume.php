<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Perfume extends Model implements HasMedia
{
    use InteractsWithMedia;

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

    // Register media collections
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main_image')
            ->singleFile()
            ->useDisk('public');

        $this->addMediaCollection('gallery_images')
            ->useDisk('public');
    }

    // Optional: Register media conversions
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100)
            ->sharpen(10);

        $this->addMediaConversion('medium')
            ->width(300)
            ->height(300)
            ->sharpen(10);

        $this->addMediaConversion('large')
            ->width(600)
            ->height(600)
            ->sharpen(10);
    }

    // Update your accessors to use media library
    public function getMainImageUrlAttribute(): string
    {
        $media = $this->getFirstMedia('main_image');

        if ($media) {
            return $media->getUrl();
        }

        return asset('images/default-parfum.jpg');
    }

    public function getGalleryImagesAttribute(): array
    {
        $mediaCollection = $this->getMedia('gallery_images');

        if ($mediaCollection->isNotEmpty()) {
            return $mediaCollection->map(function ($media) {
                return $media->getUrl();
            })->toArray();
        }

        return [];
    }

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
