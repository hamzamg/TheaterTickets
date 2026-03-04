<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketsType extends Model
{
    protected $fillable = [
        'type',
        'slug',
        'description',
        'price_modifier',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'price_modifier' => 'decimal:2',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'ticket_type_id');
    }
}
