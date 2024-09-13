<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuanizin extends Model
{
    use HasFactory;

    protected $table = 'pengajuanizins';

    protected $fillable = [
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

