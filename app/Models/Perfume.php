<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'price',
        'size',
        'concentration',
        'stock',
        'active',
    ];

    protected $casts = [
        'brand_id' => 'integer',
        'category_id' => 'integer',
        'price' => 'float',
        'stock' => 'integer',
        'top_notes' => 'array',
        'middle_notes' => 'array',
        'base_notes' => 'array',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
