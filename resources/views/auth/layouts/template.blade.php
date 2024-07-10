<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin/layouts/meta')
    @include('admin/layouts/css')

</head>

<body
    style="background-size: cover; height: auto; background-position: center center; background-repeat: no-repeat; background-image: url('/assets/admin/img/bg.jpg'); min-height: 100%;">

    @yield('main')

    @include('admin/layouts/js')

</body>

</html>
