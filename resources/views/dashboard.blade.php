@extends('layouts.pelanggan.master')
@section('title', 'dashboard')
@section('content')
    <section id="herro">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-md-6 my-auto">
                    <h1 class="herro-tagline">Laundry Cepat, Bersih, dan Rapi dalam Satu Sentuhan!</h1>
                    <h2 class="sub-herro-tagline">"Layanan Laundry Terpercaya yang Siap Membantu Menghemat Waktu Anda."
                    </h2>
                    <a href="{{ route('list-service') }}" class="button-secoundary">Coba Sekarang !</a>
                </div>
                <div class="col-md-6 my-auto">
                    <img class="img-fluid" src="{{ asset('assets/front_asset/image/herro.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>

    <section id="service">
        <div class="container h-100">
            <div class="text-center mt-5">
                <h1 class="tagline"><span>Service </span>Terbaik Untuk Mu</h1>
                <p class="sub-tagline-service px-5 pt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam
                    nec
                    urna
                    ante. In orci mi, gravida a
                    vestibulum vitae, viverra at enim. Vestibulum non elementum mi. Sed consectetur tortor ut ligula
                    euismod
                    venenatis eu a enim. </p>
            </div>
            <div class="row">
                <div class="col-md-4 py-3">
                    <div class="card shadow-sm text-center">
                        <div class="mt-5">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15 7.5C15 7.5 13.125 5 8.75 5C4.375 5 2.5 7.5 2.5 7.5V25C2.5 25 4.375 23.75 8.75 23.75C13.125 23.75 15 25 15 25M15 7.5V25M15 7.5C15 7.5 16.875 5 21.25 5C25.625 5 27.5 7.5 27.5 7.5V25C27.5 25 25.625 23.75 21.25 23.75C16.875 23.75 15 25 15 25"
                                    stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><b>Cuci Sertika</b></h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec
                                urna
                        </div>
                    </div>
                </div>
                <div class="col-md-4 py-3">
                    <div class="card shadow-sm text-center">
                        <div class="mt-5">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15 7.5C15 7.5 13.125 5 8.75 5C4.375 5 2.5 7.5 2.5 7.5V25C2.5 25 4.375 23.75 8.75 23.75C13.125 23.75 15 25 15 25M15 7.5V25M15 7.5C15 7.5 16.875 5 21.25 5C25.625 5 27.5 7.5 27.5 7.5V25C27.5 25 25.625 23.75 21.25 23.75C16.875 23.75 15 25 15 25"
                                    stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><b>Cuci Sepatu</b></h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec
                                urna
                        </div>
                    </div>
                </div>
                <div class="col-md-4 py-3">
                    <div class="card shadow-sm text-center">
                        <div class="mt-5">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15 7.5C15 7.5 13.125 5 8.75 5C4.375 5 2.5 7.5 2.5 7.5V25C2.5 25 4.375 23.75 8.75 23.75C13.125 23.75 15 25 15 25M15 7.5V25M15 7.5C15 7.5 16.875 5 21.25 5C25.625 5 27.5 7.5 27.5 7.5V25C27.5 25 25.625 23.75 21.25 23.75C16.875 23.75 15 25 15 25"
                                    stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><b>Cuci Kering</b></h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec
                                urna
                        </div>
                    </div>
                </div>
    </section>

    <section id="reason">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img class="img-fluid"
                        src="{{ asset('assets/front_asset/image/Girl drinking coffee while waiting for the end of the laundry.png') }}"
                        alt="">
                </div>
                <div class="col-md-6 my-auto">
                    <h1 class="tagline sub-reason mb-5"><span>Mengapa</span> Memilih Kami ?</h1>
                    <div class="d-flex gap-3 mb-3">
                        <div><img src="{{ asset('assets/front_asset/image/Group 11.png') }}" alt="" width="50px">
                        </div>
                        <div>
                            <h6 class=""><b>Pilihan Paket Hemat</b></h6>
                            <p>Hemat lebih banyak dengan berbagai pilihan paket laundry kami. Pilih paket yang paling
                                sesuai
                                dengan kebutuhan dan nikmati cucian bersih tanpa menguras kantong</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-3">
                        <div><img src="{{ asset('assets/front_asset/image/Group 11.png') }}" alt="" width="50px">
                        </div>
                        <div>
                            <h6 class=""><b>Pembayaran Online Aman</b></h6>
                            <p>Proses pembayaran yang mudah dan aman dengan berbagai metode pembayaran online. Mulai
                                dari
                                QRIS hingga sistem deposit, kami memastikan transaksi Anda aman dan nyaman</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-3">
                        <div><img src="{{ asset('assets/front_asset/image/Group 11.png') }}" alt="" width="50px">
                        </div>
                        <div>
                            <h6 class=""><b>Garansi Kualitas</b></h6>
                            <p>Kami berkomitmen untuk memberikan hasil terbaik! Garansi kualitas untuk setiap cucian,
                                agar
                                pakaian Anda tetap awet dan terlihat baru</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
