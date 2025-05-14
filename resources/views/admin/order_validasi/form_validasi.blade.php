@extends('layouts.admin.master')
@section('title', 'Validasi Order')
@section('content')
    <main id="main" class="main">
        <div class="card p-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Validasi Order</h5>
                </div>
                <hr>
                <form action="{{ route('order.update', $validasi->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- nama pelanggan --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Pelanggan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $validasi->Pelanggan->user->name ?? '-' }}"
                                readonly>
                        </div>
                    </div>

                    {{-- jenis layanan --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Jenis Layanan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $validasi->Service->nama_service ?? '-' }}"
                                readonly>
                        </div>
                    </div>

                    {{-- tanggal pesan --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal Pesanan</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control"
                                value="{{ \Carbon\Carbon::parse($validasi->tanggal_order)->format('Y-m-d') }}" readonly>
                        </div>
                    </div>

                    {{-- berat --}}
                    <div class="row mb-3">
                        <label for="total_berat" class="col-sm-2 col-form-label">Berat (kg / Item)</label>
                        <div class="col-sm-10">
                            <input type="number" step="any" name="total_berat" id="total_berat"
                                class="form-control @error('total_berat') is-invalid @enderror">
                            @error('total_berat')
                                <div class="invalid-feedback">Wajib diisi</div>
                            @enderror
                        </div>
                    </div>

                    {{-- total harga --}}
                    <div class="row mb-3">
                        <label for="total_harga" class="col-sm-2 col-form-label">Total Harga</label>
                        <div class="col-sm-10">
                            <input type="number" name="total_harga" id="total_harga"
                                class="form-control @error('total_harga') is-invalid @enderror" readonly>
                        </div>
                    </div>

                    {{-- tombol aksi --}}
                    <div class="d-flex justify-content-start mt-5 gap-2">
                        <a href="{{ route('order-list-validasi') }}" class="btn btn-danger me-2">
                            <i class="bi bi-arrow-left-circle"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-file-earmark-check"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    {{-- Script untuk hitung total harga otomatis --}}
    @php
        $hargaPerKg = $validasi->Service->harga ?? 0;
    @endphp

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const beratInput = document.getElementById('total_berat');
            const totalHargaInput = document.getElementById('total_harga');
            const hargaPerKg = {{ $hargaPerKg }};

            function hitungTotal() {
                const berat = parseFloat(beratInput.value) || 0;
                const total = berat * hargaPerKg;
                totalHargaInput.value = total;
            }

            beratInput.addEventListener('input', hitungTotal);
            hitungTotal(); // Hitung saat pertama kali load
        });
    </script>
@endsection
