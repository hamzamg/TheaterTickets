<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Show extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'description', 'photo_path', 'active', 'show_type_id'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function showType(): BelongsTo
    {
        return $this->belongsTo(ShowsType::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function baytickets(): HasMany
    {
        return $this->hasMany(Bayticket::class);
    }
}
