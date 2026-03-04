<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketsType extends Model
{
    use HasFactory;

    protected $fillable=['type','slug','description','price_modifier','active'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'ticket_type_id');
    }
}
