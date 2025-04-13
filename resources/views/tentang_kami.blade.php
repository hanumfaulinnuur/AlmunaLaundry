@extends('layouts.pelanggan.master')
@section('title', 'tentang kami')
@section('content')
    <section id="about">
        <div class="container">
            <div class="row my-4">
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ asset('assets/front_asset/image/washing machine with cloth.png') }}"
                        alt="" width="500px">
                </div>
                <div class="col-md-6 my-auto">
                    <h1 class="tagline tag-about">Almuna Laundry</h1>
                    <p class="sub-tagline sub-about mt-4">Halo! Kami Almuna Laundry, sahabat setia yang bikin urusan
                        laundry
                        jadi
                        gampang. Dari pakaian
                        sehari-hari sampai bahan yang butuh perhatian ekstra, kami siap bantu bikin semuanya bersih,
                        wangi,
                        dan rapi!</p>
                    <div class="d-flex gap-4 mt-5 align-items-center">
                        <div>
                            <a href="https://www.google.com/maps/@-8.3700833,114.1958379,92m/data=!3m1!1e3!5m2!1e2!1e4?entry=ttu&g_ep=EgoyMDI1MDEyMi4wIKXMDSoASAFQAw%3D%3D"
                                target="_blank" rel="noopener noreferrer">
                                <img src="{{ asset('assets/front_asset/image/location.png') }}" alt=""
                                    width="50px">
                            </a>
                        </div>
                        <p class="mb-0">Jl. SMAN 2 Taruna Bhayangkara, Dusun Pandan, Desa Kembiritan, Kecamatan Genteng,
                            Kabupaten Banyuwangi</p>
                    </div>

                    <div class="d-flex gap-4 align-items-center mt-3">
                        <div>
                            <a href="http://wa.me//6285755897944" target="_blank" rel="noopener noreferrer">
                                <img src="{{ asset('assets/front_asset/image/whatapp.png') }}" alt=""
                                    width="50px">
                            </a>
                        </div>
                        <p class="mb-0">09876554567</p>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
