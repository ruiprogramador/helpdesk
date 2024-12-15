<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrioritiesTickets extends Model
{
    use HasFactory;

    protected $table = 'priorities_tickets';

    protected $fillable = [
        'priority',
    ];

    public function tickets()
    {
        return $this->hasMany(Tickets::class);
    }
}
