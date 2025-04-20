@extends('layouts.pelanggan.master')
@section('title', 'edit profil')
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
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow p-5 bg-body-tertiary rounded mb-5">
                    <div style="width: fit-content;">
                        <h4 class="section-title-profile">Ubah Detail Profil </h4>
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PATCH')
                            {{-- input nama --}}
                            <div class="row mb-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                                </div>
                                <div class="col-md-8">
                                    <input id="name" name="name" type="text" class="form-control input-profile"
                                        value="{{ old('name', $user->name) }}">
                                </div>
                            </div>
                            {{-- input email --}}
                            <div class="row mb-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                </div>
                                <div class="col-md-8">
                                    <input id="email" name="email" type="email" class="form-control"
                                        value="{{ old('email', $user->email) }}">
                                </div>
                            </div>
                            {{-- input nomor telepon --}}
                            <div class="row mb-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="no_telepon" class="form-label fw-semibold">No Telepon</label>
                                </div>
                                <div class="col-md-8">
                                    <input id="no_telepon" name="no_telepon" type="number" class="form-control"
                                        value="{{ old('no_telepon', $user->pelanggan->no_telepon ?? '') }}">
                                </div>
                            </div>
                            {{-- alamat --}}
                            <div class="row mb-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="alamat" class="form-label fw-semibold">Alamat</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea id="alamat" name="alamat" class="form-control" rows="5">{{ old('alamat', $user->pelanggan->alamat ?? '') }}</textarea>
                                </div>
                            </div>
                            {{-- button --}}
                            <button class="btn btn-warning text-white fw-semibold px-4">Ubah Profil</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
