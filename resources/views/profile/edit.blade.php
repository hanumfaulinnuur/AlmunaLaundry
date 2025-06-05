@extends('layouts.pelanggan.master')

@section('title', 'Profil')

@section('content')
    <div class="container">
        <div class="row justify-content-center gap-2 mt-5">
            {{-- Card untuk slide nama --}}
            <div class="col-12 col-md-3">
                <div class="card text-center shadow p-3 mb-3 bg-body-tertiary rounded">
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

            {{-- Detail profil dan update password --}}
            <div class="col-12 col-md-8">
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

                {{-- Form Ubah Kata Sandi --}}
                <div class="card shadow p-5 bg-body-tertiary rounded mb-5">
                    <h4 class="section-title-profile mb-4">Ubah Kata Sandi </h4>
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>

    {{-- Modal sukses update profil --}}
    @if (session('status') === 'profile-updated')
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center">
                    <div class="modal-body pt-5 px-3">
                        <img src="{{ asset('assets/front_asset/image/done.png') }}" alt="Order Process" width="15%">
                        <h5 class="my-4">Data Profil Berhasil Diperbarui !</h5>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Modal sukses update password --}}
    @if (session('status') === 'password-updated')
        <div class="modal fade" id="successPasswordModal" tabindex="-1" aria-labelledby="successPasswordModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center">
                    <div class="modal-body pt-5 px-3">
                        <img src="{{ asset('assets/front_asset/image/done.png') }}" alt="Order Process" width="15%">
                        <h5 class="my-4">Kata Sandi Berhasil Diperbarui !</h5>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Script untuk modal --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('status') === 'profile-updated')
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();

                setTimeout(function() {
                    successModal.hide();
                }, 2000);
            @endif

            @if (session('status') === 'password-updated')
                var successPasswordModal = new bootstrap.Modal(document.getElementById('successPasswordModal'));
                successPasswordModal.show();

                setTimeout(function() {
                    successPasswordModal.hide();
                }, 2000);
            @endif
        });
    </script>
@endsection
