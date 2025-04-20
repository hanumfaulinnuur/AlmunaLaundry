@extends('layouts.admin.master')
@section('title', 'List Pelanggan')
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
                    <h5 class="card-title mb-0">List Data Pelanggan</h5>
                    <a class="btn btn-primary mt-4 me-4" href="{{ route('tambah.pelanggan') }}">Tambah Pelanggan</a>
                </div>
                <hr>
                <table class="table table-striped table-bordered mt-4">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Email</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelanggan as $key => $pelanggan)
                            <tr>
                                <th scope="row" class="text-center">{{ $key + 1 }}</th>
                                <td>{{ $pelanggan->name }}</td>
                                <td>{{ $pelanggan->email }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Data kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

@endsection
