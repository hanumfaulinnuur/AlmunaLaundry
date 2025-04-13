@extends('layouts.admin.master')
@section('title', 'Beranda')
@section('content')
    <main id="main" class="main">
        <div class="container my-4">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="d-flex align-items-center p-3 ">
                            <div class="bg-primary text-white p-3 rounded-4 me-3 d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <i class="bi bi-person-bounding-box fs-3"></i>
                            </div>
                            <div>
                                <h5><b>Total Pelanggan</b></h5>
                                <div class="fw-bold fs-5">{{ $totalPelanggan }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
