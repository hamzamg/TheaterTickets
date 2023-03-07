<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable=[
        'firstname',
        'lastname',
        'sex',
        'age',
        'card_id',
        'phone',
        'pay_method'
        ];

    // public function tickets()
    // {
    //     return $this->hasMany(Tickets::class);
    // }
}
