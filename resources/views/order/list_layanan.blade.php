@extends('layouts.pelanggan.master')
@section('title', 'Daftar Layanan')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5 d-flex justify-content-center">
                <img class="img-fluid" src="{{ asset('assets/front_asset/image/Girl cleaning mirror.png') }}" alt=""
                    width="300px">
            </div>
            <div class="col-md-7 my-auto">
                <h1 class="tagline"><span>Tinggkatkan</span> Pengalaman Anda Bersama Kami!</h1>
                <h2 class="sub-herro-tagline mt-4">Jelajahi layanan kami dan temukan pilihan yang paling cocok untuk bisnis
                    atau
                    kebutuhan Anda</h2>
            </div>
            <div class="row mt-5">
                @foreach ($listLayanan as $service)
                    <div class="col-md-4 mb-4 d-flex">
                        <div class="card h-100 d-flex flex-column " style="width: 100%;">
                            <img src="{{ asset('assets/front_asset/image/ecology t-shirt.png') }}" class="card-img-top"
                                alt="...">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-center"><b>{{ $service->nama_service }}</b></h5>
                                <p class="card-text">{{ $service->deskripsi }}</p>
                                <p class="card-text">Rp. {{ $service->harga }}</p>
                                <a href="#" class="btn btn-order mt-auto" data-bs-toggle="modal"
                                    data-bs-target="#konfirmasiModal">Order Sekarang</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Modal Konfirmasi -->
                <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content text-center p-4">
                            <div class="modal-body">
                                <h5 class="mb-4">Apakah kamu akan<br>Melakukan Order Berikut?</h5>
                                <div class="d-flex justify-content-center gap-3">
                                    <button type="button" class="btn btn-outline-warning"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-warning text-white" id="btnLanjut">Lanjut</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('btnLanjut').addEventListener('click', function() {
            // Lakukan redirect ke halaman checkout/order detail
            window.location.href = '/order/lanjut'; // Ganti dengan URL tujuan
        });
    </script>
@endsection
