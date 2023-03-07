<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'type',
        'description',
        'photo_path',
        'active'
    ];
    // protected $hidden = [
    //     'created_at', 'updated_at',
    // ];

}
