@extends('layouts.pelanggan.master')
@section('title', 'Riwayat Order')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex justify-content-center">
                <img class="img-fluid" src="{{ asset('assets/front_asset/image/loop.png') }}" alt="" width="300px">
            </div>
            <div class="col-md-6 my-auto">
                <h1 class="tagline"><span class="batas-tagline">Pantau Setiap</span> Langkah Proses Cucian Anda Di sini !</h1>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-md-4 scrolling-card">
                @if ($transaksis->isEmpty())
                    <p class="text-muted">Belum ada riwayat transaksi.</p>
                @else
                    @foreach ($transaksis as $transaksi)
                        <div class="card mb-3 shadow p-3 bg-body-tertiary order-card"
                            style="border-radius: 20px; cursor: pointer;" data-id="{{ $transaksi->id }}">
                            <div class="card-body">
                                <h6 class="card-title font-weight-bold service-title">
                                    {{ $transaksi->Service->nama_service }}
                                </h6>
                                <p class="card-text text-muted mt-3 my-2">no Invoice : <b>{{ $transaksi->no_invoice }}</b>
                                </p>
                                <p class="card-text text-muted my-2">Order
                                    :{{ \Carbon\Carbon::parse($transaksi->tanggal_order)->translatedFormat('d F Y') }}</p>
                                <span
                                    class="btn btn-outline-primary btn-sm rounded-pill float-end disabled">{{ $transaksi->status_transaksi }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="col-md-8">
                <div class="card p-4 detail-card" style="border-radius: 20px;" id="order-stepper">
                    <h5 class="text-center text-muted">Pilih order untuk melihat detail proses</h5>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.order-card').on('click', function() {
                var orderId = $(this).data('id');

                // Hapus kelas aktif dari semua kartu
                $('.order-card').removeClass('active');

                // Tambahkan kelas aktif ke kartu yang diklik
                $(this).addClass('active');

                // Muat konten stepper dari server
                $.ajax({
                    url: '/riwayat-order/detail/' +
                        orderId, // Menggunakan concatenation untuk menyisipkan orderId
                    method: 'GET',
                    success: function(response) {
                        $('#order-stepper').html(response);
                    },
                    error: function() {
                        $('#order-stepper').html(
                            '<p class="text-danger">Gagal memuat data order.</p>'
                        );
                    }
                });
            });
        });
    </script>

@endsection
