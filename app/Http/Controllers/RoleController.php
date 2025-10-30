<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Superadmin page
     */
    public function superadmin()
    {
        $user = Auth::user();

        // Counts
        $usersCount = \App\Models\User::count();
        $permintaanCount = \App\Models\Data::count();
        $perdinCount = \App\Models\Perdin::count();
        $kunjunganCount = \App\Models\Kunjungan::count();

        // Recent items
        $recentUsers = \App\Models\User::orderBy('created_at', 'desc')->limit(5)->get();
        $recentPermintaan = \App\Models\Data::orderBy('tanggal', 'desc')->limit(5)->get();
        $recentPerdin = \App\Models\Perdin::orderBy('created_at', 'desc')->limit(5)->get();

        return view('roles.superadmin.dashboard', compact(
            'user',
            'usersCount',
            'permintaanCount',
            'perdinCount',
            'kunjunganCount',
            'recentUsers',
            'recentPermintaan',
            'recentPerdin'
        ));
    }

    /**
     * Admin page
     */
    public function admin()
    {
        $user = Auth::user();
        // Load permintaan data for admin listing with status pending
        $permintaan = \App\Models\Data::where('status', 'pending')->orderBy('tanggal', 'desc')->get();
        // view path: resources/views/roles/admin/admin.blade.php
        return view('roles.admin.admin', compact('user', 'permintaan'));
    }

    /**
     * Sales page
     */
    public function sales()
    {
        $user = Auth::user();
        // Load kunjungan data for sales dashboard
        $kunjungan = \App\Models\Kunjungan::with('details')->latest()->get();
        // view path: resources/views/roles/sales/dashboard.blade.php
        return view('roles.sales.dashboard', compact('user', 'kunjungan'));
    }

    /**
     * Finance page
     */
    public function finance()
    {
        $user = Auth::user();
        // Load perdin submissions for finance
        $perdins = \App\Models\Perdin::orderBy('created_at', 'desc')->get();
        // view path: resources/views/roles/finance/index.blade.php
        return view('roles.finance.index', compact('user', 'perdins'));
    }

    /**
     * Gudang page
     */
    public function gudang()
    {
        $user = Auth::user();
        // Load barang masuk data for gudang listing
        $barangMasuk = \App\Models\BarangMasuk::with('details')->latest()->get();
        // view path: resources/views/roles/gudang/masuk.blade.php
        return view('roles.gudang.masuk', compact('user', 'barangMasuk'));
    }
}
