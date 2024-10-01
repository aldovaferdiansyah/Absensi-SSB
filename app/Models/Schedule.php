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
        'description',
        'date',
        'time_start',
        'time_end'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
