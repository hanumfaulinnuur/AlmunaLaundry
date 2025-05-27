@extends('layouts.admin.master')
@section('title', 'List Layanan')
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
                    <h5 class="card-title mb-0">List Service Layanan</h5>
                    <a class="btn btn-primary mt-4 me-4" href="{{ route('admin.services.create') }}">Tambah Layanan</a>
                </div>
                <hr>
                <table class="table table-striped table-bordered mt-4">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nama Service</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($service as $key => $item)
                            <tr>
                                <th scope="row" class="text-center">{{ $service->firstItem() + $key }}</th>
                                <td>{{ $item->nama_service }}</td>
                                <td class="td-deskripsi">{{ $item->deskripsi }}</td>
                                <td>RP. {{ $item->harga }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a class="btn btn-primary" href="{{ route('admin.services.edit', $item->id) }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapus{{ $item->id }}">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </div>

                                    <!-- Modal tetap di luar div d-flex -->
                                    <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="modalHapusLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalHapusLabel{{ $item->id }}">
                                                        Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah kamu yakin ingin menghapus layanan
                                                    <strong>{{ $item->nama_service }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('admin.services.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Data kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-end my-4">
                    {{ $service->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
