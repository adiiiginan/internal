<?php

namespace App\Exports;

use App\Models\Data;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class PermintaanExport implements FromCollection, WithHeadings, WithDrawings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Data::all()->map(function ($item) {
            return [
                $item->id, // #
                '', // Gambar (handled by drawings)
                $item->nama,
                $item->divisi,
                $item->jenis_permintaan,
                $item->tanggal,
                $item->deskripsi,
                $item->supplier,
                $item->customer,
                $item->etd, // Deadline
                $item->status, // Status
            ];
        });
    }

    public function headings(): array
    {
        return [
            '#',
            'Gambar',
            'Nama',
            'Divisi',
            'Jenis Permintaan',
            'Tanggal',
            'Deskripsi',
            'Supplie',
            'Customer',
            'Deadline',
            'Status ',
        ];
    }

    public function drawings()
    {
        $drawings = [];
        $data = Data::all();
        $row = 2; // Start from row 2 (after headings)

        foreach ($data as $item) {
            if ($item->gambar && file_exists(public_path('backend/assets/media/gambar/' . $item->gambar))) {
                $drawing = new Drawing();
                $drawing->setName('Image');
                $drawing->setDescription('Image');
                $drawing->setPath(public_path('backend/assets/media/gambar/' . $item->gambar));
                $drawing->setHeight(50);
                $drawing->setCoordinates('B' . $row); // Column B is Gambar
                $drawings[] = $drawing;
            }
            $row++;
        }

        return $drawings;
    }
}
