    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('assets/homepage/lib/wow/wow.min.js') }}"></script>
    <script src="{{ url('assets/homepage/lib/easing/easing.min.js') }}"></script>
    <script src="{{ url('assets/homepage/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ url('assets/homepage/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ url('assets/homepage/lib/counterup/counterup.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ url('assets/homepage/js/main.js') }}"></script>

    <!--Date Time Picker Library-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <!-- npm install tui-time-picker --save -->
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
