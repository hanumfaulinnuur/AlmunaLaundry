@extends('layouts.pelanggan.master')
@section('title', 'Profil')
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
                    <div style="width: 100%;">
                        <h4 class="section-title-profile">Detail Profil </h4>
                        <table class="table table-custom identitas field">
                            <tbody>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>:</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>No Telepon</th>
                                    <td>:</td>
                                    <td>{{ $pelanggan->no_telepon ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>:</td>
                                    <td>{{ $pelanggan->alamat ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <a href="{{ route('profile.form.edit') }}" class="btn btn-warning text-white fw-semibold px-4">Ubah
                            Profil</a>

                    </div>
                </div>
                <div class="card shadow p-5 bg-body-tertiary rounded mb-5">
                    <h4 class="section-title-profile mb-4">Ubah Kata Sandi </h4>
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
@endsection
