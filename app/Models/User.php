<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'date_of_birth',
        'age_group_category',
        'phone_number',
        'parents_name',
        'role',
        'parents_telephone_number',
        'address',
        'coach_category',
        'age_group_coach_category',
        'photo',
        'qr_code',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    protected $hidden = [
        'password',
    ];

    public function isStudent()
    {
        return $this->hasRole('siswa');
    }

    public function isCoach()
    {
        return $this->hasRole('pelatih');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

}
