    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 col-md-6">
                    <h5 class="text-white mb-4">Kantor Kami</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{ profile()->alamat }}</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>{{ profile()->telepon }}</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{ profile()->email }}</p>
                    <div class="d-flex pt-3">
                        <a class="btn btn-square btn-primary rounded-circle me-2"
                            href="https://wa.me/{{ profile()->whatsapp }}"><i class="fab fa-whatsapp"></i></a>
                        <a class="btn btn-square btn-primary rounded-circle me-2" href="{{ profile()->facebook }}"><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-primary rounded-circle me-2" href="{{ profile()->instagram }}"><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <h5 class="text-white mb-4">Tentang</h5>
                    <p>{{ profile()->tentang }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container text-center">
            <p class="mb-2">Copyright &copy; {{ date('Y') }} <a class="fw-semi-bold" href="#">{{ profile()->nama_perusahaan }}</a>
            </p>
        </div>
    </div>
    <!-- Copyright End -->
