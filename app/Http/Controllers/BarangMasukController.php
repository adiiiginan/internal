<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangMasuk;

class BarangMasukController extends Controller
{
    public function index()
    {
        // Ambil semua barang masuk dengan relasi details
        $barangMasuk = BarangMasuk::with('details')->latest()->get();

        return view('roles.gudang.masuk', compact('barangMasuk'));
    }
}
