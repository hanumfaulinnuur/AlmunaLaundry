<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $transaksi->no_invoice }}</title>
</head>
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .cover {
        padding: 0px;
        text-align: center;
    }

    .hiding {
        margin-bottom: 30px;
        text-align: left;
    }

    .detail {
        margin: 5px 0;
    }

    .sub-detail {
        margin: 5px 0;
        font-weight: bold;
    }

    .status {
        color: green;
    }

    .signature {
        text-align: right;
        margin-top: 20px;
    }

    img {
        width: 20%;
    }
</style>

<body>
    <div class="cover">

        <div class="hiding">
            <h3>INVOICE PEMBAYARAN</h3>
            <h3>Almuna Laundry</h3>
            <hr style="border: none; border-top: 2px solid #5b5b5b;">

        </div>
        <table>
            <tr class="detail">
                <td class="sub-detail">Id Transaksi</td>
                <td>:</td>
                <td>{{ $transaksi->no_invoice }}</td>
            </tr>
            <tr class="detail">
                <td class="sub-detail">Tanggal Transaksi</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->translatedFormat('d F Y H:i') }}</td>
            </tr>
            <tr class="detail">
                <td class="sub-detail">Metode Pembayaran</td>
                <td>:</td>
                <td>{{ ucfirst($pembayaran->jenis_pembayaran ?? '-') }}</td>
            </tr>
            <tr class="detail">
                <td class="sub-detail">Status Pembayaran</td>
                <td>:</td>
                <td class="status"><b>{{ ucfirst($transaksi->status_transaksi) }}</b></td>
            </tr>
        </table>
        <div style="text-align:left; margin-top:20px;">
            <hr style="border: none; border-top: 1px dashed #ccc;">
            <h4 style=" text-align: center; margin:5px;">RINCIAN TRANSAKSI</h4>
            <hr style="border: none; border-top: 1px dashed #ccc;">
        </div>

        <div style="clear:both; text-align:left;">
            <p style="margin:5px 0;"><strong>{{ $transaksi->Service->nama_service ?? '-' }}</strong> <span
                    style="float:right;">Rp. {{ number_format($transaksi->Service->harga, 0, ',', '.') }}</span></p>
            <p style="margin:5px 0; color:#555; text-align:right">
                {{ rtrim(rtrim(number_format($transaksi->total_berat, 1), '0'), '.') }} Kg / Item</p>
            <hr style="border: none; border-top: 1px solid #ccc;">
            <p style="margin:5px 0;"><span>Subtotal</span> <span style="float:right;">Rp.
                    {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span></p>
            <p style="margin:5px 0;"><span>Biaya Admin</span> <span style="float:right;">Rp.
                    {{ number_format($pembayaran->biaya_admin ?? 0, 0, ',', '.') }}</span></p>
        </div>

        <hr style="border: none; border-top: 1px solid #ccc;">

        <div style="text-align:left; font-weight:bold;">
            <p style="font-size:16px;"><span>Total Bayar</span> <span style="float:right;">Rp.
                    {{ number_format($transaksi->total_harga + ($pembayaran->biaya_admin ?? 0), 0, ',', '.') }}</span>
            </p>
        </div>

        <div class="signature">
            <p>Terimakasih Atas Kepercayaan Anda</p>
            <img src="assets/front_asset/image/stamp.png" alt="">
            <p>Tim Almuna Laundry</p>
        </div>
    </div>

</body>

</html>
