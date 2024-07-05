@extends('home.layouts.template')
@section('css')
@endsection
@section('main')
    @include('home.layouts.breadcrumb')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="fw-medium text-uppercase text-primary mb-2">Tentang Kami</p>
                    <h1 class="display-5 mb-4">⁠Sidoluhur Furniture</h1>
                    <p class="mb-4" style="text-align: justify">Sidoluhur Furniture didirikan pada tahun 2001. Berawal dari
                        usaha kecil kecilan yang didirikan oleh Ibu Warsi dan Bapak Sadiman, ternyata usaha ini mendapatkan
                        respon positif dari warga sekitar. Tidak hanya menyediakan berbagai macam meubel.</p>
                    <div class="row g-4">
                        <div class="col-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle">
                                    <i class="fa fa-phone-alt text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h6>Telepon</h6>
                                    <span>Telepon</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle">
                                    <i class="fab fa-whatsapp text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h6>Whatspp</h6>
                                    <span>Whatsapp</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0 btn-square bg-primary rounded-circle">
                                    <i class="fa fa-envelope text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h6>Email</h6>
                                    <span>Email</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                    <iframe class="w-100"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.8894568410497!2d111.4443495!3d-7.6950112!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7997982ed9c43b%3A0xee5e71c4c1a049ad!2sAlm.mbah%20Sarnu%20Sambong!5e0!3m2!1sid!2sid!4v1718810884954!5m2!1sid!2sid"
                        frameborder="0" style="min-height: 450px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
@section('script')
@endsection
