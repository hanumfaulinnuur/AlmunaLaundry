@extends('layouts.pelanggan.master')

@section('title', 'Edit Profil')

@section('content')
    <div class="container">
        <div class="row justify-content-center gap-2 mt-5">
            {{-- Sidebar Profile --}}
            <div class="col-md-3">
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

                            {{-- Peta dan Tombol Update Lokasi --}}
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold field">Masukan Titik Lokasi</label>
                                </div>
                                <div class="col-md-8">
                                    <button id="btn-locate" type="button" class="btn btn-sm btn-outline-danger mb-2">Lihat
                                        Lokasi
                                        Terkini</button>
                                    <div id="map" style="height: 400px; border: 1px solid #ccc;"></div>
                                </div>
                            </div>

                            {{-- Tombol Submit --}}
                            <div class="mt-4 d-flex flex-column flex-sm-row">
                                <a href="{{ route('profile.edit') }}"
                                    class="btn btn-outline-warning fw-semibold px-4 mb-2 mb-sm-0 me-sm-2">Kembali</a>
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

    {{-- Script Leaflet dengan Tombol Update Lokasi --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var latitudeInput = document.getElementById('latitude');
            var longitudeInput = document.getElementById('longitude');

            // Ambil koordinat tersimpan dari server (string), parse ke float
            var savedLat = latitudeInput.value ? parseFloat(latitudeInput.value) : null;
            var savedLng = longitudeInput.value ? parseFloat(longitudeInput.value) : null;

            // Default fallback ke Jakarta
            var defaultLat = -6.2;
            var defaultLng = 106.816666;

            // Fungsi untuk update nilai input
            function updateInput(latlng) {
                latitudeInput.value = latlng.lat.toFixed(7);
                longitudeInput.value = latlng.lng.toFixed(7);
            }

            // Fungsi untuk buat peta dan marker
            function initMap(centerLat, centerLng) {
                var map = L.map('map').setView([centerLat, centerLng], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                var marker = L.marker([centerLat, centerLng], {
                    draggable: true
                }).addTo(map);

                updateInput(marker.getLatLng());

                marker.on('dragend', function(e) {
                    updateInput(e.target.getLatLng());
                });

                map.on('click', function(e) {
                    marker.setLatLng(e.latlng);
                    updateInput(e.latlng);
                });

                // Tombol untuk update lokasi device
                document.getElementById('btn-locate').addEventListener('click', function() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            function(position) {
                                var userLat = position.coords.latitude;
                                var userLng = position.coords.longitude;

                                // Update marker dan peta ke lokasi device
                                marker.setLatLng([userLat, userLng]);
                                map.setView([userLat, userLng], 13);
                                updateInput(marker.getLatLng());
                            },
                            function(error) {
                                alert('Gagal mendapatkan lokasi: ' + error.message);
                            }
                        );
                    } else {
                        alert('Geolocation tidak didukung di browser ini.');
                    }
                });

                return map;
            }

            // Inisialisasi peta
            if (savedLat !== null && savedLng !== null) {
                // Pakai koordinat tersimpan
                initMap(savedLat, savedLng);
            } else if (navigator.geolocation) {
                // Jika belum ada data koordinat, coba ambil lokasi device
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        initMap(position.coords.latitude, position.coords.longitude);
                    },
                    function(error) {
                        // Kalau error, pakai default Jakarta
                        initMap(defaultLat, defaultLng);
                    }
                );
            } else {
                // Kalau browser gak support geolocation, pakai default Jakarta
                initMap(defaultLat, defaultLng);
            }
        });
    </script>
@endsection
