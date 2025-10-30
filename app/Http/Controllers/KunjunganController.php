<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kunjungan;
use App\Models\KunjunganDetail;

class KunjunganController extends Controller
{

    public function dashboard()
    {
        $kunjungan = Kunjungan::with('details')->latest()->get();
        return view('roles.sales.dashboard', compact('kunjungan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'   => 'required|date',
            'customer'  => 'required|string|max:255',
        ]);

        // Simpan ke tabel kunjungan
        $kunjungan = Kunjungan::create([
            'tgl_kunjungan' => $request->tanggal, // Gunakan nama kolom yang benar
            'customer' => $request->customer,
            'kontak'   => $request->kontak,
            'pic'      => $request->pic,
        ]);

        // Simpan ke tabel kunjungan_detail
        KunjunganDetail::create([
            'idkunjungan' => $kunjungan->id,
            'prospek'     => $request->prospek, // Gunakan nama kolom yang benar
            'aksi'        => $request->aksi,
            'next'        => $request->next,
        ]);

        return redirect()->route('sales.dashboard')->with('success', 'Data kunjungan berhasil ditambahkan');
    }
}
