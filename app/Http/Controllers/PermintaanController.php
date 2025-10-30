<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use App\Models\BarangDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\PermintaanNotification;
use App\Exports\PermintaanExport;
use Maatwebsite\Excel\Facades\Excel;

class PermintaanController extends Controller
{


    public function index()
    {
        // Ambil data permintaan barang dengan status pending
        $permintaan = Data::where('status', 'pending')->get();

        // Kirim ke view
        return view('roles.admin.admin', compact('permintaan'));
    }

    public function exportPdf($id)
    {
        $permintaan = Data::findOrFail($id);

        $pdf = Pdf::loadView('roles.admin.pdf', compact('permintaan'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('permintaan_barang_' . $id . '.pdf');
    }

    public function create()
    {
        return view('permintaan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'divisi' => 'required|string|max:255',
            'use' => 'required|string|max:255',
            'jenis_permintaan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'qty' => 'nullable|string',
            'supplier' => 'nullable|string|max:255',
            'customer' => 'nullable|string|max:255',
            'etd' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // default null
        $fileName = null;

        // If the frontend already uploaded a photo via the camera endpoint, use that filename (uploaded_photo_url)
        // uploaded_photo_url contains full asset URL like /backend/assets/media/gambar/160000_name.jpg
        if ($request->filled('uploaded_photo_url')) {
            $uploadedUrl = $request->input('uploaded_photo_url');
            // Extract filename from URL
            $fileName = basename(parse_url($uploadedUrl, PHP_URL_PATH));
        }

        // Otherwise, if a file was attached directly to the form under 'gambar', save it now
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('backend/assets/media/gambar'), $fileName);
        }

        // Simpan ke database Data
        $permintaan = Data::create([
            'nama' => $validated['nama'],
            'divisi' => $validated['divisi'],
            'use' => $validated['use'],
            'jenis_permintaan' => $validated['jenis_permintaan'],
            'qty' => $validated['qty'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'supplier' => $validated['supplier'] ?? null,
            'customer' => $validated['customer'] ?? null,
            'tanggal' => now()->toDateString(),
            'etd' => $validated['etd'] ?? null,
            'gambar' => $fileName,
            'status' => 'pending',
        ]);

        // Simpan juga ke BarangDetail
        BarangDetail::create([
            'idbarang_masuk' => null, // atau ID dari BarangMasuk jika ada
            'barang' => $validated['jenis_permintaan'],
            'qty' => $validated['qty'],
            'gambar' => $fileName,
            'ket' => $validated['deskripsi'] ?? null,
        ]);

        // Generate PDF dari view
        $pdf = Pdf::loadView('roles.admin.pdf', compact('permintaan'))
            ->setPaper('a4', 'portrait');

        // Kirim email notifikasi dengan PDF terlampir
        Mail::to([
            'amelia.rifa@jns.co.id',
            'giriwest@jns.co.id',
            'jeffry@jns.co.id',
        ])->send(new PermintaanNotification($permintaan, $pdf));

        // langsung download, bukan redirect
        return $pdf->download('permintaan_barang_' . $permintaan->id . '.pdf');
    }

    /**
     * Upload photo (camera) — saves image to public storage and returns JSON with filename and url.
     * This endpoint does not modify database records.
     */
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // max 5MB
        ]);

        $file = $request->file('photo');
        $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
        $targetPath = public_path('backend/assets/media/gambar');

        if (!file_exists($targetPath)) {
            mkdir($targetPath, 0755, true);
        }

        $file->move($targetPath, $fileName);

        $url = asset('backend/assets/media/gambar/' . $fileName);

        return response()->json([
            'success' => true,
            'filename' => $fileName,
            'url' => $url,
        ]);
    }

    public function destroy($id)
    {
        $permintaan = Data::findOrFail($id);
        $permintaan->delete();

        return redirect()->route('role.admin')->with('success', 'Permintaan berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(new PermintaanExport, 'permintaan.xlsx');
    }

    public function exportAllPdf()
    {
        $permintaan = Data::all();

        $pdf = Pdf::loadView('roles.admin.pdf_all', compact('permintaan'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('semua_permintaan_barang.pdf');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $permintaan = Data::findOrFail($id);
        $permintaan->update(['status' => $request->status]);

        return redirect()->route('role.admin')->with('success', 'Status berhasil diperbarui.');
    }

    public function onProgress()
    {
        $permintaan = Data::where('status', 'on progress')->get();

        return view('roles.admin.admin', compact('permintaan'));
    }

    public function done()
    {
        $permintaan = Data::where('status', 'done')->get();

        return view('roles.admin.admin', compact('permintaan'));
    }
}
