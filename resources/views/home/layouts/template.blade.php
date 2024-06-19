<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $pagetitle . ' | ' . "⁠Sadiman Meubel Simbatan" }}</title>
    @include('home.layouts.meta')
    @include('home.layouts.css')
    @yield('css')
    @notifyCss
</head>
<body>
    <x-notify::notify />
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->

    @include('home.layouts.top-nav')
    @include('home.layouts.navbar')

    @yield('main')

    @include('home.layouts.footer')

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    @include('home.layouts.js')
    @notifyJs
    @yield('js')
</body>
</html>
