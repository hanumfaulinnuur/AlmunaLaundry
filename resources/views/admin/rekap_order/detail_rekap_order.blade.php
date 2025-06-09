@extends('layouts.admin.master')
@section('title', 'Detail Rekap Data Order')
@section('content')
    <main id="main" class="main">
        <div class="card p-4">
            <div class="card-body">
                <h5 class="card-title">Detail Rekap Data Order</h5>
                <hr>

                <div class="mb-4" style="max-width: 400px;">
                    <div class="d-flex justify-content-between align-items-start py-3 px-2">
                        <span class="fw-semibold fs-5">Total Order Masuk : </span>
                        <span class="fs-5">{{ $totalOrderMasuk }} Order Masuk</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-start py-3 px-2">
                        <span class="fw-semibold fs-5">Total Order Selesai : </span>
                        <span class="fs-5">{{ $totalOrderSelesai }} Order Selesai</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-start py-3 px-2">
                        <span class="fw-semibold fs-5">Jumlah : </span>
                        <span class="fs-5">Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}, 00</span>
                    </div>
                </div>
                <a href="{{ route('rekap-order-selesai') }}" class="btn btn-danger me-2"><i
                        class="bi bi-arrow-left-circle"></i> Kembali</a>
            </div>
        </div>
    </main>
@endsection
