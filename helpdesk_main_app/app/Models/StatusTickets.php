<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTickets extends Model
{
    use HasFactory;

    protected $table = 'status_tickets';

    protected $fillable = [
        'status',
    ];

    public function tickets()
    {
        return $this->hasMany(Tickets::class);
    }
}
