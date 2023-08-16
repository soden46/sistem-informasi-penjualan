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
                                                    <th scope="col">Bank</th>
                                                    <th scope="col">No Rekening</th>
                                                    <th scope="col">Nama Rekening</th>
                                                    <th scope="col">Dibuat</th>
                                                    <th scope="col">Diperbarui</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rekening as $no => $item)
                                                    <tr>
                                                        <th scope="row">{{ $no + 1 }}</th>
                                                        <td>{{ $item->bank }}</td>
                                                        <td>{{ $item->no_rekening }}</td>
                                                        <td>{{ $item->nama_rekening }}</td>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td>{{ $item->updated_at }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center gap-2">
                                                                <a href="javascript:void(0);" class="btn btn-warning btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#edit-{{ $item->id }}"><i
                                                                        class="bi bi-pencil"></i> Ubah</a>
                                                                <a href="javascript:void(0);" class="btn btn-danger btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete-{{ $item->id }}"><i
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
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title">Tambah {{ $pagetitle }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('create-data-rekening') }}" method="post">
                                        @method('post')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="pt-2">
                                                <label for="bank" class="form-label">Bank</label>
                                                <input bank="text"
                                                    class="form-control @error('bank') is-invalid @enderror" name="bank"
                                                    id="bank"  placeholder="Masukan Nama Bank">
                                                @error('bank')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="pt-2">
                                                <label for="no_rekening" class="form-label">No Rekening</label>
                                                <input type="number"
                                                    class="form-control @error('no_rekening') is-invalid @enderror" name="no_rekening"
                                                    id="no_rekening" placeholder="Masukan No Rekening">
                                                @error('no_rekening')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="pt-2">
                                                <label for="nama_rekening" class="form-label">Nama Rekening</label>
                                                <input type="text"
                                                    class="form-control @error('type') is-invalid @enderror" name="nama_rekening"
                                                    id="nama_rekening" placeholder="Masukan Nama Rekening">
                                                @error('type')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
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
                        @foreach ($rekening as $item)
                            <div class="modal fade" id="delete-{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus {{ $pagetitle }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ url('delete-data-rekening/' . $item->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <div class="modal-body">
                                                Hapus {{ $pagetitle }} <b>{{ $item->bank .' '. $item->no_rekening .' a.n. '. $item->nama_rekening }}</b>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit"class="btn btn-danger">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="edit-{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit {{ $pagetitle }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ url('update-data-rekening/' . $item->id) }}" method="post">
                                            @method('put')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="pt-2">
                                                    <label for="bank" class="form-label">Bank</label>
                                                    <input bank="text"
                                                        class="form-control @error('bank') is-invalid @enderror" name="bank"
                                                        id="bank" value="{{ $item->bank }}" placeholder="Masukan Nama Bank">
                                                    @error('bank')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="pt-2">
                                                    <label for="no_rekening" class="form-label">No Rekening</label>
                                                    <input type="number"
                                                        class="form-control @error('no_rekening') is-invalid @enderror" name="no_rekening"
                                                        id="no_rekening" value="{{ $item->no_rekening }}" placeholder="Masukan No Rekening">
                                                    @error('no_rekening')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="pt-2">
                                                    <label for="nama_rekening" class="form-label">Nama Rekening</label>
                                                    <input type="text"
                                                        class="form-control @error('nama_rekening') is-invalid @enderror" name="nama_rekening"
                                                        id="nama_rekening" value="{{ $item->nama_rekening }}" placeholder="Masukan Nama Rekening">
                                                    @error('nama_rekening')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
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
