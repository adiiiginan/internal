<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perdin extends Model
{
    use HasFactory;

    protected $table = 'perdin';

    protected $fillable = [
        'nama',
        'jabatan',
        'tujuan',
        'keperluan',
        'tgl_keberangkatan',
        'tgl_kepulangan',
        'jenis_pengajuan',
        'rincian',
        'transportasi',
        'bbm',
        'makan',
        'dll',
        'total',
        'advance',
        'expense',
        'status',
    ];

    protected $casts = [
        'transportasi' => 'decimal:2',
        'bbm' => 'decimal:2',
        'makan' => 'decimal:2',
        'dll' => 'decimal:2',
        'total' => 'decimal:2',
        'advance' => 'decimal:2',
        'expense' => 'decimal:2',
        'tgl_keberangkatan' => 'date',
        'tgl_kepulangan' => 'date',
    ];
}
