@extends('layouts.pelanggan.master')
@section('title', 'saldo')
@section('content')
    <div class="container">
        <div class="row justify-content-center gap-4 mt-5">
            {{-- Sidebar Kiri --}}
            <div class="col-md-3">
                <div class="card text-center shadow p-3 mb-5 bg-body-tertiary rounded">
                    <div class="p-3">
                        <img class="img-fluid" src="{{ asset('assets/front_asset/image/avatar person.png') }}" alt="avatar"
                            width="100px">
                    </div>
                    <div class="py-4">
                        <h5 class="card-title"><b>Selamat Datang !</b></h5>
                        <h5 class="card-title">{{ Auth::user()->name }}</h5>
                        <hr>
                        <h5 class="card-title">Saldo Tersisa</h5>
                        <h5>Rp. {{ number_format($saldo, 0, ',', '.') }},00</h5>
                    </div>
                </div>
            </div>

            {{-- Isi Saldo --}}
            <div class="col-md-8">
                <div class="card shadow p-5 bg-body-tertiary rounded mb-5">
                    <h4 class="section-title-profile">Isi Saldo</h4>
                    <div class="row my-4 g-3">
                        <div class="col-md-4">
                            <div class="border rounded text-center p-3 shadow-sm">
                                <h4 class="text-emphasis"><b>10 ribu</b></h4>
                                <h6 class="text-danger">Rp. 13.000</h6>
                                <button class="btn btn-warning text-white mt-2 w-75 rounded btn-buy" data-amount="13000"
                                    data-topup="10000">Beli</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded text-center p-3 shadow-sm">
                                <h4 class="text-emphasis"><b>30 ribu</b></h4>
                                <h6 class="text-danger">Rp. 33.000</h6>
                                <button class="btn btn-warning text-white mt-2 w-75 rounded btn-buy" data-amount="33000"
                                    data-topup="30000">Beli</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded text-center p-3 shadow-sm">
                                <h4 class="text-emphasis"><b>50 ribu</b></h4>
                                <h6 class="text-danger">Rp. 53.000</h6>
                                <button class="btn btn-warning text-white mt-2 w-75 rounded btn-buy" data-amount="53000"
                                    data-topup="50000">Beli</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded text-center p-3 shadow-sm">
                                <h4 class="text-emphasis"><b>100 ribu</b></h4>
                                <h6 class="text-danger">Rp. 103.000</h6>
                                <button class="btn btn-warning text-white mt-2 w-75 rounded btn-buy" data-amount="103000"
                                    data-topup="100000">Beli</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded text-center p-3 shadow-sm">
                                <h4 class="text-emphasis"><b>150 ribu</b></h4>
                                <h6 class="text-danger">Rp. 153.000</h6>
                                <button class="btn btn-warning text-white mt-2 w-75 rounded btn-buy" data-amount="153000"
                                    data-topup="150000">Beli</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded text-center p-3 shadow-sm">
                                <h4 class="text-emphasis"><b>200 ribu</b></h4>
                                <h6 class="text-danger">Rp. 203.000</h6>
                                <button class="btn btn-warning text-white mt-2 w-75 rounded btn-buy" data-amount="203000"
                                    data-topup="200000">Beli</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Pembayaran Sukses -->
    <div class="modal fade" tabindex="-1" id="paymentSuccessModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('assets/front_asset/image/done.png') }}" alt="Icon Sukses" width="10%"
                        class="mb-4">
                    <h5 class="mb-4"><b>Pembelian Berhasil <br>
                            Saldo berhasil Ditambahkan</b></h5>
                </div>
            </div>
        </div>
    </div>


    {{-- Pasang Midtrans Snap JS --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>


    <script>
        document.querySelectorAll('.btn-buy').forEach(button => {
            button.addEventListener('click', function() {
                let amount = this.getAttribute('data-amount'); // nominal bayar ke Midtrans
                let topup = this.getAttribute('data-topup'); // nominal saldo yang ditambahkan

                // Minta snap token dengan nominal bayar
                fetch("{{ route('midtrans.charge') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            amount: amount
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.snap_token) {
                            snap.pay(data.snap_token, {
                                onSuccess: function(result) {
                                    // Menampilkan modal sukses
                                    $('#paymentSuccessModal').modal('show');

                                    // Update saldo dengan nominal topup
                                    fetch("{{ route('midtrans.updateSaldo') }}", {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({
                                                amount: topup
                                            })
                                        })
                                        .then(res => res.json())
                                        .then(resData => {
                                            if (resData.success) {
                                                console.log(
                                                    'Saldo berhasil diperbarui.');
                                            } else {
                                                alert('Gagal memperbarui saldo: ' + (
                                                    resData.error ||
                                                    'Kesalahan tidak diketahui'
                                                ));
                                            }
                                        })
                                        .catch(err => alert(
                                            'Terjadi kesalahan saat memperbarui saldo: ' +
                                            err.message));
                                },
                                onPending: function(result) {
                                    alert("Menunggu pembayaran...");
                                },
                                onError: function(result) {
                                    alert("Pembayaran gagal!");
                                },
                                onClose: function() {
                                    alert(
                                        'Anda menutup popup pembayaran tanpa menyelesaikan pembayaran'
                                    );
                                }
                            });
                        } else {
                            alert('Gagal mendapatkan snap token');
                        }
                    })
                    .catch(err => {
                        alert('Terjadi kesalahan: ' + err.message);
                    });
            });
        });
    </script>


@endsection
