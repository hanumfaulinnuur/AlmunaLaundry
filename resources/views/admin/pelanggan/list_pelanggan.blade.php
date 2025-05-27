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
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mt-4">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Email</th>
                                <th scope="col">NoTelepon</th>
                                <th scope="col">Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pelanggan as $key => $item)
                                <tr>
                                    <th scope="row" class="text-center">{{ $pelanggan->firstitem() + $key }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td class="text-center ">{{ $item->pelanggan->no_telepon ?? '-' }}</td>
                                    <td class="text-center">{!! $item->pelanggan && $item->pelanggan->latitude && $item->pelanggan->longitude
                                        ? '<a class="btn btn-sm btn-success" href="https://www.google.com/maps?q=' .
                                            $item->pelanggan->latitude .
                                            ',' .
                                            $item->pelanggan->longitude .
                                            '" target="_blank"><i class="bi bi-geo-fill"></i></a>'
                                        : '-' !!}</td>
                                </tr>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Data kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end my-4">
                    {{ $pelanggan->links() }}
                </div>
            </div>
        </div>
    </main>

@endsection
