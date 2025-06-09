Halo *{{ $nama }}*,

Terima kasih telah menggunakan layanan kami!
Pesanan Anda dengan detail :

No Invoice : *{{ $invoice }}*
Nama Service : {{ $service }}
Tanggal Order : {{ \Carbon\Carbon::parse($tanggal_order)->translatedFormat('l, d F Y') }}
Total Berat / jumlah : {{ rtrim(rtrim(number_format($total_berat, 2, '.', ''), '0'), '.') }} Kg/Item
Total Harga : Rp. {{ number_format($total_harga, 0, ',', '.') }},00

Telah selesai diproses.Untuk melanjutkan, silakan melakukan pembayaran melalui website kami di link berikut:
www.instagram.com

Untuk layanan antar jemput, selengkapnya bisa melakukan konfirmasi admin.

Jika Anda membutuhkan bantuan atau informasi lebih lanjut, jangan ragu untuk menghubungi kami.
Terima kasih atas kepercayaan dan dukungan Anda. 🙏


Salam hangat,
Tim Layanan Kami

_*Almuna Laundry*_
