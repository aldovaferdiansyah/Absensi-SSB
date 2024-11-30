<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Pengajuanizin extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'pengajuanizins';

    protected $fillable = [
        'user_id',
        'name',
        'start_date',
        'end_date',
        'reason',
        'type',
        'proof',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
