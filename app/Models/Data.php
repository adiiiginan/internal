<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'data';

    protected $fillable = [
        'nama',
        'divisi',
        'jenis_permintaan',
        'qty',
        'deskripsi',
        'supplier',
        'customer',
        'tanggal',
        'gambar',
        'use',
        'etd',
        'status'
    ];

    public $timestamps = false; // karena tabelmu tidak ada created_at/updated_at
}
