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
                        <div class="pb-3">
                            <a href="javascrip:void(0)" data-bs-toggle="modal" data-bs-target="#create"
                                class="btn btn-primary"><i class="bi bi-plus"></i> Tambah</a>
                        </div>
                        <div class="col-md-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <div class="pt-3">
                                        <table class="table table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Kategori</th>
                                                    <th scope="col">Nama Barang</th>
                                                    <th scope="col">Deskripsi</th>
                                                    <th scope="col">Stok</th>
                                                    <th scope="col">Satuan</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($barang as $no => $item)
                                                    <tr>
                                                        <th scope="row">{{ $no + 1 }}</th>
                                                        <td>{{ $item->nama_kategori }}</td>
                                                        <td>{{ $item->nama_barang }}</td>
                                                        <td>{{ $item->deskripsi }}</td>
                                                        <td>{{ $item->stok }}</td>
                                                        <td>{{ $item->satuan }}</td>
                                                        <td>{{ $item->harga }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center gap-2">
                                                                <a href="javascript:void(0);" class="btn btn-info btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view-{{ $item->id_barang }}"><i
                                                                        class="bi bi-eye"></i> Lihat</a>
                                                                <a href="javascript:void(0);" class="btn btn-warning btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#edit-{{ $item->id_barang }}"><i
                                                                        class="bi bi-pencil"></i> Ubah</a>
                                                                <a href="javascript:void(0);" class="btn btn-danger btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete-{{ $item->id_barang }}"><i
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

                        <div class="modal fade" id="create" data-bs-backdrop="static" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title">Tambah {{ $pagetitle }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('create-data-mebel') }}" method="post"
                                        enctype="multipart/form-data">
                                        @method('post')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row pt-2">
                                                <label for="id_kategori" class="col-sm-2 col-form-label">Kategori</label>
                                                <div class="col-sm-10">
                                                    <select name="id_kategori" id="id_kategori"
                                                        class="form-select @error('id_kategori') is-invalid @enderror">
                                                        <option value="">--Pilih--</option>
                                                        @foreach ($kategori as $data)
                                                            <option value="{{ $data->id_kategori }}">
                                                                {{ $data->nama_kategori }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_kategori')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                                                <div class="col-sm-10">
                                                    <input type="text"
                                                        class="form-control @error('nama_barang') is-invalid @enderror"
                                                        name="nama_barang" id="guru" placeholder="Masukan Nama Barang">
                                                    @error('nama_barang')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                                <div class="col-sm-10">
                                                    <input type="text"
                                                        class="form-control @error('deskripsi') is-invalid @enderror"
                                                        name="deskripsi" id="guru" placeholder="Masukan Deskripsi">
                                                    @error('deskripsi')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                                                <div class="col-sm-10">
                                                    <input type="number" min="0"
                                                        class="form-control @error('stok') is-invalid @enderror"
                                                        name="stok" id="guru" placeholder="Masukan stok">
                                                    @error('stok')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                                                <div class="col-sm-10">
                                                    <input type="text" min="0"
                                                        class="form-control @error('satuan') is-invalid @enderror"
                                                        name="satuan" id="guru" placeholder="Masukan satuan">
                                                    @error('satuan')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                                                <div class="col-sm-10">
                                                    <input type="number" min="0"
                                                        class="form-control @error('harga') is-invalid @enderror"
                                                        name="harga" id="guru" placeholder="Masukan harga">
                                                    @error('harga')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <label for="foto" class="col-sm-2 col-form-label">Gambar</label>
                                                <div class="col-sm-10">
                                                    <input type="file"
                                                        class="form-control @error('foto') is-invalid @enderror"
                                                        name="foto" id="foto">
                                                    @error('foto')
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
                        @foreach ($barang as $item)
                            <div class="modal fade" id="delete-{{ $item->id_barang }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus {{ $pagetitle }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ url('delete-data-mebel/' . $item->id_barang) }}" method="post">
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

                            <div class="modal fade" id="edit-{{ $item->id_barang }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit {{ $pagetitle }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ url('update-data-mebel/' . $item->id_barang) }}" method="post"
                                            enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row pt-2">
                                                    <label for="id_kategori"
                                                        class="col-sm-2 col-form-label">Kategori</label>
                                                    <div class="col-sm-10">
                                                        <select name="id_kategori" id="id_kategori"
                                                            class="form-select @error('id_kategori') is-invalid @enderror">
                                                            <option value="">--Pilih--</option>
                                                            @foreach ($barang as $data)
                                                                <option {!! $item->id_kategori == $data->id_kategori ? 'selected' : '' !!}
                                                                    value="{{ $data->id_kategori }}">
                                                                    {{ $data->nama_kategori }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('id_kategori')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row pt-2">
                                                    <label for="nama_barang" class="col-sm-2 col-form-label">Nama
                                                        Barang</label>
                                                    <div class="col-sm-10">
                                                        <input type="text"
                                                            class="form-control @error('nama_barang') is-invalid @enderror"
                                                            name="nama_barang" value="{!! $item->nama_barang !!}"
                                                            id="nama_barang" placeholder="Masukan Nama Barang">
                                                        @error('nama_barang')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row pt-2">
                                                    <label for="deskripsi"
                                                        class="col-sm-2 col-form-label">Deskripsi</label>
                                                    <div class="col-sm-10">
                                                        <input type="text"
                                                            class="form-control @error('deskripsi') is-invalid @enderror"
                                                            name="deskripsi" value="{!! $item->deskripsi !!}"
                                                            id="deskripsi" placeholder="Masukan Nama Barang">
                                                        @error('deskripsi')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row pt-2">
                                                    <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" min="0"
                                                            class="form-control @error('stok') is-invalid @enderror"
                                                            name="stok" value="{{ $item->stok }}" id="stok"
                                                            placeholder="Masukan stok">
                                                        @error('stok')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row pt-2">
                                                    <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" min="0"
                                                            class="form-control @error('satuan') is-invalid @enderror"
                                                            name="satuan" value="{{ $item->satuan }}" id="satuan"
                                                            placeholder="Masukan satuan">
                                                        @error('satuan')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row pt-2">
                                                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" min="0"
                                                            class="form-control @error('harga') is-invalid @enderror"
                                                            name="harga" value="{{ $item->harga }}" id="harga"
                                                            placeholder="Masukan Harga">
                                                        @error('harga')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row pt-2">
                                                    <label for="foto" class="col-sm-2 col-form-label">Gambar</label>
                                                    <div class="col-sm-10">
                                                        <input type="file"
                                                            class="form-control @error('foto') is-invalid @enderror"
                                                            name="foto" id="foto">
                                                        @error('foto')
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

                            <div class="modal fade" id="view-{{ $item->id_barang }}" tabindex="-1">
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
                                                        <div class="d-flex align-items-center flex-column">
                                                            <img src="{{ url('assets/upload/images/barang/' . $item->foto) }}"
                                                                alt="" class="img-fluid"
                                                                style="height: 230px; border-radius: 10px">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 pt-3">
                                                        <table class="table">
                                                            <tr>
                                                                <th>Kategori</th>
                                                                <th>:</th>
                                                                <td>{{ $item->nama_kategori }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Nama Barang</th>
                                                                <th>:</th>
                                                                <td>{{ $item->nama_barang }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Harga</th>
                                                                <th>:</th>
                                                                <th>{{ 'Rp.' . number_format($item->harga) . '/' . $item->satuan }}
                                                                </th>
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
                    </div>
                </div>
                <!-- End Left side columns -->

            </div>
        </section>

    </main><!-- End #main -->
@endsection
@section('js')
@endsection
