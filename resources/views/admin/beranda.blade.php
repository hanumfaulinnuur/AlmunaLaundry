@extends('layouts.admin.master')
@section('title', 'Beranda')
@section('content')
    <main id="main" class="main">
        <div class="container my-4">
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="d-flex align-items-center p-3 ">
                            <div class="bg-primary text-white p-3 rounded-4 me-3 d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <i class="bi bi-person-bounding-box fs-3"></i>
                            </div>
                            <div>
                                <h5><b>Total Pelanggan</b></h5>
                                <div class="fw-bold fs-5">{{ $totalPelanggan }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="d-flex align-items-center p-3 ">
                            <div class="bg-primary text-white p-3 rounded-4 me-3 d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <i class="bi bi-wrench"></i>
                            </div>
                            <div>
                                <h5><b>Service Tersedia</b></h5>
                                <div class="fw-bold fs-5">{{ $totalService }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <div class="card p-4">
                        <h5 class="text-center"><b>Grafik Order Masuk dan Selesai per Hari</b></h5>
                        <hr>
                        <div class="row mt-3 mb-4">
                            <div class="d-flex justify-content-end mb-4">
                                <form method="GET" action="{{ route('admin.beranda') }}"
                                    class="d-flex flex-wrap gap-2 align-items-end">
                                    <div class="d-flex flex-column">
                                        <label for="start_date" class="form-label mb-1 small">Tanggal Mulai</label>
                                        <input type="date" id="start_date" name="start_date"
                                            class="form-control form-control-sm"
                                            value="{{ request('start_date', $start->format('Y-m-d')) }}">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label for="end_date" class="form-label mb-1 small">Tanggal Selesai</label>
                                        <input type="date" id="end_date" name="end_date"
                                            class="form-control form-control-sm"
                                            value="{{ request('end_date', $end->format('Y-m-d')) }}">
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-sm btn-primary mt-3">Filter</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                        <canvas id="orderChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('orderChart').getContext('2d');
        const orderChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($dates) !!},
                datasets: [{
                        label: 'Order Masuk',
                        data: {!! json_encode($orderMasuk) !!},
                        backgroundColor: 'rgba(255, 99, 132, 0.7)'
                    },
                    {
                        label: 'Order Selesai',
                        data: {!! json_encode($orderSelesai) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.7)'
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1,
                        title: {
                            display: true,
                            text: 'Total Order'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                        }
                    }
                }
            }
        });
    </script>
@endsection
