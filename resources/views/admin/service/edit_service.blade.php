@extends('layouts.admin.master')
@section('title', 'Edit Layanan')
@section('content')
    <main id="main" class="main">
        <div class="card p-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Edit Service Layanan</h5>
                </div>
                <hr>
                <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
                    @csrf
                    @method('put')
                    {{-- nama service --}}
                    <div class="row mb-3">
                        <label for="nama_service" class="col-sm-2 col-form-label">Nama Srvice Layanan</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_service" value="{{ $service->nama_service }}"
                                class="form-control">
                        </div>
                    </div>
                    {{-- deskripsi --}}
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="deskripsi" style="height: 100px">{{ $service->deskripsi }}</textarea>
                        </div>
                    </div>
                    {{-- harga --}}
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="number" name="harga" value="{{ $service->harga }}" class="form-control">
                        </div>
                    </div>
                    {{-- tombol aksi --}}
                    <div class="d-flex justify-content-start mt-5 gap-2">
                        <a href="{{ route('admin.services.index') }}" class="btn btn-danger me-2"><i
                                class="bi bi-arrow-left-circle"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-file-earmark-check"></i>
                            Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
