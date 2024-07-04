@extends('admin.layouts.template')
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $pagetitle }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ $pagetitle }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-lg-6 d-flex gap-2 pb-4">
                            <input type="date" class="form-control" value="{{ @$_GET['tgl_dari'] }}" name="tgl_dari">
                            <span class="align-self-center">s.d.</span>
                            <input type="date" class="form-control" value="{{ @$_GET['tgl_sampai'] }}" name="tgl_sampai">
                            <select name="kategori" id="" class="form-select">
                                <option value="">--Kategori--</option>
                                @foreach ($kategori as $item)
                                    <option {{ @$_GET['kategori'] == $item->nama_kategori ? 'selected' : '' }}
                                        value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-success"> Terapkan </button>
                        </div>
                        <div class="col-lg-6 d-flex gap-2 pb-4 justify-content-end">
                            <a href="{{ url('data-laporan') }}" class="btn btn-warning"><i
                                    class="bi bi-arrow-clockwise"></i> Reset </a>
                            <a href="{{ url($url) }}" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i>
                                Cetak PDF </a>
                        </div>
                    </div>
                </form>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <div class="pt-3">
                                        <table class="table table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal Pesanan</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>Nama Barang</th>
                                                    <th>Total Barang</th>
                                                    <th>Total Harga</th>
                                                    <th>Status Pembayaran</th>
                                                    <th>Status Konfirmasi</th>
                                                    <th>Status Pengirirman</th>
                                                    <th>Detail Transaksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $total = 0 @endphp
                                                @foreach ($transaksi as $item)
                                                    @php $total += $item->total_harga @endphp
                                                    <tr>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td>{{ $item->nama_pelanggan }}</td>
                                                        <td>{{ $item->nama_barang }}</td>
                                                        <td>Rp.{{ number_format($item->total_barang) }}</td>
                                                        <td>Rp.{{ number_format($item->total_harga) }}</td>
                                                        <td>{!! $item->status == '0'
                                                            ? '<span class="badge bg-danger">Belum Lunas</span>'
                                                            : ($item->status != '0'
                                                                ? '<span class="badge bg-success"> Lunas </span>'
                                                                : '') !!}</td>
                                                        <td>{!! $item->status == '0'
                                                            ? '<span class="badge bg-danger"> Menunggu Konfirmasi</span>'
                                                            : ($item->status == '1'
                                                                ? '<span class="badge bg-success"> Pesanan Disetujui</span>'
                                                                : '') !!}</td>
                                                        <td>{{ $item->status_pengiriman }}</td>
                                                        <td>
                                                            <a href="{{ url('detail-transaksi/' . $item->id_pembelian) }}"
                                                                class="btn btn-sm btn-success"><i class="bi bi-card-list">
                                                                    Detail</i></a>
                                                            @if ($item->status != '1')
                                                                <a href="{{ url('delete-transaksi/' . $item->id_pembelian) }}"
                                                                    class="btn btn-sm btn-danger"><i class="bi bi-x"></i>
                                                                    Batalkan</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <thead>
                                                <tr>
                                                    <th colspan="4" class="text-end">Total Pendapatan</th>
                                                    <th>Rp.{{ number_format($total) }}</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
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
