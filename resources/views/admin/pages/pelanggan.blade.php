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
                        {{-- <div class="pb-3">
                            <a href="javascrip:void(0)" data-bs-toggle="modal" data-bs-target="#create"
                                class="btn btn-primary"><i class="bi bi-plus"></i> Tambah</a>
                        </div> --}}
                        <div class="row">
                            <div class="col-lg-6 d-flex gap-2 pb-4">
                                <a href="{{ url($url) }}" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i>
                                    Cetak PDF </a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <div class="pt-3">
                                        <table class="table table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Username</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Role</th>
                                                    <th scope="col">Dibuat</th>
                                                    <th scope="col">Diperbarui</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user as $no => $item)
                                                    <tr>
                                                        <th scope="row">{{ $no + 1 }}</th>
                                                        <td>{{ $item->nama }}</td>
                                                        <td>{{ $item->username }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->role }}</td>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td>{{ $item->updated_at }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center gap-2">
                                                                <a href="javascript:void(0);" class="btn btn-info btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view-{{ $item->id_user }}"><i
                                                                        class="bi bi-eye"></i> Lihat</a>
                                                                {{-- <a href="javascript:void(0);" class="btn btn-warning btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#edit-{{ $item->id }}"><i class="bi bi-pencil"></i> Ubah</a> --}}
                                                                {{-- <a href="javascript:void(0);" class="btn btn-success btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#reset-{{ $item->id }}"><i class="bi bi-lock"></i> Reset</a> --}}
                                                                <a href="javascript:void(0);" class="btn btn-danger btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete-{{ $item->id_user }}"><i
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
                                    <form action="{{ url('create-data-pelanggan') }}" method="post"
                                        enctype="multipart/form-data">
                                        @method('post')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row pt-2">
                                                <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                                <div class="col-sm-10">
                                                    <input type="text"
                                                        class="form-control @error('nama') is-invalid @enderror"
                                                        name="nama" id="nama" placeholder="Masukan Nama Lengkap">
                                                    @error('nama')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                                <div class="col-sm-10">
                                                    <input type="text"
                                                        class="form-control @error('username') is-invalid @enderror"
                                                        name="username" id="username" placeholder="username">
                                                    @error('username')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" id="email" placeholder="email">
                                                    @error('email')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <label for="no_telepon" class="col-sm-2 col-form-label">No Telepon</label>
                                                <div class="col-sm-10">
                                                    <input type="number"
                                                        class="form-control @error('no_telepon') is-invalid @enderror"
                                                        name="no_telepon" id="no_telepon">
                                                    @error('no_telepon')
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
                        @foreach ($user as $item)
                            <div class="modal fade" id="reset-{{ $item->id_user }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Reset {{ $pagetitle }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ url('reset-data-pelanggan/' . $item->id_user) }}"
                                            method="post">
                                            @method('put')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="alert alert-danger" role="alert">
                                                    Reset Password <b>{{ $item->nama }}</b>? <br>
                                                    Note : Dengan mereset password maka password akun akan kembali ke
                                                    <b>123456</b>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-danger">Reset</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="delete-{{ $item->id_user }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus {{ $pagetitle }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ url('delete-data-pelanggan/' . $item->id_user) }}"
                                            method="post">
                                            @method('DELETE')
                                            @csrf
                                            <div class="modal-body">
                                                Hapus {{ $pagetitle }} <b>{{ $item->nama }}</b>?
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

                            <div class="modal fade" id="edit-{{ $item->id_user }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit {{ $pagetitle }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ url('update-data-pelanggan/' . $item->id_user) }}"
                                            method="post" enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row pt-2">
                                                    <label for="nama" class="col-sm-2 col-form-label">Nama
                                                        Lengkap</label>
                                                    <div class="col-sm-10">
                                                        <input type="text"
                                                            class="form-control @error('nama') is-invalid @enderror"
                                                            name="nama" id="nama" value="{{ $item->nama }}"
                                                            placeholder="Masukan Nama Lengkap">
                                                    </div>
                                                    @error('nama')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="row pt-2">
                                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                                    <div class="col-sm-10">
                                                        <input type="text"
                                                            class="form-control @error('username') is-invalid @enderror"
                                                            name="username" id="username" value="{{ $item->username }}"
                                                            placeholder="username">
                                                        @error('username')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row pt-2">
                                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" min="0"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" id="email" value="{{ $item->email }}"
                                                            placeholder="email">
                                                        @error('email')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row pt-2">
                                                    <label for="no_telepon" class="col-sm-2 col-form-label">No
                                                        Telepon</label>
                                                    <div class="col-sm-10">
                                                        <input type="number"
                                                            class="form-control @error('no_telepon') is-invalid @enderror"
                                                            name="no_telepon" id="no_telepon">
                                                        @error('no_telepon')
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

                            <div class="modal fade" id="view-{{ $item->id_user }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail {{ $item->nama }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="card-body">
                                            <div class="m-3">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <table class="table">
                                                            <tr>
                                                                <th>Nama Lengkap</th>
                                                                <th>:</th>
                                                                <td>{{ $item->nama }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Username</th>
                                                                <th>:</th>
                                                                <td>{{ $item->username }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Email</th>
                                                                <th>:</th>
                                                                <td>{{ $item->email }}</td>
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
