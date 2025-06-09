@extends('layouts.pelanggan.master')
@section('title', 'Detail Transaksi')
@section('content')
    <div class="container container-card-detail my-5" style="height: 70vh">
        <div class="card shadow p-5 card-detail-transaksi" style="border-radius: 20px;">
            <h3 class="my-5 section-title-detail">Detail Transaksi</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr class="text-center align-middle">
                            <th>Jenis Service</th>
                            <th>Harga Satuan</th>
                            <th>Berat</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center align-middle">
                            <td>{{ $transaksi->Service->nama_service }}</td>
                            <td>Rp. {{ number_format($transaksi->Service->harga, 0, ',', '.') }}</td>
                            <td>{{ rtrim(rtrim(number_format($transaksi->total_berat, 2, '.', ''), '0'), '.') }} kg</td>
                            <td>Rp. {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <small class="text-danger mt-3">* Biaya admin sebesar Rp. 3.000 akan dikenakan untuk pembayaran via
                Midtrans.</small>

            <div class="text-end mt-4">
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Pilih Metode Pembayaran
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#" class="dropdown-item p-2" data-bs-toggle="modal"
                                data-bs-target="#cashPaymentModal">Pembayaran Cash</a>
                        </li>
                        <li>
                            <form action="{{ route('pembayaran.saldo', $transaksi->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item p-2">Pembayaran Saldo</button>
                            </form>
                        </li>
                        <li><button class="dropdown-item p-2" id="pay-button">Pembayaran Midtrans</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- modal pembayaran cash --}}
    <div class="modal fade" id="cashPaymentModal" tabindex="-1" aria-labelledby="cashPaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4" style="border-radius: 15px;">
                <img src="{{ asset('assets/front_asset/image/Payment.png') }}" alt="Cash Illustration" class="mx-auto mb-3"
                    style="width: 60px;">
                <h5>Lakukan Pembayaran di Admin,<br>Pembayaranmu akan di validasi admin</h5>
                <div class="mt-3">
                    <form action="{{ route('pembayaran.cash', $transaksi->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Lakukan Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- modal saldo tidak cukup --}}
    <div class="modal fade" id="saldoKurangModal" tabindex="-1" aria-labelledby="saldoKurangModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-body p-5">
                    <img src="{{ asset('assets/front_asset/image/saldo.png') }}" alt="Order Process" width="30%">
                    <h5 class="mt-4"><b>Saldo Anda Tidak Mencukupi</b></h5>
                    <p>Silakan pilih metode pembayaran lain atau isi saldo terlebih dahulu.</p>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="button" class="btn btn-outline-danger btn-modal-saldo" data-bs-dismiss="modal">Metode
                            Lainya</button>
                        <a href="{{ route('isi.saldo') }}" class="btn btn-danger btn-modal-saldo">Isi Saldo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Midtrans snap.js --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        // Modal saldo tidak cukup tampil otomatis jika ada session saldo_kurang
        @if (session('saldo_kurang'))
            var saldoKurangModal = new bootstrap.Modal(document.getElementById('saldoKurangModal'));
            saldoKurangModal.show();
        @endif

        // Midtrans payment button
        document.getElementById('pay-button').addEventListener('click', function() {
            let snapToken = '{{ $snapToken ?? '' }}';

            if (!snapToken || snapToken === '') {
                alert('Token pembayaran tidak tersedia. Silakan muat ulang halaman ini dari menu pembayaran.');
                return;
            }

            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    window.location.href = '/invoice/{{ $transaksi->id }}';
                    console.log(result);
                },
                onPending: function(result) {
                    alert("Menunggu pembayaran...");
                    console.log(result);
                },
                onError: function(result) {
                    alert("Pembayaran gagal.");
                    console.log(result);
                },
                onClose: function() {
                    alert("Kamu menutup popup tanpa menyelesaikan pembayaran.");
                }
            });
        });
    </script>
@endsection
