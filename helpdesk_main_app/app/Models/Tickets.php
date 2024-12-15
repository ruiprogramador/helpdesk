<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'category',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activitiesTickets()
    {
        return $this->hasOne(ActivitiesTickets::class);
    }

    public function commentsTickets()
    {
        return $this->hasMany(CommentsTickets::class);
    }

    public function statusTickets()
    {
        return $this->belongsTo(StatusTickets::class);
    }

    public function prioritiesTickets()
    {
        return $this->belongsTo(PrioritiesTickets::class);
    }

    public function categoriesTickets()
    {
        return $this->belongsTo(CategoriesTickets::class);
    }

    public function ticketTypes()
    {
        return $this->belongsTo(TicketTypes::class);
    }
}
