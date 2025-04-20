@extends('layouts.pelanggan.master')
@section('title', 'saldo')
@section('content')
    <div class="container">
        <div class="row justify-content-center gap-4 mt-5">
            {{-- card untuk slide nama --}}
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
                        <h5 class="card-title">Slado Tersisa</h5>
                        <h5>Rp.10.000,00</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow p-5 bg-body-tertiary rounded mb-5">
                    <div style="width: fit-content;">
                        <h4 class="section-title-profile">Riwayat Transaksi </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
