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
                <h1 class="tagline"><span>Tingkatkan</span> Pengalaman Anda Bersama Kami!</h1>
                <h2 class="sub-herro-tagline mt-4">Jelajahi layanan kami dan temukan pilihan yang paling cocok untuk bisnis
                    atau kebutuhan Anda</h2>
            </div>
        </div>

        <div class="row mt-5">
            @foreach ($listLayanan as $service)
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card h-100 d-flex flex-column" style="width: 100%;">
                        <img src="{{ asset('assets/front_asset/image/ecology t-shirt.png') }}" class="card-img-top"
                            alt="...">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-center"><b>{{ $service->nama_service }}</b></h5>
                            <p class="card-text">{{ $service->deskripsi }}</p>
                            <p class="card-text">Rp. {{ $service->harga }}</p>
                            <a href="#" class="btn btn-order mt-auto" data-id="{{ $service->id }}"
                                data-bs-toggle="modal" data-bs-target="#konfirmasiModal">
                                Order Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Modal Konfirmasi (hanya 1x, bukan di dalam foreach) -->
        <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center">
                    <div class="modal-body p-5">
                        <h5 class="mb-4">Apakah kamu akan <br> Melakukan Order Berikut?</h5>
                        <div class="d-flex justify-content-center gap-5">
                            <button type="button" class="btn btn-outline-warning btn-modal"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-order" id="btnLanjut">Order Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Notifikasi Order Sedang Diproses -->
        <div class="modal fade" id="orderProcessedModal" tabindex="-1" aria-labelledby="orderProcessedModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <!-- Tombol close di sini -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-5">
                        <img src="{{ asset('assets/front_asset/image/admin.png') }}" alt="Order Process" width="20%">
                        <h5 class="mt-4">Order Kamu Sedang Diproses, Silahkan Konfirmasi Admin</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Hidden -->
        <form id="formOrder" action="{{ route('order.store') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="id_service" id="idServiceInput">
        </form>
    </div>

    <script>
        let selectedServiceId = null;

        // Tangkap klik dari semua tombol "Order Sekarang" di kartu
        document.querySelectorAll('.btn-order[data-id]').forEach(button => {
            button.addEventListener('click', function() {
                selectedServiceId = this.getAttribute('data-id');
            });
        });

        // Saat klik "Order Sekarang" di dalam modal
        document.getElementById('btnLanjut').addEventListener('click', function() {
            if (selectedServiceId) {
                document.getElementById('idServiceInput').value = selectedServiceId;
                document.getElementById('formOrder').submit();

                // Tampilkan modal order sedang diproses setelah order berhasil
                $('#konfirmasiModal').modal('hide'); // Tutup modal konfirmasi
                $('#orderProcessedModal').modal('show'); // Tampilkan modal order sedang diproses
            }
        });
    </script>
@endsection
