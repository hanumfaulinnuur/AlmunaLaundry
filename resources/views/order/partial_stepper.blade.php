<div>
    <ul class="timeline">
        <li>
            <strong>Order Divalidasi Admin</strong>
            <p>{{ \Carbon\Carbon::parse($transaksi->updated_at)->translatedFormat('l, d F Y H:i') }}</p>
        </li>

        @if (in_array($transaksi->status_transaksi, ['sedang di proses', 'menunggu pembayaran', 'selesai']))
            <li>
                <strong>Bajumu Sedang Diproses</strong>
                <p>{{ \Carbon\Carbon::parse($transaksi->updated_at)->translatedFormat('l, d F Y H:i') }}</p>
            </li>
        @endif

        @if (in_array($transaksi->status_transaksi, ['menunggu pembayaran', 'selesai']))
            <li>
                <strong>Orderan Selesai, Silahkan Melakukan Pembayaran</strong>
                <p>{{ \Carbon\Carbon::parse($transaksi->updated_at)->translatedFormat('l, d F Y H:i') }}</p>

                @if ($transaksi->status_transaksi == 'menunggu pembayaran')
                    <a href="{{ route('detail.transaksi.order', ['id' => $transaksi->id]) }}" class="btn btn-danger mt-2">
                        Selesaikan Pembayaran
                    </a>
                @endif
            </li>
        @endif

        @if ($transaksi->status_transaksi == 'selesai')
            <li>
                <strong>Selesai</strong>
                <p>{{ \Carbon\Carbon::parse($transaksi->updated_at)->translatedFormat('l, d F Y H:i') }}</p>
                <a href="{{ route('invoice', ['id' => $transaksi->id]) }}" class="btn btn-primary btn-sm">Lihat
                    Invoice</a>
            </li>
        @endif
    </ul>
</div>
