<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable=['date_shows','time_shows','nomber_ticket','rest_ticket','price','code_ticket','type','show_id'];

    // public function shows()
    // {
    //     return $this->hasMany(Show::class);
    // }
}
