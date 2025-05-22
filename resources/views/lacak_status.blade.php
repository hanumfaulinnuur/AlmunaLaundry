@extends('layouts.pelanggan.master')
@section('title', 'Lacak Status')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 my-auto">
                <h1 class="tagline"><span class="batas-tagline">Pantau Setiap</span> Langkah Proses Cucian Anda Di sini !</h1>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <img class="img-fluid" src="{{ asset('assets/front_asset/image/loop.png') }}" alt="" width="300px">
            </div>
        </div>
        <div class="container mt-2">

            <!-- Filter Input -->
            <div class="row mb-3">
                <div class="col-md-4 d-flex">
                    <input type="text" id="filterbyname" class="form-control py-3 me-2" placeholder="Inputkan nama mu !">
                    <button class="btn btn-warning text-white w-50">Cari</button>
                </div>
            </div>

            <!-- Table untuk looping -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">No Invoice</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Service</th>
                            <th scope="col">Tanggal Order</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @foreach ($lacakStatus as $index => $transaksi)
                            <tr class="text-center">
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $transaksi->no_invoice }}</td>
                                <td>{{ $transaksi->Pelanggan->user->name ?? '-' }}</td>
                                <td>{{ $transaksi->Service->nama_service ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_order)->translatedFormat('l, d F Y') }}
                                </td>
                                <td
                                    class="{{ $transaksi->status_transaksi == 'selesai' ? 'text-success' : 'text-warning' }}">
                                    <b>{{ $transaksi->status_transaksi }}</b>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
