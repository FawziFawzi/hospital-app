<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Appointment extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'phone',
        'date',
        'email',
        'doctor',
        'message',
        'status',
        'user_id'

    ];
}
