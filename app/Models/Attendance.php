<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class Attendance extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'role',
        'type',
        'arrival_at',
        'status_arrival',
        'departure_at',
        'status_departure',
    ];

    protected $casts = [
        'arrival_at' => 'datetime',
        'departure_at' => 'datetime',
    ];
}
