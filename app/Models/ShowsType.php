<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShowsType extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'slug', 'description', 'active'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function shows(): HasMany
    {
        return $this->hasMany(Show::class, 'show_type_id');
    }
}
