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
                            <div class="card-body">
                                <div class="pt-3">
                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Desain</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($custom as $no => $item)
                                            <tr>
                                                <th scope="row">{{ $no + 1 }}</th>
                                                <td>{{ $item->nama_barang }}</td>
                                                <td>{{ $item->jumlah }}</td>
                                                <td><a href="{{asset('storage/'.$item->desain)}}">Lihat Desain</td>
                                                <td>{{ $item->keterangan}}</td>
                                                <td>{{ $item->harga}}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="javascript:void(0);" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#view-{{ $item->id }}"><i class="bi bi-eye"></i> Lihat</a>
                                                        <a href="javascript:void(0);" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-{{ $item->id }}"><i class="bi bi-pencil"></i> Ubah</a>
                                                        <a href="javascript:void(0);" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-{{ $item->id }}"><i class="bi bi-trash"></i> Hapus</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($custom as $item)
                    <div class="modal fade" id="delete-{{ $item->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Hapus {{ $pagetitle }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ url('delete-data-custom/' . $item->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <div class="modal-body">
                                        Hapus {{ $pagetitle }} <b>{{ $item->nama_barang }}</b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="edit-{{ $item->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit {{ $pagetitle }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ url('update-data-custom/' . $item->id) }}" method="post" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row pt-2">
                                            <label for="sku" class="col-sm-2 col-form-label">Nama Barang</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control @error('sku') is-invalid @enderror" name="sku" value="{!! $item->nama_barang !!}" id="sku" readonly>
                                                @error('sku')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row pt-2">
                                            <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                                            <div class="col-sm-10">
                                                <input type="number" min="0" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ $item->harga }}" id="harga" placeholder="Masukan Harga">
                                                @error('harga')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="view-{{ $item->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail {{ $item->nama_barang }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="card-body">
                                    <div class="m-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-flex align-items-center flex-column">
                                                    <img src="{{ url('storage/'.$item->desain) }}" alt="" class="img-fluid" style="height: 230px; border-radius: 10px">
                                                </div>
                                            </div>
                                            <div class="col-md-12 pt-3">
                                                <table class="table">

                                                    <tr>
                                                        <th>Nama Barang</th>
                                                        <th>:</th>
                                                        <td>{{ $item->nama_barang }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Harga</th>
                                                        <th>:</th>
                                                        <th>{{ 'Rp.'. number_format($item->harga) .'/'. $item->jumlah  }}</th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- End Left side columns -->

        </div>
    </section>

</main><!-- End #main -->
@endsection
@section('js')
@endsection