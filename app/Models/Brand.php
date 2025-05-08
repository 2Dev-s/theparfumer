<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = [
        'name',
        'active',
    ];

    public function perfumes(): HasMany
    {
        return $this->hasMany(Perfume::class);
    }
}
