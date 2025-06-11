<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class RekapOrderEkspor implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = Transaksi::with(['Pelanggan', 'Service', 'Pembayaran'])
            ->where('status_transaksi', 'selesai');

        if ($this->startDate) {
            $query->whereDate('tanggal_selesai', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('tanggal_selesai', '<=', $this->endDate);
        }

        return $query->get()
            ->map(function ($transaksi) {
                return [
                    'no_invoice' => $transaksi->no_invoice,
                    'nama' => $transaksi->Pelanggan->user->name ?? '-',
                    'jenis_service' => $transaksi->Service->nama_service ?? '-',
                    'tanggal_order' => Carbon::parse($transaksi->tanggal_order)->translatedFormat('l, d F Y'),
                    'tanggal_selesai' => Carbon::parse($transaksi->tanggal_selesai)->translatedFormat('l, d F Y'),
                    'total_berat' => rtrim(rtrim(number_format($transaksi->total_berat, 2, '.', ''), '0'), '.') . ' Kg',
                    'total_harga' => 'RP. ' . number_format($transaksi->total_harga, 0, ',', '.'),
                    'metode_bayar' => $transaksi->Pembayaran->jenis_pembayaran ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return ['No Invoice', 'Nama', 'Jenis Service', 'Tanggal Order', 'Tanggal Selesai', 'Berat', 'Harga', 'Metode Pembayaran'];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 25,
            'C' => 25,
            'D' => 25,
            'E' => 25,
            'F' => 15,
            'G' => 20,
            'G' => 25,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        
        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(25);
        $sheet->getColumnDimension('F')->setWidth(15);
        $sheet->getColumnDimension('G')->setWidth(20);
        $sheet->getColumnDimension('H')->setWidth(25);

        
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
        $sheet->getStyle('A1:H1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:H1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        
        $sheet->getStyle('A1:H1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A1:H1')->getFill()->getStartColor()->setRGB('00b3ff');

        
        $sheet->getStyle('A2:H' . $sheet->getHighestRow())
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        
        $sheet->getStyle('A2:H' . $sheet->getHighestRow())
            ->getAlignment()
            ->setHorizontal('center')
            ->setVertical('center');
    }
}
