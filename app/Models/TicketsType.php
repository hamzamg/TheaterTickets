<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketsType extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'slug', 'description', 'price_modifier', 'active'];

    protected $casts = [
        'price_modifier' => 'decimal:2',
        'active' => 'boolean',
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'ticket_type_id');
    }
}
