@extends('layouts.pelanggan.master')
@section('title', 'Invoice Transaksi')
@section('content')
    <div class="container my-5">
        <div class="card mx-auto shadow p-4" style="max-width: 420px; border-radius: 20px;">
            <h4 class="text-center fw-bold mb-3">Transaksi Berhasil</h4>
            <div class="text-center mb-3">
                <img src="{{ asset('assets/front_asset/image/invoice.png') }}" alt="avatar" class="rounded-circle"
                    width="20%">
            </div>

            <h6 class="fw-semibold mb-2">Rincian Transaksi</h6>
            <div class="d-flex justify-content-between">
                <span class="text-muted">Metode Pembayaran</span>
                <span>{{ ucfirst($pembayaran->jenis_pembayaran ?? '-') }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-muted">Status</span>
                <span class="{{ $transaksi->status_transaksi == 'selesai' ? 'text-success' : 'text-warning' }} fw-semibold">
                    {{ ucfirst($transaksi->status_transaksi) }}
                </span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-muted">Waktu</span>
                <span>{{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran ?? $transaksi->updated_at)->format('H:i') }}
                    WIB</span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-muted">Tanggal</span>
                <span>{{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran ?? $transaksi->updated_at)->translatedFormat('d F Y') }}</span>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <span class="text-muted">ID Transaksi</span>
                <span>{{ $transaksi->no_invoice }}</span>
            </div>

            <h6 class="fw-semibold mt-3 mb-2">Rincian Pesan</h6>
            <div class="d-flex justify-content-between">
                <span>{{ $transaksi->Service->nama_service ?? '-' }}</span>
                <span><small class="text-end">{{ rtrim(rtrim(number_format($transaksi->total_berat, 1), '0'), '.') }} kg
                    </small> <br> Rp.
                    {{ number_format($transaksi->service->harga, 0, ',', '.') }}</span>
            </div>

            <hr>
            <div class="d-flex justify-content-between">
                <span class="text-muted">Subtotal</span>
                <span>Rp. {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <span class="text-muted">Biaya Admin</span>
                <span>Rp. 0</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between fw-bold">
                <span>Total Biaya</span>
                <span class="text-dark">Rp. {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('riwayat.order') }}" class="text-primary text-decoration-none fw-semibold">Kembali Ke
                    Riwayat</a>
                <a href="#" class="text-danger text-decoration-none fw-semibold">Download PDF</a>
            </div>
        </div>
    </div>
@endsection
