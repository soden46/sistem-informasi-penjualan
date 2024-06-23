@extends('home.layouts.template')
@section('css')
<link rel="stylesheet" href="{{ url('assets/homepage/css/handler.css') }}">
@endsection
@section('main')
@include('home.layouts.breadcrumb')

<!--Section: FAQ-->
<div>
    <section>
        <h3 class="text-center mb-4 pb-2 text-primary fw-bold">Cara Pemesanan Furniture</h3>
        <p class="text-center mb-5">
            Ikuti langkah-langkah dibawah untuk melakukan pemesanan Furniture
        </p>

        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                <h6 class="mb-3 text-primary"><i class="far fa-paper-plane text-primary pe-2"></i>1. Buka website http://sadimanmeubel.xyz/</h6>
                <p>
                    <strong><u>Pertama</u></strong> Buka url http://sadimanmeubel.xyz/.
                </p>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <h6 class="mb-3 text-primary"><i class="fas fa-pen-alt text-primary pe-2"></i> 2. Pilih menu login</h6>
                <p>
                    <strong><u>Klik Halaman Login</u></strong> Setelah website berhasil terbuka klik menu login pada daftar menu dibagian atas halaman.
                </p>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <h6 class="mb-3 text-primary"><i class="fas fa-user text-primary pe-2"></i> 3. Kemudian akan muncul popup notifikasi login berhasil
                </h6>
                <p>
                    Setelah anda berhasil login maka anda akan dibawa ke halaman home dengan tampilan peengguna yang telah login berdasarkan akun anda.
                </p>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <h6 class="mb-3 text-primary"><i class="fas fa-rocket text-primary pe-2"></i> 4. Pilih menu halaman Furniture
                </h6>
                <p>
                    Untuk memesan furniture silahkan pilih menu produk pada pilihan daftar menu.
                </p>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <h6 class="mb-3 text-primary"><i class="fas fa-home text-primary pe-2"></i> 5. Pilih furnitre yang akan disewa, kemudian klik “pesan”.
                </h6>
                <p>Pilih furniture yang tersedia pada daftar furniture.</p>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <h6 class="mb-3 text-primary"><i class="fas fa-book-open text-primary pe-2"></i> 6. Klik Tombol “mulai pesan”</h6>
                <p>
                    silahkan klik tombol mulai pesan yang ada untuk mengisi detail pemesanan.
                </p>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <h6 class="mb-3 text-primary"><i class="fas fa-book-open text-primary pe-2"></i> 7. Masukkan data pemesanan, kemudian klik tombol “pesan sekarang”</h6>
                <p>
                    Setelah anda selesai mengisi detail pemesanan silahkan klik tombol pesan sekarang.
                </p>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <h6 class="mb-3 text-primary"><i class="fas fa-book-open text-primary pe-2"></i> 8. Akan muncul pop-up “pesanan berhasil”</h6>
                <p>
                    Setelah anda mengeklik tombol pesan sekarang selanjutnya akan muncul popup pesanan berhasil.
                </p>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <h6 class="mb-3 text-primary"><i class="fas fa-book-open text-primary pe-2"></i> 9. Kemudian Anda akan diarahkan menuju halaman invoice</h6>
                <p>
                    Pada halaman ini akan menampilkan detail pemesanan anda.
                </p>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <h6 class="mb-3 text-primary"><i class="fas fa-book-open text-primary pe-2"></i> 10. Klik pada tombol invoice</h6>
                <p>
                    Setelah anda mengeklik tombol invoice anda akan dibawa ke halaman invoice halaman ini akan menampilkan detail pemesanan anda beserta jumlah uang yang harus dibayarkan serta pilihan rekening pembayaran, silahkan anda upload bukti pembayaran pada kolom unggah bukti pembayaran. Bukti pemayaran yang didukung adalah berformat jpeg, jpg dan png.
                </p>
            </div>
        </div>
    </section>
</div>
<!--Section: FAQ-->
@endsection