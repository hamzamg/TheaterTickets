<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'uuid',
        'date_shows',
        'time_shows',
        'nomber_ticket',
        'rest_ticket',
        'price',
        'code_ticket',
        'type',
        'show_id',
        'ticket_type_id',
    ];

    protected $casts = [
        'date_shows' => 'date',
        'time_shows' => 'datetime',
    ];

    public function show()
    {
        return $this->belongsTo(Show::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketsType::class, 'ticket_type_id');
    }

    public function bookings()
    {
        return $this->hasMany(Bayticket::class);
    }
}
