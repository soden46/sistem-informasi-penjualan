<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin/layouts/meta')
    @include('admin/layouts/css')
    @notifyCss
</head>

<body
    style="background-size: cover; height: auto; background-position: center center; background-repeat: no-repeat; background-image: url('/assets/admin/img/bg.jpg'); min-height: 100%;">
    <x-notify::notify />
    @yield('main')

    @include('admin/layouts/js')
    @notifyJs
</body>

</html>
