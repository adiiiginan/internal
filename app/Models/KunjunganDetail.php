<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganDetail extends Model
{
    use HasFactory;

    protected $table = 'kunjungan_detail';
    public $timestamps = false;
    protected $fillable = ['idkunjungan', 'prospek', 'aksi', 'next'];

    // Accessor untuk kompatibilitas dengan kode yang menggunakan 'prospeK'


    // Mutator untuk kompatibilitas dengan kode yang menggunakan 'prospeK'
    public function setProspeKAttribute($value)
    {
        $this->attributes['prospek'] = $value;
    }

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'idkunjungan');
    }
}
