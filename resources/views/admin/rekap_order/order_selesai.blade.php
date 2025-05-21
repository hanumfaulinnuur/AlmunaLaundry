@extends('layouts.admin.master')
@section('title', 'List Order Selesai')
@section('content')
    <main id="main" class="main">
        <div class="card p-4">
            <div class="card-body">
                <h5 class="card-title mb-0">List Rekap Data Order</h5>
                <div class="d-flex gap-3">
                    <a href="{{ route('ekspor.excel') }}" class="btn btn-success">Ekspor Excel</a>
                    <button class="btn btn-primary">Lihat Detail</button>
                </div>
                <hr>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No Invoice</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Service</th>
                            <th scope="col">Tanggal Order</th>
                            <th scope="col">Tanggal Selesai</th>
                            <th scope="col">Berat</th>
                            <th scope="col">Harga</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse ($listOrderSelesai as $index => $listOrderSelesai)
                            <tr class="text-center">
                                <td>{{ $listOrderSelesai->no_invoice }}</td>
                                <td>{{ $listOrderSelesai->Pelanggan->user->name ?? '-' }}</td>
                                <td>{{ $listOrderSelesai->Service->nama_service ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($listOrderSelesai->tanggal_order)->translatedFormat('l, d F Y') }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($listOrderSelesai->tanggal_order)->translatedFormat('l, d F Y') }}
                                </td>
                                <td>{{ rtrim(rtrim(number_format($listOrderSelesai->total_berat, 2, '.', ''), '0'), '.') }}
                                    Kg</td>
                                <td>RP. {{ $listOrderSelesai->total_harga }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Data kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
