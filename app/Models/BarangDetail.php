<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BarangMasuk;

class BarangDetail extends Model
{
    use HasFactory;
    protected $table = 'barang_detail';
    protected $fillable = [
        'idbarang_masuk',
        'barang',
        'qty',
        'panjang',
        'lebar',
        'tinggi',
        'dimensi',
        'gambar',
        'ket',
    ]; // sesuaikan dengan kolom

    public function barangmasuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'idbarang_masuk');
    }
}
