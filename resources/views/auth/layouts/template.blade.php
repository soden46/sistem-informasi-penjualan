<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin/layouts/meta')
    @include('admin/layouts/css')
    @notifyCss
    <style type="text/css">
        .notify {
            z-index: 1000000;
            margin-top: 2%;
        }
    </style>
</head>

<body
    style="background-size: cover; height: auto; background-position: center center; background-repeat: no-repeat; background-image: url('/assets/admin/img/bg.jpg'); min-height: 100%;">
    <x:notify-messages />
    @yield('main')

    @include('admin/layouts/js')
    @notifyJs
</body>

</html>
