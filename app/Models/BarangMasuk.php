<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';
    protected $fillable = [
        'awb',
        'pengirim',
        'forward',
        'iduser',
        'check',
        'kode_penerimaan'
    ]; // sesuaikan dengan kolom

    public function details()
    {
        return $this->hasMany(BarangDetail::class, 'idbarang_masuk', 'id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'iduser', 'id');
    }
}
