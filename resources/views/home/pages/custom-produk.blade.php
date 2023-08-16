@extends('home.layouts.template')
@section('css')
<link rel="stylesheet" href="{{ url('assets/homepage/css/handler.css') }}">
@endsection
@section('main')
@include('home.layouts.breadcrumb')
<div class="pt-2 pb-2 d-flex gap-3">
    @if (login())
    <button class="btn btn-primary" onclick="myFunction()"><i class="bi bi-file-earmark-plus"></i> Mulai Pesan</button>
    @else
    <a href="{{ url('login') }}" class="btn btn-primary"><i class="bi bi-person"></i>
        Login Untuk Melakukan Pemesanan</a>
    @endif
    <a href="https://wa.me/{{ profile()->whatsapp }}" class="btn btn-success"><i class="bi bi-whatsapp"></i> Whatspp</a>
</div>
<form action="{{ url('confirm-custom') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3 pt-2">
        <div class="d-flex justify-content-center">
            <h3>Formulir Pembelian</h3>
        </div>

        <div class="row pt-2 pb-2">
            <label for="sku" class="col-lg-4 col-sm-4 form-label fw-bold"> <i class="fa-solid fa-barcode"></i> Nama Barang</label>
            <div class="col-lg-8 col-sm-8">
                <input type="text" name="sku" id="sku" class="form-control">
            </div>
        </div>

        <div class="row pt-2 pb-2">
            <label for="foto" class="col-lg-4 col-sm-4 form-label fw-bold"> <i class="fa-solid fa-barcode"></i> Foto Desain</label>
            <div class="col-lg-8 col-sm-8">
                <input type="file" name="foto" id="foto" class="form-control">
            </div>
        </div>

        <div class="row pt-2 pb-2">
            <label for="keterangan" class="col-lg-4 col-sm-4 form-label fw-bold"> <i class="fa-solid fa-barcode"></i> Keterangan</label>
            <div class="col-lg-8 col-sm-8">
                <input type="text" name="keterangan" id="keterangan" class="form-control">
            </div>
        </div>

        <div class="row pt-2 pb-2">
            <label for="lokasi_pengiriman" class="col-lg-4 col-sm-4 form-label fw-bold"> <i class="bi bi-geo-alt"></i> Lokasi Pengiriman</label>
            <div class="col-lg-8 col-sm-8">
                <input type="text" name="lokasi_pengiriman" placeholder="Masukan Lokasi / Alamat Pengiriman" id="lokasi_pengiriman" class="form-control">
            </div>
        </div>
        <div class="row pt-2 pb-2">
            <label for="jumlah" class="col-lg-4 col-sm-4 form-label fw-bold"> <i class="bi bi-cart-plus"></i> Jumlah</label>
            <div class="col-lg-8 col-sm-8">
                <input type="text" name="jumlah" placeholder="Masukan Jumlah (Angka)" class="form-control">
            </div>
        </div>
        <marquee>Kami Akan Menginformasikan Harga Yang Harus Dibayar Melalui Whatsapp</marquee>
        <div class=" d-flex justify-content-center">
            <button type="submit" class="btn btn-primary" id="send"><i class="bi bi-send"></i> Pesan Sekarang</a>
        </div>
    </div>

</form>
@endsection
@section('js')

<script>
    function myFunction() {
        var x = document.getElementById("beli");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>

<script src="{{ url('assets/homepage/js/handler.js') }}"></script>
<script src="{{ url('assets/homepage/js/price.js') }}"></script>

<script>
    $(function($) {
        var options = {
            minimum: 0,
            maximize: 10,
            onchange: valChanged,
            onMinimum: function(e) {
                console.log('reached minimum: ' + e)
            },
            onMaximize: function(e) {
                console.log('reached maximize' + e)
            }
        }
        $('#handleCounter').handleCounter({
            maximize: 100
        })
    })

    function valChanged(d) {
        //console.log(d)
    }
</script>