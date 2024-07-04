<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.meta')
    @include('admin.layouts.css')
</head>

<body>

    <!-- ======= Header ======= -->
    <x-notify::notify />

    @include('admin.layouts.header')

    <!-- ======= Sidebar ======= -->
    @include('admin.layouts.sidebar')

    @yield('main')



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('admin.layouts.js')
    @yield('scripts')

</body>

</html>
