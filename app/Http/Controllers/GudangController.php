<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BarangMasuk;
use Illuminate\Support\Facades\Auth;
use App\Models\BarangDetail;

class GudangController extends Controller
{
    public function dashboard()
    {
        // Load barang masuk data and pass to the roles.gudang.masuk view
        $barangMasuk = BarangMasuk::with('details')->latest()->get();

        $user = Auth::user();

        return view('roles.gudang.masuk', compact('user', 'barangMasuk'));
    }

    public function store(Request $request)
    {
        // 1. Simpan data ke barang_masuk
        $barang = BarangMasuk::create([
            'awb'             => $request->awb,
            'pengirim'        => $request->pengirim,
            'forward'         => $request->forward,
            'iduser'          => $request->iduser,
            'check'           => $request->check,

        ]);

        // 2. Upload gambar (kalau ada)
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('backend/assets/media/barang/'), $fileName);
            $gambarPath = $fileName;
        }

        // 3. Simpan ke tabel barang_details
        $barangDetail = BarangDetail::where('idbarang_masuk', $barang->id)->first();

        if ($barangDetail) {
            $barangDetail->update([
                'barang'  => $request->barang,
                'qty'     => $request->qty,
                'panjang' => $request->panjang,
                'lebar'   => $request->lebar,
                'tinggi'  => $request->tinggi,
                'dimensi' => $request->dimensi,
                'gambar'  => $gambarPath ?? $barangDetail->gambar,
                'ket'     => $request->ket,
            ]);
        } else {
            BarangDetail::create([
                'idbarang_masuk' => $barang->id,
                'barang'  => $request->barang,
                'qty'     => $request->qty,
                'panjang' => $request->panjang,
                'lebar'   => $request->lebar,
                'tinggi'  => $request->tinggi,
                'dimensi' => $request->dimensi,
                'gambar'  => $gambarPath,
                'ket'     => $request->ket,
            ]);
        }

        return redirect()->route('gudang.dashboard')->with('success', 'Data berhasil disimpan!');
    }
}
