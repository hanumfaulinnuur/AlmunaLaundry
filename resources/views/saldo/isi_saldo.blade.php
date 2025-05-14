@extends('layouts.pelanggan.master')
@section('title', 'saldo')
@section('content')
    <div class="container">
        <div class="row justify-content-center gap-4 mt-5">
            {{-- Sidebar Kiri --}}
            <div class="col-md-3">
                <div class="card text-center shadow p-3 mb-5 bg-body-tertiary rounded">
                    <div class="p-3">
                        <img class="img-fluid" src="{{ asset('assets/front_asset/image/avatar person.png') }}" alt="avatar"
                            width="100px">
                    </div>
                    <div class="py-4">
                        <h5 class="card-title"><b>Selamat Datang !</b></h5>
                        <h5 class="card-title">{{ Auth::user()->name }}</h5>
                        <hr>
                        <h5 class="card-title">Saldo Tersisa</h5>
                        <h5>Rp.10.000,00</h5>
                    </div>
                </div>
            </div>

            {{-- Isi Saldo --}}
            <div class="col-md-8">
                <div class="card shadow p-5 bg-body-tertiary rounded mb-5">
                    <h4 class="section-title-profile">Isi Saldo</h4>
                    <div class="row my-4 g-3">

                        {{-- Kartu Saldo (hardcoded) --}}
                        <div class="col-md-4">
                            <div class="border rounded text-center p-3 shadow-sm">
                                <h5><b>Isi Ulang Saldo</b></h5>
                                <h6 class="text-danger">Rp. 10.000</h6>
                                <button class="btn btn-warning text-white mt-2 w-75 rounded">Beli</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded text-center p-3 shadow-sm">
                                <h5><b>Isi Ulang Saldo</b></h5>
                                <h6 class="text-danger">Rp. 30.000</h6>
                                <button class="btn btn-warning text-white mt-2 w-75 rounded">Beli</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded text-center p-3 shadow-sm">
                                <h5><b>Isi Ulang Saldo</b></h5>
                                <h6 class="text-danger">Rp. 50.000</h6>
                                <button class="btn btn-warning text-white mt-2 w-75 rounded">Beli</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded text-center p-3 shadow-sm">
                                <h5><b>Isi Ulang Saldo</b></h5>
                                <h6 class="text-danger">Rp. 100.000</h6>
                                <button class="btn btn-warning text-white mt-2 w-75 rounded">Beli</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded text-center p-3 shadow-sm">
                                <h5><b>Isi Ulang Saldo</b></h5>
                                <h6 class="text-danger">Rp. 150.000</h6>
                                <button class="btn btn-warning text-white mt-2 w-75 rounded">Beli</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded text-center p-3 shadow-sm">
                                <h5><b>Isi Ulang Saldo</b></h5>
                                <h6 class="text-danger">Rp. 200.000</h6>
                                <button class="btn btn-warning text-white mt-2 w-75 rounded">Beli</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
