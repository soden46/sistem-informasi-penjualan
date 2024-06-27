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
            <form action="" method="GET">
                <div class="row">
                    <div class="col-lg-6 d-flex gap-2 pb-4">
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
                                                <th>Nama Kategori</th>
                                                <th>Nama Barang</th>
                                                <th>Deskripsi</th>
                                                <th>Stok</th>
                                                <th>Satuan</th>
                                                <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($produk as $item)
                                            <tr>
                                                <td>{{ $item->nama_kategori }}</td>
                                                <td>{{ $item->nama_barang }}</td>>
                                                <td>{{ $item->deskripsi }}</td>
                                                <td>{{ $item->stok }}</td>
                                                <td>{{ $item->satuan }}</td>
                                                <td>{{ $item->harga }}</td>
                                                
                                                <!-- gambar -->
                                            </tr>
                                            @endforeach
                                        </tbody>
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