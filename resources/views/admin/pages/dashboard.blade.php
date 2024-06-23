@extends('admin.layouts.template')

@section('main')
<main id="main" class="main">

    @include('admin.layouts.breadcrumb')

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Aksi</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ url('user/data-pelanggan') }}">Lihat</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Pelanggan <span>| Daftar Pelanggan</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ count($pelanggan) }} </h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Aksi</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ url('data-mebel') }}">Lihat</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Produk <span>| Daftar Produk</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-card-checklist"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ count($barang) }} </h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Aksi</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ url('data-transaksi') }}">Lihat</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Transaksi <span>| Daftar Transaksi</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-bookmark-star"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ count($transaksi) }} </h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>

</main><!-- End #main -->
@endsection