    @extends('home.layouts.template')
    @section('css')
        <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    @endsection
    @section('main')
        @include('home.layouts.breadcrumb')
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="row">
                            <div class="col-xxl-3">
                                <div class="card">
                                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                        <img src="{{ url('assets/admin/images/users/' . login()->photo) }}"
                                            class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                            alt="user-profile-image">
                                    </div>
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                            <div class="col-xxl-9">
                                <div class="card mt-xxl-n5">
                                    @error('error')
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <span class="alert-inner--text"><strong>Gagal!</strong>
                                                {{ $message }}
                                            </span>
                                        </div>
                                    @enderror
                                    @error('success')
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <span class="alert-inner--text"><strong>Berhasil!</strong>
                                                {{ $message }}
                                            </span>
                                        </div>
                                    @enderror
                                    <div class="card-header">
                                        <ul class="nav nav-tabs nav-tabs-bordered">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails"
                                                    role="tab">
                                                    <i class="bi bi-house"></i>
                                                    Profile
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#changePassword"
                                                    role="tab">
                                                    <i class="bi bi-lock"></i>
                                                    Kata Sandi
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                                <form action="{{ url('update-data-pelanggan/' . login()->id) }}"
                                                    method="POST">
                                                    @method('put')
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="firstnameInput" class="form-label">Nama
                                                                    Lengkap</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    id="firstnameInput" placeholder="Masukan Nama Lengkap"
                                                                    value="{{ login()->name }}">

                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="username" class="form-label">Username
                                                                </label>
                                                                <input type="text" class="form-control" name="username"
                                                                    id="username" placeholder="Enter your lastname"
                                                                    value="{{ login()->username }}">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="email" class="form-label">Email
                                                                </label>
                                                                <input type="email" class="form-control" name="email"
                                                                    id="email" placeholder="Enter your Email"
                                                                    value="{{ login()->email }}">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="phone" class="form-label">Telepon
                                                                </label>
                                                                <input type="phone" class="form-control" name="phone"
                                                                    id="phone" placeholder="Enter your phone"
                                                                    value="{{ login()->phone }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label for="address" class="form-label">Alamat
                                                                </label>
                                                                <input type="address" class="form-control" name="address"
                                                                    id="address" placeholder="Enter your address"
                                                                    value="{{ login()->address }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end row-->
                                                    <div class="col-lg-12">
                                                        <div class="d-flex justify-content-center">
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                Perubahan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!--end tab-pane-->
                                            <div class="tab-pane" id="changePassword" role="tabpanel">
                                                <form action="{{ url('update-password/' . login()->id) }}" method="POST">
                                                    @method('put')
                                                    @csrf
                                                    <div class="row g-2">
                                                        <div class="col-lg-12">
                                                            <div>
                                                                <label for="oldpasswordInput" class="form-label">Kata
                                                                    Sandi saat
                                                                    ini <small class="text-danger">*</small></label>
                                                                <input type="password" name="oldpass"
                                                                    class="form-control @error('oldpass') is-invalid @enderror"
                                                                    id="oldpasswordInput"
                                                                    placeholder="Enter current password">
                                                                @error('oldpass')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-lg-12">
                                                            <div>
                                                                <label for="newpasswordInput" class="form-label">Kata
                                                                    sandi baru
                                                                    <small class="text-danger">*</small></label>
                                                                <input type="password" name="newpass"
                                                                    class="form-control @error('newpass') is-invalid @enderror"
                                                                    id="newpasswordInput"
                                                                    placeholder="Enter new password">
                                                                @error('newpass')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-lg-12">
                                                            <div>
                                                                <label for="confirmpasswordInput"
                                                                    class="form-label">Ulangi Kata
                                                                    Sandi Baru <small class="text-danger">*</small></label>
                                                                <input type="password" name="repass"
                                                                    class="form-control @error('repass') is-invalid @enderror"
                                                                    id="confirmpasswordInput"
                                                                    placeholder="Confirm password">
                                                                @error('repass')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-lg-12">
                                                            <div class="d-flex justify-content-center">
                                                                <button type="submit" class="btn btn-primary">Simpan
                                                                    Perubahan</button>
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                    </div>
                                                    <!--end row-->
                                                </form>
                                            </div>
                                            <!--end tab-pane-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('script')
    @endsection
