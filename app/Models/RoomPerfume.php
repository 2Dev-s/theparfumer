<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class RoomPerfume extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'room_perfumes';

    protected $fillable = [
        'name',
        'slug',
        'brand_id',
        'category_id',
        'description',
        'fragrance_notes',
        'price',
        'size',
        'duration_hours',
        'room_type',
        'stock',
        'price_id',
        'active',
    ];

    protected $casts = [
        'brand_id' => 'integer',
        'category_id' => 'integer',
        'price' => 'float',
        'stock' => 'integer',
        'duration_hours' => 'integer',
        'active' => 'boolean',
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

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->sharpen(10)
            ->performOnCollections('images', 'gallery');

        $this->addMediaConversion('medium')
            ->width(600)
            ->height(600)
            ->performOnCollections('images', 'gallery');
    }

    public function getMainImageUrlAttribute(): string
    {
        return $this->getFirstMediaUrl('images', 'medium')
            ?? '/images/default-room-perfume.jpg';
    }

    public function getGalleryImagesAttribute(): array
    {
        return $this->getMedia('images')->map(function ($media) {
            return [
                'url' => $media->getFullUrl('medium'),
                'thumb' => $media->getFullUrl('thumb'),
            ];
        })->toArray();
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

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favourites');
    }
}
