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

{{-- Notifikasi --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('message'))
            toastr.success("{{ session('message') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    });
</script>
