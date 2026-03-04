<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bayticket extends Model
{
    protected $fillable = [
        'client_id',
        'show_id',
        'ticket_id',
        'quantity',
        'notes',
        'qrcode',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function show()
    {
        return $this->belongsTo(Show::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
