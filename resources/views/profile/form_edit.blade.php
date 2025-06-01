@extends('layouts.pelanggan.master')

@section('title', 'Edit Profil')

@section('content')
    <div class="container">
        <div class="row justify-content-center gap-4 mt-5">
            {{-- Sidebar Profile --}}
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

            {{-- Form Edit --}}
            <div class="col-md-8 col-12">
                <div class="card shadow p-5 bg-body-tertiary rounded mb-5">
                    <h4 class="section-title-profile mb-4">Ubah Detail Profil</h4>

                    <div class=".form-input-profile">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PATCH')

                            {{-- Nama --}}
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="name" class="form-label fw-semibold field">Nama Lengkap</label>
                                </div>
                                <div class="col-md-8">
                                    <input id="name" name="name" type="text"
                                        class="form-control input-profile w-100 field"
                                        value="{{ old('name', $user->name) }}">
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="email" class="form-label fw-semibold field">Email</label>
                                </div>
                                <div class="col-md-8">
                                    <input id="email" name="email" type="email" class="form-control w-100 field"
                                        value="{{ old('email', $user->email) }}">
                                </div>
                            </div>

                            {{-- Nomor Telepon --}}
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="no_telepon" class="form-label fw-semibold field">No Telepon</label>
                                </div>
                                <div class="col-md-8">
                                    <input id="no_telepon" name="no_telepon" type="number" class="form-control w-100 field"
                                        value="{{ old('no_telepon', $user->pelanggan->no_telepon ?? '') }}">
                                </div>
                            </div>

                            {{-- Alamat --}}
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="alamat" class="form-label fw-semibold field">Alamat</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea id="alamat" name="alamat" class="form-control w-100 field" rows="5">{{ old('alamat', $user->pelanggan->alamat ?? '') }}</textarea>
                                </div>
                            </div>

                            {{-- Koordinat --}}
                            <input type="hidden" id="latitude" name="latitude"
                                value="{{ old('latitude', $user->pelanggan->latitude ?? '') }}">
                            <input type="hidden" id="longitude" name="longitude"
                                value="{{ old('longitude', $user->pelanggan->longitude ?? '') }}">

                            {{-- Peta --}}
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold field">Masukan Titik Lokasi</label>
                                </div>
                                <div class="col-md-8">
                                    <div id="map" style="height: 400px; border: 1px solid #ccc;"></div>
                                </div>
                            </div>

                            {{-- Tombol Submit --}}
                            <div class="mt-4">
                                <a href="{{ route('profile.edit') }}"
                                    class="btn btn-outline-warning fw-semibold px-4">Kembali</a>
                                <button type="submit" class="btn btn-warning text-white fw-semibold px-4">Ubah
                                    Profil</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CDN Leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    {{-- Script Leaflet dengan Geolocation --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Koordinat default dari server/database, atau fallback ke Jakarta jika kosong
            var defaultLat = parseFloat("{{ old('latitude', $user->pelanggan->latitude ?? '-6.2') }}");
            var defaultLng = parseFloat("{{ old('longitude', $user->pelanggan->longitude ?? '106.816666') }}");

            var map = L.map('map').setView([defaultLat, defaultLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([defaultLat, defaultLng], {
                draggable: true
            }).addTo(map);

            function updateInput(latlng) {
                document.getElementById('latitude').value = latlng.lat.toFixed(7);
                document.getElementById('longitude').value = latlng.lng.toFixed(7);
            }

            updateInput(marker.getLatLng());

            marker.on('dragend', function(e) {
                updateInput(e.target.getLatLng());
            });

            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                updateInput(e.latlng);
            });

            // Gunakan Geolocation API jika tersedia dan user mengizinkan
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        var userLat = position.coords.latitude;
                        var userLng = position.coords.longitude;

                        // Update peta ke lokasi device
                        map.setView([userLat, userLng], 13);

                        // Update posisi marker
                        marker.setLatLng([userLat, userLng]);

                        // Update nilai input
                        updateInput(marker.getLatLng());
                    },
                    function(error) {
                        console.warn('Geolocation error:', error.message);
                        // Jika error, tetap pakai default
                    }
                );
            } else {
                console.warn('Geolocation not supported by this browser.');
                // Jika tidak support geolocation, pakai default
            }
        });
    </script>
@endsection
