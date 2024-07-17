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
                        {{-- <div class="col-lg-6 d-flex gap-2 pb-4">
                            <a href="{{ url($url) }}" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i>
                                Cetak PDF </a>
                        </div> --}}
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
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nama Pelanggan</th>
                                                    <th scope="col">Nama Barang</th>
                                                    <th scope="col">Alamat</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">No HP</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kirim as $no => $item)
                                                    <tr>
                                                        <th scope="row">{{ $no + 1 }}</th>
                                                        <td>{{ $item->nama_pelanggan }}</td>
                                                        <td>{{ $item->nama_barang }}</td>
                                                        <td>{{ $item->alamat_pengiriman }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->no_telepon }}</td>
                                                        <td>{{ $item->status_pengiriman }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center gap-2">
                                                                <a href="javascript:void(0);" class="btn btn-info btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view-{{ $item->id_pembelian }}"><i
                                                                        class="bi bi-eye"></i> Lihat</a>
                                                                <a href="javascript:void(0);" class="btn btn-warning btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#edit-{{ $item->id_pembelian }}"><i
                                                                        class="bi bi-pencil"></i> Ubah</a>
                                                                <a href="javascript:void(0);" class="btn btn-danger btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete-{{ $item->id_pembelian }}"><i
                                                                        class="bi bi-trash"></i> Hapus</a>
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
                    </div>
                </div>
                @foreach ($kirim as $no => $item)
                    <div class="modal fade" id="delete-{{ $item->id_pembelian }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Hapus {{ $pagetitle }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ url('delete-data-pengiriman/' . $item->id_pembelian) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <div class="modal-body">
                                        Hapus {{ $pagetitle }} <b>{{ $item->nama_barang }}</b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="edit-{{ $item->id_pembelian }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit {{ $pagetitle }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ url('update-data-pengiriman/' . $item->id_pembelian) }}" method="post"
                                    enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row pt-2">
                                            <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                    class="form-control @error('nama_barang') is-invalid @enderror"
                                                    name="nama_barang" value="{!! $item->nama_barang !!}" id="nama_barang"
                                                    readonly>
                                                @error('nama_barang')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row pt-2">
                                            <label for="status_pengiriman" class="col-sm-2 col-form-label">Status
                                                Pengiriman</label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                    class="form-control @error('status_pengiriman') is-invalid @enderror"
                                                    name="status_pengiriman" value="{{ $item->status_pengiriman }}"
                                                    id="status_pengiriman" placeholder="Masukan Status Pengiriman">
                                                @error('status_pengiriman')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="view-{{ $item->id_pembelian }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail {{ $item->nama_barang }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="card-body">
                                    <div class="m-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                            </div>
                                            <div class="col-md-12 pt-3">
                                                <table class="table">
                                                    <tr>
                                                        <th>Nama Pelanggan</th>
                                                        <th>:</th>
                                                        <td>{{ $item->nama_pelanggan }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nama Barang</th>
                                                        <th>:</th>
                                                        <td>{{ $item->nama_barang }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Alamat Pengiriman</th>
                                                        <th>:</th>
                                                        <td>{{ $item->alamat }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- End Left side columns -->

            </div>
        </section>

    </main><!-- End #main -->
@endsection
@section('js')
@endsection
