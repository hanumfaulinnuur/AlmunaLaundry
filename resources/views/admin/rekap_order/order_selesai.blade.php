@extends('layouts.admin.master')
@section('title', 'List Order Selesai')
@section('content')
    <main id="main" class="main">
        <div class="card p-4">
            <div class="card-body">
                <h5 class="card-title mb-0">List Rekap Data Order</h5>

                {{-- Tombol kiri dan filter kanan --}}
                <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 my-3">
                    {{-- Tombol di kiri --}}
                    <div class="d-flex gap-2">
                        <a href="{{ route('ekspor.excel') }}" class="btn btn-sm btn-success">Ekspor Excel</a>
                        <button class="btn btn-sm btn-primary">Lihat Detail</button>
                    </div>

                    {{-- Filter tanggal di kanan --}}
                    <form method="GET" action="{{ route('admin.beranda') }}"
                        class="d-flex flex-wrap gap-2 align-items-end">
                        <div class="d-flex flex-column">
                            <label for="start_date" class="form-label mb-1 small">Tanggal Mulai</label>
                            <input type="date" id="start_date" name="start_date" class="form-control form-control-sm"
                                value="{{ request('start_date') }}">
                        </div>
                        <div class="d-flex flex-column">
                            <label for="end_date" class="form-label mb-1 small">Tanggal Selesai</label>
                            <input type="date" id="end_date" name="end_date" class="form-control form-control-sm"
                                value="{{ request('end_date') }}">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-sm btn-primary mt-3">Filter</button>
                        </div>
                    </form>
                </div>

                <hr>

                {{-- Tabel --}}
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center align-middle">
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
                            @forelse ($listOrderSelesai as $item)
                                <tr class="text-center">
                                    <td>{{ $item->no_invoice }}</td>
                                    <td>{{ $item->Pelanggan->user->name ?? '-' }}</td>
                                    <td>{{ $item->Service->nama_service ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_order)->translatedFormat('l, d F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('l, d F Y') }}
                                    </td>
                                    <td>{{ rtrim(rtrim(number_format($item->total_berat, 2, '.', ''), '0'), '.') }} Kg</td>
                                    <td>Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Data kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-end my-4">
                    {{ $listOrderSelesai->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
