<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasRoles, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'status_user',
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
}
