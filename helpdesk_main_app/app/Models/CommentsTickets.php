<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentsTickets extends Model
{
    use HasFactory;

    protected $table = 'comments_tickets';

    protected $fillable = [
        'comment',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by',
        'ticket_id',
    ];

    public function ticket()
    {
        return $this->belongsTo(Tickets::class);
    }
}
