<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perdin;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\PerdinNotification;

class PerdinController extends Controller
{
    public function create()
    {
        return view('perdin.create');
    }

    /**
     * Store a new Perdin submission.
     * All new records will be created with status = 1 (belum approved).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tujuan' => 'required|string|max:1000',
            'keperluan' => 'required|string',
            'tgl_keberangkatan' => 'nullable|date',
            'tgl_kepulangan' => 'nullable|date|after_or_equal:tgl_keberangkatan',
            'jenis_pengajuan' => 'nullable|string|max:100',
            'rincian' => 'nullable|string|max:100',
            'transportasi' => 'nullable|numeric',
            'bbm' => 'nullable|numeric',
            'makan' => 'nullable|numeric',
            'dll' => 'nullable|numeric',
            'advance' => 'nullable|numeric',
        ]);

        // Normalize numeric fields
        $transportasi = isset($validated['transportasi']) ? (float) $validated['transportasi'] : 0;
        $bbm = isset($validated['bbm']) ? (float) $validated['bbm'] : 0;
        $makan = isset($validated['makan']) ? (float) $validated['makan'] : 0;
        $dll = isset($validated['dll']) ? (float) $validated['dll'] : 0;
        $advance = isset($validated['advance']) ? (float) $validated['advance'] : 0;

        $total = $transportasi + $bbm + $makan + $dll;
        $expense = max(0, $total - $advance);

        $perdin = Perdin::create([
            'nama' => $validated['nama'],
            'jabatan' => $validated['jabatan'],
            'tujuan' => $validated['tujuan'],
            'keperluan' => $validated['keperluan'],
            'tgl_keberangkatan' => $validated['tgl_keberangkatan'] ?? null,
            'tgl_kepulangan' => $validated['tgl_kepulangan'] ?? null,
            'jenis_pengajuan' => $validated['jenis_pengajuan'] ?? null,
            'rincian' => $validated['rincian'] ?? null,
            'transportasi' => $transportasi,
            'bbm' => $bbm,
            'makan' => $makan,
            'dll' => $dll,
            'total' => $total,
            'advance' => $advance,
            'expense' => $expense,
            'status' => 1, // 1 = belum approved
        ]);

        // Send notification email to finance / inbox
        try {
            Mail::to('fitra@jns.co.id')->send(new PerdinNotification($perdin));
        } catch (\Throwable $e) {
            // Log error but do not interrupt user flow
            Log::error('Perdin email send failed: ' . $e->getMessage());
        }

        return redirect()->route('perdin.create')->with('success', 'Pengajuan perdin berhasil dikirim dan akan diperiksa (status: belum approved).');
    }

    /**
     * Finance index — list pending perdin submissions for finance role.
     */
    public function financeIndex()
    {
        $perdins = Perdin::where('status', 1)->orderBy('created_at', 'desc')->get();

        return view('roles.finance.index', compact('perdins'));
    }

    /**
     * Finance approved perdin — list approved perdin submissions for finance role.
     */
    public function approvedPerdin()
    {
        $perdins = Perdin::where('status', 2)->orderBy('created_at', 'desc')->get();

        return view('roles.finance.approved', compact('perdins'));
    }

    /**
     * Show PDF view for a single perdin submission.
     */
    public function pdf($id)
    {
        $perdin = Perdin::findOrFail($id);

        // Render a PDF view (you can later pipe this to a PDF generator)
        return view('roles.finance.pdf', compact('perdin'));
    }

    /**
     * Approve a perdin submission (finance / superadmin).
     */
    public function approve(Request $request, $id)
    {
        $perdin = Perdin::findOrFail($id);
        // 2 = approved
        $perdin->status = 2;
        $perdin->save();

        return redirect()->back()->with('success', 'Perdin approved successfully.');
    }

    /**
     * Reject a perdin submission (finance / superadmin).
     */
    public function reject(Request $request, $id)
    {
        $perdin = Perdin::findOrFail($id);
        // 3 = rejected
        $perdin->status = 3;
        $perdin->save();

        return redirect()->back()->with('success', 'Perdin rejected successfully.');
    }

    /**
     * Delete a perdin submission (finance / superadmin).
     */
    public function destroy($id)
    {
        $perdin = Perdin::findOrFail($id);
        $perdin->delete();

        return redirect()->back()->with('success', 'Perdin deleted successfully.');
    }
}
