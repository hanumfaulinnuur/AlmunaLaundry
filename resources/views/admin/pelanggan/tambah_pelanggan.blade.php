@extends('layouts.admin.master')
@section('title', 'Tambah Pelanggan')
@section('content')
    <main id="main" class="main">
        <div class="card p-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Tambah Service Layanan</h5>
                </div>
                <hr>
                <form action="{{ route('proses.tambah.pelanggan') }}" method="POST">
                    @csrf
                    {{-- nama pelanggan --}}
                    <div class="row mb-3">
                        <label for="nama_service" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    {{-- email --}}
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Alamat Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control">
                        </div>
                    </div>
                    {{-- tombol aksi --}}
                    <div class="d-flex justify-content-start mt-5 gap-2">
                        <a href="{{ route('list.pelanggan') }}" class="btn btn-danger me-2"><i
                                class="bi bi-arrow-left-circle"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-file-earmark-check"></i>
                            Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
