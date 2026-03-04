<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['firstname', 'lastname', 'sex', 'age', 'card_id', 'phone', 'pay_method'];

    protected $casts = [
        'age' => 'integer',
    ];

    public function baytickets(): HasMany
    {
        return $this->hasMany(Bayticket::class);
    }
}
