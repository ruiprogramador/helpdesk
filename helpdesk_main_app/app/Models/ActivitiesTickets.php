<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitiesTickets extends Model
{
    use HasFactory;

    protected $table = 'activities_tickets';

    protected $fillable = [
        'ticket_id',
        'closed_at',
        'reopened_at',
        'resolved_at',
        'assigned_at',
        'unassigned_at',
        'escalated_at',
        'deescalated_at',
        'acknowledged_at',
        'unacknowledged_at',
        'assigned_to',
        'closed_by',
        'reopened_by',
        'resolved_by',
        'assigned_by',
        'unassigned_by',
        'escalated_by',
        'deescalated_by',
        'acknowledged_by',
        'unacknowledged_by',
    ];

    public function ticket()
    {
        return $this->belongsTo(Tickets::class);
    }
}
