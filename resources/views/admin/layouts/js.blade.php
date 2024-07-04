<!-- jQuery Library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>

<!-- Vendor JS Files -->
<script src="{{ url('assets/admin/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ url('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/admin/vendor/chart.js/chart.min.js') }}"></script>
<script src="{{ url('assets/admin/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ url('assets/admin/vendor/quill/quill.min.js') }}"></script>
<script src="{{ url('assets/admin/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ url('assets/admin/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ url('assets/admin/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ url('assets/admin/js/main.js') }}"></script>

<script>
    window.onload = function() {
        // Contoh notifikasi sukses
        $.notify({
            // options
            message: 'Sukses! Data telah disimpan.'
        }, {
            // settings
            type: 'success',
            delay: 3000,
            placement: {
                from: "top",
                align: "right"
            },
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            template: '<div data-notify="container" class="notify success" role="alert">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>'
        });

        // Contoh notifikasi error
        $.notify({
            // options
            message: 'Terjadi kesalahan, silakan coba lagi.'
        }, {
            // settings
            type: 'error',
            delay: 3000,
            placement: {
                from: "top",
                align: "right"
            },
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            template: '<div data-notify="container" class="notify error" role="alert">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>'
        });
    };
</script>
@notifyJs
