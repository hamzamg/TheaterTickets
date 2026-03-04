<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeatherPlace extends Model
{
    protected $fillable = [
        'num_row',
        'num_col',
        'name',
        'reservation',
        'selected',
    ];

    protected $casts = [
        'num_row' => 'integer',
        'num_col' => 'integer',
        'reservation' => 'boolean',
        'selected' => 'boolean',
    ];
}
