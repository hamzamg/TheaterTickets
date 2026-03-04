<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShowsType extends Model
{
    protected $fillable = [
        'type',
        'slug',
        'description',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function shows()
    {
        return $this->hasMany(Show::class, 'show_type_id');
    }
}
