<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        /*'phone',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'avatar',*/
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
