<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'date_shows', 'time_shows', 'nomber_ticket', 'rest_ticket', 'price', 'code_ticket', 'type', 'show_id', 'ticket_type_id'];

    protected $casts = [
        'date_shows' => 'date',
        'time_shows' => 'datetime',
        'price' => 'integer',
        'nomber_ticket' => 'integer',
        'rest_ticket' => 'integer',
    ];

    public function show(): BelongsTo
    {
        return $this->belongsTo(Show::class);
    }

    public function ticketType(): BelongsTo
    {
        return $this->belongsTo(TicketsType::class, 'ticket_type_id');
    }

    public function baytickets(): HasMany
    {
        return $this->hasMany(Bayticket::class);
    }
}
