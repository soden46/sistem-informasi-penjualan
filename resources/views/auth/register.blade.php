@extends('auth.layouts.template')
@section('main')
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center ">
            <div class="container">
                <div class="row justify-content-start">
                    <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="pb-2">
                            <div class="d-flex align-items-center py-4 flex-column">
                                <a href="{{ url('') }}" class="d-flex align-items-center w-auto">
                                    <img src="{{ url('assets/homepage/img/amarta.png') }}" alt="" style="height: 170px;">
                                </a>
                            </div><!-- End Logo -->
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="card mb-3" style="border-radius: 20px">
                            <div class="card-body">
                                <div class="pt-4 pb-4">
                                    <h1 class="fw-bold fs-3">Daftar akun</h1>
                                </div>
                                <form action="{{ url('create-data-pelanggan') }}" method="POST" class="row g-3 needs-validation" novalidate>
                                    @csrf
                                    <div class="row pt-2">
                                        <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Masukan Nama Lengkap">
                                            @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                                        <div class="col-sm-9">
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="username" class="form-control" placeholder="Masukan username" id="yourUsername" required>
                                                @error('username')
                                                <div class="ivalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password" class="form-control" placeholder="Masukan password" id="yourPassword" required>
                                            @error('password')
                                            <div class="ivalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" name="email" class="form-control" placeholder="Masukan Email" id="email" required>
                                            @error('email')
                                            <div class="ivalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <label for="phone" class="col-sm-3 col-form-label">Telepon</label>
                                        <div class="col-sm-9">
                                            <input type="tel" min="0" name="phone" class="form-control" placeholder="Masukan phone" id="phone" required>
                                            @error('phone')
                                            <div class="ivalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <label for="address" class="col-sm-3 col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <textarea name="address" class="form-control" id="" cols="30" rows="2"></textarea>
                                            @error('address')
                                            <div class="ivalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-primary w-50" type="submit">Daftar</button>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Sudah punya akun? <a href="{{ url('login') }}"><b>Login</b></a></label>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection