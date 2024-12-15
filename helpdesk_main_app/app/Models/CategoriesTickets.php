<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesTickets extends Model
{
    use HasFactory;

    protected $table = 'categories_tickets';

    protected $fillable = [
        'category',
    ];

    public function tickets()
    {
        return $this->hasMany(Tickets::class);
    }
}
