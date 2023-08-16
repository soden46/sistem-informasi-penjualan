@extends('home.layouts.template')
@section('css')
@endsection
@section('main')
@include('home.layouts.breadcrumb')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title fs-4">#INV-0{{ $invoicec->id }}</h2>
                    <h6>{{ profile()->nama_perusahaan }}</h6>

                    <div class="pt-2">
                        <div class="row">
                            <label for="nama_pelanggan" class="col-sm-2 col-lg-4">Nama Pemesan</label>
                            <div class="col-sm-10 col-lg-8">
                                <p>: {{ $invoicec->nama_pelanggan }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <label for="nama_pelanggan" class="col-sm-2 col-lg-4">Email</label>
                            <div class="col-sm-10 col-lg-8">
                                <p>: {{ $invoicec->email }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <label for="nama_pelanggan" class="col-sm-2 col-lg-4">No Telepon</label>
                            <div class="col-sm-10 col-lg-8">
                                <p>: {{ $invoicec->no_hp }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <label for="alamat_pengiriman" class="col-sm-2 col-lg-4">Alamat Pengiriman</label>
                            <div class="col-sm-10 col-lg-8">
                                <p>: {{ $invoicec->alamat_pengiriman }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <label for="nama_pelanggan" class="col-sm-2 col-lg-4">Tgl. Pemesanan</label>
                            <div class="col-sm-10 col-lg-8">
                                <p>: {{ $invoicec->created_at }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <label for="nama_pelanggan" class="col-sm-2 col-lg-4">Jumlah</label>
                            <div class="col-sm-10 col-lg-8">
                                <p>: {{ $invoicec->jumlah }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="pt-4">
                        @if ($invoicec->status != '0')
                        <p class="text-center fw-bold text-success">[LUNAS]</p>
                        @else
                        <p class="text-center fw-bold text-danger">[BELUM LUNAS]</p>
                        @endif
                        <h6 class="card-subtitle mb-2 text-muted">Detail Pesanan</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Merk</th>
                                        <th>Harga (Rp.)</th>
                                        <th>Jumlah (Barang)</th>
                                        <th>Total (Rp.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $invoicec->nama_barang }}</td>
                                        <td>{{ number_format($invoicec->harga)}}</td>
                                        <td>{{ $invoicec->jumlah }}</td>
                                        <td>{{ number_format($invoicec->harga * $invoicec->jumlah) }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="text-end">Total</th>
                                        <th>{{ number_format($invoicec->harga * $invoicec->jumlah) }}</th>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                <a href="{{ url('download-invoicec/' . $invoicec->id) }}" class="btn btn-success"><i class="bi bi-download"></i> Unduh Invoice</a>
                            </div>
                        </div>
                        <i>Terimakasih atas kerjasamanya</i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title fs-5">Informasi Pembayaran</h2>
                    <p class="card-subtitle mb-2 text-muted">Lakukan Pembayaran melaui no rekening dibawah</p>
                    @foreach ($rekening as $item)
                    <p> - {!! $item->bank . ' <b>' . $item->no_rekening . '</b> a.n. ' . $item->nama_rekening !!}</p>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title fs-5">Unggah Bukti Pembayaran</h2>
                    <form action="{{ url('payment/' . $invoice->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <label class="text-danger">Batas Maksimal Upload Bukti Pembyaran 24 Jam Setelah Invoice Muncul</label>
                        <label for="bukti_pembayaran" class="form-label"> Bukti Pembayaran <small class="text-danger">(*.jpeg,*.jpg,*.png)</small></label>
                        <div class="pt-2 btn-group">
                            <input type="file" class="form-control" name="bukti_pembayaran" id="bukti_pembayaran" required visibleat=>
                            @error('bukti_pembayaran')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <button type="submit" class="btn btn-primary"> Unggah</button>
                        </div>
                    </form>
                </div>
            </div>
            @if ($invoice->bukti_pembayaran != '')
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-file-earmark-text"></i>
                            Lihat Bukti Pembayaran
                        </button>
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Bukti Pemayaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{ url('assets/upload/images/bukti_pembayaran/' . $invoice->bukti_pembayaran) }}" alt="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
</div>
@endsection
@section('js')
@endsection