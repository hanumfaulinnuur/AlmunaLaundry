@extends('layouts.admin.master')
@section('title', 'List Order')
@section('content')

    <main id="main" class="main">
        <div class="card p-4">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">List Validasi Data Pesanan</h5>
                    <div class="dropdown">
                        <button class="btn custom-dropdown-toggle d-flex justify-content-between align-items-center"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span>Pilih Status Order</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <ul class="dropdown-menu custom-dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('order-list-validasi') }}">Proses Validasi</a></li>
                            <li><a class="dropdown-item" href="{{ route('order-list-diproses') }}">Sedang Di Proses</a></li>
                            <li><a class="dropdown-item" href="{{ route('order-list-pembayaran') }}">Belum Di Bayar</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">No Invoice</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Service</th>
                            <th scope="col">Tanggal Order</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse ($listOrderPembayaran as $index => $listOrderPembayaran)
                            <tr class="text-center">
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $listOrderPembayaran->no_invoice }}</td>
                                <td>{{ $listOrderPembayaran->Pelanggan->user->name ?? '-' }}</td>
                                <td>{{ $listOrderPembayaran->Service->nama_service ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($listOrderPembayaran->tanggal_order)->translatedFormat('l, d F Y') }}
                                </td>
                                <td><a class="btn btn-danger disabled">Menunggu Pembayaran</a></td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Data Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
