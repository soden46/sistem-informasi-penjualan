@extends('admin.layouts.template')
@section('main')
    <main id="main" class="main">

        @include('admin.layouts.breadcrumb')

        <section class="section profile">
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xxl-3">
                                <div class="card">
                                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                        <img src="{{ url('assets/admin/images/users/' . login()->photo ) }}"
                                            class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                            alt="user-profile-image">
                                        <h2>{{ login()->name }}</h2>
                                        <h3>{{ login()->role }}</h3>
                                    </div>
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                            <div class="col-xxl-9">
                                <div class="card mt-xxl-n5">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs nav-tabs-bordered">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails"
                                                    role="tab">
                                                    <i class="fas fa-home"></i>
                                                    Profile
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#changePassword"
                                                    role="tab">
                                                    <i class="far fa-user"></i>
                                                    Ubah Kata Sandi
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                                <form action="{{ url('update-profile/' . login()->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @method('put')
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="firstnameInput" class="form-label">Nama
                                                                    Lengkap
                                                                    <small class="text-danger">*</small></label>
                                                                <input type="text"
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    name="name" id="firstnameInput"
                                                                    placeholder="Masukan Nama Lengkap"
                                                                    value="{{ login()->name }}">
                                                                @error('name')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="lastnameInput" class="form-label">Nama
                                                                    Pengguna
                                                                    <small class="text-danger">*</small></label>
                                                                <input type="text"
                                                                    class="form-control  @error('username') is-invalid @enderror"
                                                                    name="username" id="lastnameInput"
                                                                    placeholder="Enter your lastname"
                                                                    value="{{ login()->username }}">
                                                                @error('username')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="emailInput" class="form-label">Email <small
                                                                        class="text-danger">*</small></label>
                                                                <input type="email"
                                                                    class="form-control  @error('email') is-invalid @enderror"
                                                                    name="email" id="emailInput"
                                                                    placeholder="Enter your email"
                                                                    value="{{ login()->email }}">
                                                                @error('email')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="foto" class="form-label">Foto Profil
                                                                    <small>
                                                                        *.jpg,*.jpeg,*.png max.5mb</small></label>
                                                                <input type="file" class="form-control" name="photo"
                                                                    id="foto" placeholder="Enter your phone number">
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-lg-12">
                                                            <div class="hstack gap-2 justify-content-center">
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
                                            <div class="tab-pane" id="changePassword" role="tabpanel">
                                                <form action="{{ url('update-password/' . login()->id) }}"
                                                    method="POST">
                                                    @method('put')
                                                    @csrf
                                                    <div class="row g-2">
                                                        <div class="col-lg-4">
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
                                                        <div class="col-lg-4">
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
                                                        <div class="col-lg-4">
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
                        <!--end row-->

                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
            </div>
            <!-- end main content-->
        </section>
    </main>
@endsection
@section('js')
    <script>
        $('#myTab a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });

        // store the currently selected tab in the hash value
        $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
            var id = $(e.target).attr("href").substr(1);
            window.location.hash = id;
        });

        // on load of the page: switch to the currently selected tab
        var hash = window.location.hash;
        $('#myTab a[href="' + hash + '"]').tab('show')
    </script>
@endsection
