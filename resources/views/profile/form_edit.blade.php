@extends('layouts.pelanggan.master')

@section('title', 'edit profil')

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
            <div class="col-md-8">
                <div class="card shadow p-5 bg-body-tertiary rounded mb-5">
                    <div style="width: fit-content;">
                        <h4 class="section-title-profile">Ubah Detail Profil</h4>

                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PATCH')

                            {{-- Nama --}}
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                                </div>
                                <div class="col-md-8">
                                    <input id="name" name="name" type="text" class="form-control input-profile"
                                        value="{{ old('name', $user->name) }}">
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                </div>
                                <div class="col-md-8">
                                    <input id="email" name="email" type="email" class="form-control"
                                        value="{{ old('email', $user->email) }}">
                                </div>
                            </div>

                            {{-- Nomor Telepon --}}
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="no_telepon" class="form-label fw-semibold">No Telepon</label>
                                </div>
                                <div class="col-md-8">
                                    <input id="no_telepon" name="no_telepon" type="number" class="form-control"
                                        value="{{ old('no_telepon', $user->pelanggan->no_telepon ?? '') }}">
                                </div>
                            </div>

                            {{-- Alamat --}}
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="alamat" class="form-label fw-semibold">Alamat</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea id="alamat" name="alamat" class="form-control" rows="5">{{ old('alamat', $user->pelanggan->alamat ?? '') }}</textarea>
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
                                    <label class="form-label fw-semibold">Pilih Lokasi di Peta</label>
                                </div>
                                <div class="col-md-8">
                                    <div id="map"
                                        style="height: 400px; width: 100%; border-radius: 6px; overflow: hidden;"></div>
                                </div>
                            </div>


                            {{-- Tombol Submit --}}
                            <button class="btn btn-warning text-white fw-semibold px-4">Ubah Profil</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CDN Leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    {{-- Script Leaflet --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var defaultLat = {{ old('latitude', $user->pelanggan->latitude ?? -6.2) }};
            var defaultLng = {{ old('longitude', $user->pelanggan->longitude ?? 106.816666) }};

            var map = L.map('map').setView([defaultLat, defaultLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([defaultLat, defaultLng], {
                draggable: true
            }).addTo(map);

            function updateInput(latlng) {
                document.getElementById('latitude').value = latlng.lat;
                document.getElementById('longitude').value = latlng.lng;
            }

            updateInput(marker.getLatLng());

            marker.on('dragend', function(e) {
                updateInput(e.target.getLatLng());
            });

            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                updateInput(e.latlng);
            });
        });
    </script>
@endsection
