@extends('home.layouts.template')
@section('css')
<link rel="stylesheet" href="{{ url('assets/homepage/css/handler.css') }}">
@endsection
@section('main')
@include('home.layouts.breadcrumb')
<div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img class="img-fluid" src="{{ url('assets/upload/images/barang/' . $barang->gambar) }}" alt="">
                </div>
                <div class="col-lg-6">
                    <div class="row pt-2 pb-4">
                        <div class="col-6">
                            <div class="pt-4">
                                <label class="form-label fw-bold" for=""><i class="fa-solid fa-tag"></i>
                                    Kategori</label>
                                <p>{{ $kategori->kategori }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pt-4">
                                <label class="form-label fw-bold" for=""><i class="fa-solid fa-barcode"></i>
                                    Nama Barang</label>
                                <p>{{ $barang->nama_barang }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pt-4">
                                <label class="form-label fw-bold" for=""><i class="fa-solid fa-list-check"></i>
                                    FInishing</label>
                                <p>{{ $barang->finishing }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pt-4">
                                <label class="form-label fw-bold" for=""><i class="fa-solid fa-weight-hanging"></i>
                                    Ukuran</label>
                                <p>{{ $barang->ukuran }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pt-4">
                                <label class="form-label fw-bold" for=""><i class="bi bi-shield-check"></i>
                                    Stok</label>
                                <p>
                                    {!! $barang->stok == 'Tersedia'
                                    ? '<span class="badge bg-success">Tersedia</span>'
                                    : '<span class="badge bg-danger">Tidak Tersedia</span>' !!}</p>
                                @if ($barang->stok == 'Tidak Tersedia')
                                <small><b>Tersedia Kembali</b> </small>
                                <br>
                                <small>Tanggal <b>{{ $barang->tgl_tersedia }}</b> Jam <b>{{ $barang->jam_tersedia }}</b></small>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pt-4">
                                <label class="form-label fw-bold" for=""><i class="bi bi-cash"></i> Harga</label>
                                <p>Rp.{{ number_format($barang->harga) . '/' }}
                                    <small>{{ $barang->jumlah }} Pcs</small>
                                </p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="pt-8">
                                <label class="form-label fw-bold" for=""><i class="fa-solid fa-circle-info"></i>
                                    Deskripsi</label>
                                <p>{{ $barang->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="pt-2 pb-2 d-flex gap-3">
                        @if (login())
                        @if ($barang->stok == 'Tersedia')
                        <button class="btn btn-primary" onclick="myFunction()"><i class="bi bi-file-earmark-plus"></i> Mulai Pesan</button>
                        @endif
                        @else
                        <a href="{{ url('login') }}" class="btn btn-primary"><i class="bi bi-person"></i>
                            Login Untuk Melakukan Pemesanan</a>
                        @endif
                        <a href="https://wa.me/{{ profile()->whatsapp }}" class="btn btn-success"><i class="bi bi-whatsapp"></i> Whatspp</a>
                    </div>
                    <form action="{{ url('confirm') }}" method="post">
                        @csrf
                        <div class="pt-2" id="beli" style="display: none;">
                            <hr>
                            <div class="mb-3 pt-2">
                                <div class="d-flex justify-content-center">
                                    <h3>Formulir Pembelian</h3>
                                </div>
                                <input type="hidden" value=" {{ $barang->harga }}" id="harga">
                                <input type="hidden" name="id_barang" value="{{ $barang->id }}">

                                <div class="row pt-2 pb-2">
                                    <label for="sku" class="col-lg-4 col-sm-4 form-label fw-bold"> <i class="fa-solid fa-barcode"></i> Nama Barang</label>
                                    <div class="col-lg-8 col-sm-8">
                                        <input type="text" name="sku" id="sku" class="form-control" value="{{ $barang->nama_barang }}">
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
                                        <div class="handle-counter" id="handleCounter" onclick="sum();">
                                            <button class="counter-minus btn btn-primary">-</button>
                                            <input type="number" name="jumlah" id="jumlah" class="form-control form-control-custom" min="1">
                                            <button class="counter-plus btn btn-primary">+</button>
                                            <span style="font-weight: bold; padding-left: 10px;">Pcs</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-2 pb-2">
                                    <label class="col-lg-4 col-sm-4 form-label fw-bold"> <i class="bi bi-cash"></i> Total Biaya</label>
                                    <div class="col-lg-8 col-sm-8">
                                        <span style="font-weight: bold; font-size: x-large;">Rp <span id="total">0</span></span>
                                    </div>
                                </div>
                                <div class=" d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary" id="send"><i class="bi bi-send"></i> Pesan Sekarang</a>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $(function() {
        $("input[name='tgl_pemakaian']").timeInput(); // use default or html5 attributes
    });
</script>



<script>
    function myFunction() {
        var x = document.getElementById("beli");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    $("#jumlah").change(function() {
        if ($(this).val() != "") {
            $('#send').removeAttr('disabled');
        } else {
            $('#send').attr('disabled', 'disabled');
        }
    });
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
@endsection