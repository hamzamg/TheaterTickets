<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    protected $fillable = [
        'name',
        'type',
        'description',
        'photo_path',
        'active',
        'show_type_id',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function showType()
    {
        return $this->belongsTo(ShowsType::class, 'show_type_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
