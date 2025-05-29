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
                        <h5 class="card-title">Saldo Tersisa</h5>
                        <h5>Rp.{{ number_format($saldo, 0, ',', '.') }},00</h5>
                        <a href="{{ route('isi.saldo') }}" class="btn btn-danger">Top Up Saldo</a>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow p-5 bg-body-tertiary rounded mb-5">
                    <div style="width: 100%;">
                        <h4 class="section-title-profile">Riwayat Transaksi</h4>
                        <div class="container mt-4 transaction-scroll-saldo ">
                            @if ($riwayat->isEmpty())
                                <p class="text-muted">Belum ada riwayat transaksi.</p>
                            @else
                                @foreach ($riwayat as $item)
                                    <div class="row align-items-center transaction-item mb-3">
                                        <div class="col-auto">
                                            <div
                                                class="icon-circle {{ $item->jenis_transaksi == 'debit' ? 'bg-danger' : 'bg-success' }}">
                                                <i
                                                    class="bi {{ $item->jenis_transaksi == 'debit' ? 'bi-credit-card' : 'bi-wallet2' }}"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="fw-bold">
                                                {{ $item->jenis_transaksi == 'debit' ? 'Pembayaran Order' : 'Isi Saldo' }}
                                            </div>
                                            <small>{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->translatedFormat('l, d F Y H:i') }}</small>
                                        </div>
                                        <div
                                            class="col-auto {{ $item->jenis_transaksi == 'debit' ? 'text-red' : 'text-green' }}">
                                            {{ $item->jenis_transaksi == 'debit' ? '-' : '+' }}Rp.
                                            {{ number_format($item->nominal, 0, ',', '.') }}
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
