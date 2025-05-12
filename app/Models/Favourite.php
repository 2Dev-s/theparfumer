<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favourite extends Model
{
    protected $table = 'favourites';

    protected $fillable = [
        'user_id',
        'perfume_id',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'perfume_id' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function perfume(): BelongsTo
    {
        return $this->belongsTo(Perfume::class);
    }
}
