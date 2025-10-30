<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KunjunganDetail;

class Kunjungan extends Model
{
    use HasFactory;

    protected $table = 'kunjungan';
    public $timestamps = true;
    protected $fillable = ['customer', 'tgl_kunjungan', 'kontak', 'pic'];

    // Accessor untuk kompatibilitas dengan kode yang menggunakan 'tanggal'


    public function getTanggalAttribute()
    {
        return $this->tgl_kunjungan;
    }

    // Mutator untuk kompatibilitas dengan kode yang menggunakan 'tanggal'
    public function setTanggalAttribute($value)
    {
        $this->attributes['tgl_kunjungan'] = $value;
    }

    public function details()
    {
        return $this->hasMany(KunjunganDetail::class, 'idkunjungan');
    }

    public function kunjungan()
    {
        return $this->hasMany(KunjunganDetail::class, 'idkunjungan');
    }
}
