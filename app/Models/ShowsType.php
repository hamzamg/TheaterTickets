<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowsType extends Model
{
    use HasFactory;

    protected $fillable=['type','slug','description','active'];

    public function shows()
    {
        return $this->hasMany(Show::class, 'show_type_id');
    }
}
