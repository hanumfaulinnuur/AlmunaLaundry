@extends('layouts.pelanggan.master')
@section('title', 'Lacak Status')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 my-auto">
                <h1 class="tagline"><span class="batas-tagline">Pantau Setiap</span> Langkah Proses Cucian Anda Di sini !</h1>
                <h2 class="sub-herro-tagline mt-4">"Cari tahu proses cucian Anda hanya dengan satu langkah saja"</h2>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <img class="img-fluid" src="{{ asset('assets/front_asset/image/loop.png') }}" alt="" width="300px">
            </div>
        </div>
        <div class="container mt-2">

            <!-- Filter Input -->
            <div class="row my-4 mb-5">
                <div class="col-md-4 d-flex">
                    <input type="text" id="filterbyname" class="form-control py-3 me-2" placeholder="Inputkan nama mu !">
                    <button id="searchButton" class="btn btn-warning text-white w-25">Cari</button>
                </div>
            </div>

            <!-- Table untuk looping -->
            <div class="table-responsive mb-5">
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
                        <!-- Baris Pesan Default -->
                        <tr id="defaultMessageRow" class="text-center">
                            <td colspan="6">Cek Status Pesanan Anda</td>
                        </tr>

                        @foreach ($lacakStatus as $index => $transaksi)
                            <tr class="text-center">
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $transaksi->no_invoice }}</td>
                                <td class="nama-transaksi">{{ $transaksi->Pelanggan->user->name ?? '-' }}</td>
                                <td>{{ $transaksi->Service->nama_service ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_order)->translatedFormat('l, d F Y') }}
                                </td>
                                <td
                                    class="{{ $transaksi->status_transaksi == 'selesai' ? 'text-success' : 'text-warning' }}">
                                    <b>{{ $transaksi->status_transaksi }}</b>
                                </td>
                            </tr>
                        @endforeach

                        <!-- Pesan Tidak Ditemukan -->
                        <tr id="noDataMessage" class="text-center" style="display: none;">
                            <td colspan="6">Maaf, data yang Anda cari tidak ditemukan!</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Menampilkan pesan "Cek Status Pesanan Anda" saat halaman pertama kali dibuka
            $('#defaultMessageRow').show();
            $('#tableBody tr:not(#defaultMessageRow)').hide(); // Sembunyikan semua baris data

            $('#noDataMessage').hide(); // Menyembunyikan pesan tidak ada data

            // Menangani input pada kolom pencarian hanya ketika tombol "Lihat Status" diklik
            $('#searchButton').on('click', function() {
                var searchValue = $('#filterbyname').val().toLowerCase();
                var found = false; // Flag untuk mengecek apakah ada hasil yang ditemukan

                // Menyembunyikan tabel jika tidak ada inputan
                if (searchValue === '') {
                    $('#tableBody tr').hide();
                    $('#defaultMessageRow').show(); // Menampilkan pesan default
                    $('#noDataMessage').hide();
                } else {
                    // Menampilkan data jika ada inputan
                    $('#tableBody tr').show();
                    $('#defaultMessageRow').hide(); // Menyembunyikan pesan default saat pencarian

                    // Filter hanya berdasarkan kolom "Nama"
                    $('#tableBody tr').each(function() {
                        var nameCell = $(this).find('td.nama-transaksi').text()
                            .toLowerCase(); // Mencari kolom "Nama"
                        if (nameCell.indexOf(searchValue) > -1) {
                            $(this).show();
                            found = true;
                        } else {
                            $(this).hide();
                        }
                    });

                    // Menampilkan pesan jika tidak ada data yang ditemukan
                    if (!found) {
                        $('#noDataMessage').show();
                    } else {
                        $('#noDataMessage').hide();
                    }
                }
            });
        });
    </script>
@endsection
