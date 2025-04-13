@extends('layouts.pelanggan.master')
@section('title', 'Lacak Status')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex justify-content-center">
                <img class="img-fluid" src="{{ asset('assets/front_asset/image/loop.png') }}" alt="" width="300px">
            </div>
            <div class="col-md-6 my-auto">
                <h1 class="tagline"><span>Pantau Setiap</span> Langkah Proses Cucian Anda Di sini !</h1>
            </div>
        </div>
        <div class="container mt-4">

            <!-- Filter Input -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" id="filterInvoice" class="form-control" placeholder="Filter No Invoice">
                </div>
                {{-- <div class="col-md-4">
                    <input type="text" id="filterNama" class="form-control" placeholder="Filter Nama">
                </div>
                <div class="col-md-4">
                    <input type="text" id="filterTanggal" class="form-control" placeholder="Filter Tanggal (DD-MM-YYYY)">
                </div> --}}
            </div>

            <!-- Table -->
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">No Invoice</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis Service</th>
                        <th scope="col">Tanggal Order</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr>
                        <th scope="row">1</th>
                        <td>12321</td>
                        <td>Hanum Aja</td>
                        <td>Cuci Kering</td>
                        <td>27-02-2003</td>
                        <td>Diproses</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>54321</td>
                        <td>Ini Bapak Budi</td>
                        <td>Cuci Setrika</td>
                        <td>15-08-2024</td>
                        <td>Selesai</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>67890</td>
                        <td>Ayu Lestari</td>
                        <td>Cuci Express</td>
                        <td>10-01-2025</td>
                        <td>Diproses</td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>11223</td>
                        <td>Hanum Aja</td>
                        <td>Cuci Kering</td>
                        <td>20-12-2023</td>
                        <td>Dalam Antrian</td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>11223</td>
                        <td>Hanum Aja</td>
                        <td>Cuci Kering</td>
                        <td>20-12-2023</td>
                        <td>Dalam Antrian</td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td>11223</td>
                        <td>Hanum Aja</td>
                        <td>Cuci Kering</td>
                        <td>20-12-2023</td>
                        <td>Dalam Antrian</td>
                    </tr>
                    <tr>
                        <th scope="row">7</th>
                        <td>11223</td>
                        <td>Hanum Aja</td>
                        <td>Cuci Kering</td>
                        <td>20-12-2023</td>
                        <td>Dalam Antrian</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
