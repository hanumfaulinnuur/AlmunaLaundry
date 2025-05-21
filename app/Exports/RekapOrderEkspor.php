<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RekapOrderEkspor implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
{
    public function collection()
    {
        // Mengambil data Transaksi dan relasi yang dibutuhkan
        return Transaksi::with(['Pelanggan', 'Service']) // Pastikan relasi dengan model Pelanggan dan Service ada
            ->where('status_transaksi', 'selesai')
            ->get()
            ->map(function ($transaksi) {
                return [
                    'no_invoice' => $transaksi->no_invoice,
                    'nama' => $transaksi->Pelanggan->user->name ?? '-', // Mengambil nama pelanggan
                    'jenis_service' => $transaksi->Service->nama_service ?? '-', // Mengambil nama service
                    'tanggal_order' => \Carbon\Carbon::parse($transaksi->tanggal_order)->translatedFormat('l, d F Y'),
                    'tanggal_selesai' => \Carbon\Carbon::parse($transaksi->tanggal_selesai)->translatedFormat('l, d F Y'),
                    'total_berat' => rtrim(rtrim(number_format($transaksi->total_berat, 2, '.', ''), '0'), '.') . ' Kg', // Format berat
                    'total_harga' => 'RP. ' . number_format($transaksi->total_harga, 0, ',', '.'),
                ];
            });
    }

    public function headings(): array
    {
        return ['No Invoice', 'Nama', 'Jenis Service', 'Tanggal Order', 'Tanggal Selesai', 'Berat', 'Harga'];
    }

    // Menentukan lebar kolom
    public function columnWidths(): array
    {
        return [
            'A' => 20, // No Invoice
            'B' => 25, // Nama
            'C' => 25, // Jenis Service
            'D' => 25, // Tanggal Order
            'E' => 25, // Tanggal Selesai
            'F' => 15, // Berat
            'G' => 20, // Harga
        ];
    }

    // Menambahkan styling ke worksheet
    public function styles(Worksheet $sheet)
    {
        // Menentukan lebar kolom
        $sheet->getColumnDimension('A')->setWidth(20); // No Invoice
        $sheet->getColumnDimension('B')->setWidth(25); // Nama
        $sheet->getColumnDimension('C')->setWidth(25); // Jenis Service
        $sheet->getColumnDimension('D')->setWidth(25); // Tanggal Order
        $sheet->getColumnDimension('E')->setWidth(25); // Tanggal Selesai
        $sheet->getColumnDimension('F')->setWidth(15); // Berat
        $sheet->getColumnDimension('G')->setWidth(20); // Harga

        // Menambahkan border dan styling lainnya
        $sheet->getStyle('A1:G1')->getFont()->setBold(true); // Font Bold
        $sheet->getStyle('A1:G1')->getAlignment()->setHorizontal('center'); // Teks di tengah
        $sheet->getStyle('A1:G1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN); // Border

        // Memberikan warna latar belakang pada header (A1:G1)
        $sheet->getStyle('A1:G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A1:G1')->getFill()->getStartColor()->setRGB('FFFF00'); // Mengatur warna latar belakang header (kuning)

        // Mengatur border di seluruh area data
        $sheet
            ->getStyle('A2:G' . $sheet->getHighestRow())
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->getStyle('A2:G1000')->getAlignment()->setHorizontal('center')->setVertical('center');
    }
}
