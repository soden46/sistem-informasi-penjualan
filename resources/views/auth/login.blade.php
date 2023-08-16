@extends('auth.layouts.template')
@section('main')
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="pb-2">
                            <div class="d-flex align-items-center py-4 flex-column">
                                <a href="{{ url('') }}" class="d-flex align-items-center w-auto">
                                    <img src="{{ url('assets/homepage/img/amarta.png') }}" alt="" style="height: 170px;">
                                </a>
                            </div><!-- End Logo -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="card mb-3" style="border-radius: 20px">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h1 class="fw-bold fs-3">Masuk Akun</h1>
                                </div>
                                <form action="{{ url('proses_login') }}" method="POST" class="row g-3 needs-validation" novalidate>
                                    @csrf
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Username</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" name="username" class="form-control" placeholder="Masukan username" id="yourUsername" required>
                                            @if ($errors->has('username'))
                                            <div class="invalid-feedback">{{ $errors->first('username') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Masukan password" id="yourPassword" required>
                                        @if ($errors->has('password'))
                                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>


                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Login</button>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Belum punya akun? <a href="{{ url('register') }}"><b>Daftar</b></a></label>
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