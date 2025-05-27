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
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">No Invoice</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jenis Service</th>
                                <th scope="col">Tanggal Order</th>
                                <th scope="col">Berat</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse ($listOrderProses as $key => $item)
                                <tr class="text-center">
                                    <th scope="row">{{ $listOrderProses->firstItem() + $key }}</th>
                                    <td>{{ $item->no_invoice }}</td>
                                    <td>{{ $item->Pelanggan->user->name ?? '-' }}</td>
                                    <td>{{ $item->Service->nama_service ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_order)->translatedFormat('l, d F Y') }}
                                    </td>
                                    <td>{{ rtrim(rtrim(number_format($item->total_berat, 2, '.', ''), '0'), '.') }}
                                        Kg</td>
                                    <td>RP. {{ $item->total_harga }}</td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalKonfirmasi{{ $item->id }}">
                                            Konfirmasi
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalKonfirmasi{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content text-center"
                                                    style="border-radius: 10px; padding: 20px;">
                                                    <div class="modal-body">
                                                        <p class="fw-bold" style="font-size: 20px;">Apakah Orderan Sudah
                                                            Selesai ? <br> Silahkan Lakukan Konfirmasi</p>
                                                        <div class="d-flex justify-content-center mt-4 gap-3">
                                                            <button type="button" class="btn btn-outline-primary px-4"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <form
                                                                action="{{ route('order.proses.konfirmasi', $item->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit"
                                                                    class="btn btn-primary px-4">Lanjut</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Data kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end my-4">
                    {{ $listOrderProses->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
