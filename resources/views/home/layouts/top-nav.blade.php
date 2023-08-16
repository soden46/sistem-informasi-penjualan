   <!-- Topbar Start -->
   <div class="container-fluid bg-dark px-0">
    <div class="row g-0 d-none d-lg-flex">
        <div class="col-lg-6 ps-5 text-start">
            <div class="h-100 d-inline-flex align-items-center text-white">
                <span>Ikuti kami:</span>
                <a class="btn btn-link text-light" href="{{ profile()->facebook }}"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-link text-light" href="{{ profile()->instagram }}"><i class="fab fa-instagram"></i></a>
                <a class="btn btn-link text-light" href="https://wa.me/{{ profile()->whatsapp }}"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
        <div class="col-lg-6 text-end">
            <div class="h-100 topbar-right d-inline-flex align-items-center text-white py-2 px-5">
                <span class="fs-5 fw-bold me-2"><i class="fa fa-phone-alt me-2"></i>Hubungi Kami:</span>
                <span class="fs-5 fw-bold">{{ profile()->telepon }}</span>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->