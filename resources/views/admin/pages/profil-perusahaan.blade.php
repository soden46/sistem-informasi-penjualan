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

        <section class="section">
            <div class="card recent-sales overflow-auto pt-2">
                <div class="card-body">
                    <div class="pt-3">
                        <form action="{{ url('update-profile-perusahaan/' . $profil->id) }}" method="post"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                        name="nama_perusahaan" value="{{ $profil->nama_perusahaan }}">
                                    @error('nama_perusahaan')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                        name="alamat" value="{{ $profil->alamat }}">
                                    @error('alamat')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Tentang</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control @error('tentang') is-invalid @enderror" name="tentang" style="height: 200px">{{ $profil->tentang }} </textarea>
                                    @error('tentang')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">No Telepon</label>
                                <div class="col-sm-10">
                                    <input type="tel" class="form-control @error('telepon') is-invalid @enderror"
                                        name="telepon" value="{{ $profil->telepon }}">
                                    @error('telepon')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Whatsapp</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control @error('whatsapp') is-invalid @enderror"
                                        name="whatsapp" value="{{ $profil->whatsapp }}">
                                    @error('whatsapp')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $profil->email }}">
                                    @error('nama')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Facebook</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control @error('facebook') is-invalid @enderror"
                                        name="facebook" value="{{ $profil->facebook }}">
                                    @error('facebook')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Instagram</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control @error('instagram') is-invalid @enderror"
                                        name="instagram" value="{{ $profil->instagram }}">
                                    @error('instagram')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class=" d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i> Perbarui</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection
