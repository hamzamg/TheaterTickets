<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeatherPlaces extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_row',
        'num_col',
        'name',
        'reservation',
        'selected',
    ];
}
