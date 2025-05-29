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
                <div class="row mb-3">
                    <div class="col-12 col-md-6 text-center text-md-start">
                        <h5 class="card-title mb-2 mb-md-0">List Validasi Data Pesanan</h5>
                    </div>
                    <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                        <div class="dropdown">
                            <button class="btn custom-dropdown-toggle d-flex justify-content-between align-items-center"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>Pilih Status Order</span>
                                <i class="bi bi-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu custom-dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('order-list-validasi') }}">Proses Validasi</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('order-list-diproses') }}">Sedang Di Proses</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('order-list-pembayaran') }}">Belum Di Bayar</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center align-middle">
                                <th scope="col">No</th>
                                <th scope="col">No Invoice</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jenis Service</th>
                                <th scope="col">Tanggal Order</th>
                                <th scope="col">Status Pembayaran</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse ($listOrderPembayaran as $key => $item)
                                <tr class="text-center">
                                    <th scope="row">{{ $listOrderPembayaran->firstItem() + $key }}</th>
                                    <td>{{ $item->no_invoice }}</td>
                                    <td>{{ $item->Pelanggan->user->name ?? '-' }}</td>
                                    <td>{{ $item->Service->nama_service ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_order)->translatedFormat('l, d F Y') }}
                                    </td>
                                    <td>
                                        @php
                                            $status = $item->Pembayaran->status_pembayaran ?? 'Belum Dibayar';
                                        @endphp
                                        <span
                                            class="badge 
                                        @if ($status == 'berhasil') bg-success  
                                        @elseif($status == 'menunggu') bg-warning text-dark  
                                        @else bg-secondary @endif">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if (optional($item->Pembayaran)->jenis_pembayaran === 'cash' &&
                                                optional($item->Pembayaran)->status_pembayaran === 'pending')
                                            <form action="{{ route('admin.validasi.cash', $item->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-success btn-sm"
                                                    onclick="return confirm('Validasi pembayaran cash ini?')">
                                                    Validasi Pembayaran
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted">Tidak tersedia</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Data Kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end my-4">
                    {{ $listOrderPembayaran->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
