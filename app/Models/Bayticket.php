<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bayticket extends Model
{
    use HasFactory;

    protected $fillable=[
        'client_id',
        'show_id',
        'ticket_id',
        'quantity',
        'qrcode',
        'notes'
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
