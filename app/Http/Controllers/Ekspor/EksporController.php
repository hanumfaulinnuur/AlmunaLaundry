<?php

namespace App\Http\Controllers\Ekspor;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\RekapOrderEkspor;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Order;

class EksporController extends Controller
{
    public function eksporInvoicePDF($id)
    {
        $transaksi = Transaksi::with('Service')->findOrFail($id);
        $pembayaran = DB::table('pembayarans')->where('id_transaksi', $id)->latest('tanggal_pembayaran')->first();

        $pdf = Pdf::loadView('ekspor.invoice_pdf', compact('transaksi', 'pembayaran'))->setPaper('A5', 'portrait');

        return $pdf->stream('invoice_' . $transaksi->no_invoice . '.pdf');
    }

    public function exportRekapOrderExcel(Request $request)
{
    $startDate = $request->query('start_date');
    $endDate = $request->query('end_date');

    return Excel::download(new RekapOrderEkspor($startDate, $endDate), 'Rekap.xlsx');
}
}
