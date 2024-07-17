@extends('admin.layouts.template')
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $pagetitle }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dahsboard</a></li>
                    <li class="breadcrumb-item active">{{ $pagetitle }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="row">
                                    <div class="card">
                                        <div class="card-body">
                                            <h2 class="card-title fs-4">#INV-0{{ $invoice->id_pembelian }}</h2>
                                            <h6>Sidoluhur Furniture</h6>

                                            <div class="pt-2">
                                                <div class="row">
                                                    <label for="nama_pelanggan" class="col-sm-2 col-lg-4">Nama
                                                        Pemesan</label>
                                                    <div class="col-sm-10 col-lg-8">
                                                        <p>: {{ $invoice->nama_pelanggan }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="email" class="col-sm-2 col-lg-4">Email</label>
                                                    <div class="col-sm-10 col-lg-8">
                                                        <p>: {{ $invoice->email }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="no_hp" class="col-sm-2 col-lg-4">No Telepon</label>
                                                    <div class="col-sm-10 col-lg-8">
                                                        <p>: {{ $invoice->no_telepon }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="alamat_pengiriman" class="col-sm-2 col-lg-4">Alamat
                                                        Pengiriman</label>
                                                    <div class="col-sm-10 col-lg-8">
                                                        <p>: {{ $invoice->alamat_pengiriman }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="nama_pelanggan" class="col-sm-2 col-lg-4">Tgl.
                                                        Pemesanan</label>
                                                    <div class="col-sm-10 col-lg-8">
                                                        <p>: {{ $invoice->created_at }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="nama_pelanggan" class="col-sm-2 col-lg-4">Status
                                                        Pengiriman</label>
                                                    <div class="col-sm-10 col-lg-8">
                                                        <p>: {{ $invoice->status_pengiriman }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="nama_pelanggan" class="col-sm-2 col-lg-4">Dibayar
                                                        Melalui</label>
                                                    <div class="col-sm-10 col-lg-8">
                                                        <p>: {{ $invoice->metode_pembayaran }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pt-4">
                                                @if ($invoice->status_pembayaran != '0')
                                                    <p class="text-center fw-bold text-success">[LUNAS]</p>
                                                @else
                                                    <p class="text-center fw-bold text-danger">[BELUM LUNAS]</p>
                                                @endif
                                                <h6 class="card-subtitle mb-2 text-muted">Detail Pesanan</h6>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Kategori</th>
                                                                <th>Nama Barang</th>
                                                                <th>Total Barang (Unit)</th>
                                                                <th>Total Harga(Rp.)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>{{ $invoice->nama_kategori }}</td>
                                                                <td>{{ $invoice->nama_barang }}</td>
                                                                <td>{{ number_format($invoice->total_barang) }}
                                                                </td>
                                                                <td>{{ number_format($invoice->total_harga) }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="3" class="text-end">Total</th>
                                                                <th>{{ number_format($invoice->total_harga) }}
                                                                </th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="d-flex justify-content-end">
                                                        <a href="{{ url('download-invoice-/' . $invoice->id_pembelian) }}"
                                                            class="btn btn-success"><i class="bi bi-download"></i> Unduh
                                                            Invoice</a>
                                                    </div>
                                                </div>
                                                <i>Terimakasih atas pesanannya</i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h2 class="card-title fs-5">Konfirmasi Pesanan</h2>

                                            <div class="d-flex gap-3">
                                                @if ($invoice->metode_pembayaran === 'Manual')
                                                    <span class="badge bg-success">Dibayar Menggunakan Midtrans</span>
                                                @elseif($invoice->metode_pembayaran === 'Manual Bank Transfer')
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"><i
                                                            class="bi bi-file-earmark-text"></i>
                                                        Lihat Bukti Pembayaran</button>
                                                @endif
                                                @if ($invoice->status_pengiriman === 'Dikemas')
                                                    <form
                                                        action="{{ url('confirm-pengiriman/' . $invoice->id_pembelian) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @method('put')
                                                        @csrf
                                                        <input type="hidden" name="status_pengiriman" value="Dikirim">
                                                        <button type="submit" id="btn-batal" name="btn-batal"
                                                            class="btn btn-primary"><i class="bi bi-check2-circle"></i>
                                                            Konfirmasi Pengiriman</button>
                                                    </form>
                                                @endif
                                                @if ($invoice->status_pesanan == '0')
                                                    <form action="{{ url('confirm-transaksi/' . $invoice->id_pembelian) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @method('put')
                                                        @csrf
                                                        <input type="hidden" name="status_pembayaran" value="2">
                                                        <input type="hidden" name="status_pesanan" value="1">
                                                        <input type="hidden" name="status_pengiriman" value="Dikemas">
                                                        <input type="hidden" name="id_alatberat"
                                                            value="{{ $invoice->id_barang }}">
                                                        <button type="submit" id="btn-acc" name="btn-acc"
                                                            class="btn btn-primary"><i class="bi bi-check2-circle"></i>
                                                            Konfirmasi
                                                            Pesanan</button>
                                                    </form>
                                                @else
                                                    <form action="{{ url('confirm-transaksi/' . $invoice->id_pembelian) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @method('put')
                                                        @csrf
                                                        <input type="hidden" name="status" value="0">
                                                        <button type="submit" id="btn-batal" name="btn-batal"
                                                            class="btn btn-danger"><i class="bi bi-x-circle"></i>
                                                            Batalkan
                                                            Konfirmasi</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if (isset($invoice->bukti_pembayaran))
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Bukti Pemayaran
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ url('assets/upload/images/bukti_pembayaran/' . $invoice->bukti_pembayaran) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Left side columns -->

            </div>
        </section>

    </main><!-- End #main -->
@endsection
@section('js')
@endsection
