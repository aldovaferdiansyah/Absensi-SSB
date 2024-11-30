<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

class Schedule extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'schedules';
    protected $fillable = [
        'title',
        'date',
        'description',
        'time_start',
        'time_end'
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
