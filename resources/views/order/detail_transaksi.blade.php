@extends('layouts.pelanggan.master')
@section('title', 'Detail Transaksi')
@section('content')
    {{-- PR CSS bagian height --}}
    <div class="container my-5 px-5" style="height:70vh">
        <div class="card shadow p-5" style="border-radius: 20px; ;">
            <h3 class=" my-5 section-title-detail">Detail Transaksi</h3>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Jenis Service</th>
                        <th>Harga Satuan</th>
                        <th>Berat</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $transaksi->Service->nama_service }}</td>
                        <td>Rp. {{ $transaksi->Service->harga }}</td>
                        <td>{{ $transaksi->total_berat }} kg</td>
                        <td>Rp. {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="text-end mt-4">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        id="dropdownMenuButton">
                        Pilih Metode Pembayaran
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 100vw; min-width: 100%;">
                        <li><a class="dropdown-item p-2" href="#">Pembayaran Cash</a></li>
                        <li><a class="dropdown-item p-2" href="#">Pembayaran Saldo</a></li>
                        <li><a class="dropdown-item p-2" href="#">Pembayaran Lainya</a></li>
                    </ul>
                </div>
            </div>








        </div>
    </div>
@endsection
