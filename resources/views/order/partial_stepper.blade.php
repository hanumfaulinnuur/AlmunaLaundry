<div>
    <ul class="timeline">
        <li>
            <strong>Order Pesanan Dibuat</strong>
            <p>{{ \Carbon\Carbon::parse($transaksi->created_at)->translatedFormat('l, d F Y H:i') }}</p>
        </li>

        @if (in_array($transaksi->status_transaksi, ['proses validasi', 'sedang diproses', 'menunggu pembayaran', 'selesai']))
            <li>
                <strong>Order Sedang Proses Validasi Admin</strong>
                <p>{{ \Carbon\Carbon::parse($transaksi->tanggal_order)->translatedFormat('l, d F Y H:i') }}</p>
            </li>
        @endif

        @if (in_array($transaksi->status_transaksi, ['sedang diproses', 'menunggu pembayaran', 'selesai']))
            <li>
                <strong>Layanan Ordermu Sedang Diproses</strong>
                <p>{{ \Carbon\Carbon::parse($transaksi->proses_order)->translatedFormat('l, d F Y H:i') }}</p>
            </li>
        @endif

        @if ($transaksi->status_transaksi == 'menunggu pembayaran' || $transaksi->status_transaksi == 'selesai')
            <li>
                <strong>Orderan Selesai, Silahkan Melakukan Pembayaran</strong>
                <p>{{ \Carbon\Carbon::parse($transaksi->tanggal_selesai)->translatedFormat('l, d F Y H:i') }}</p>
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
                <p>
                    {{ $transaksi->pembayaran ? \Carbon\Carbon::parse($transaksi->pembayaran->tanggal_pembayaran)->translatedFormat('l, d F Y H:i') : \Carbon\Carbon::parse($transaksi->updated_at)->translatedFormat('l, d F Y H:i') }}
                </p>
                <a href="{{ route('invoice', ['id' => $transaksi->id]) }}" class="btn btn-primary btn-sm">Lihat
                    Invoice</a>
            </li>
        @endif
    </ul>
</div>
