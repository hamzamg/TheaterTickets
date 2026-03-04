<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'sex',
        'age',
        'card_id',
        'phone',
        'pay_method',
    ];

    protected $casts = [
        'age' => 'integer',
    ];

    public function bookings()
    {
        return $this->hasMany(Bayticket::class);
    }
}
