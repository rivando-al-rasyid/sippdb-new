<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Harapan Bangsa</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/depan/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/depan/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/depan/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/depan/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/depan/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/depan/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/depan/vendor/venobox/venobox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/depan/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/depan/vendor/aos/aos.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/depan/css/style.css') }}" rel="stylesheet">
    @stack('add-styles')
    <!-- =======================================================
  * Template Name: Bethany - v2.2.0
  * Template asset: https://bootstrapmade.com/bethany-free-onepage-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    @include('sweetalert::alert')
    <!-- ======= Header ======= -->
    @include('depan.partials.header')
    <!-- End Header -->

    {{-- Content --}}
    @yield('content')

    <!-- ======= Footer ======= -->
    @include('depan.partials.footer')
    <!-- End Footer -->

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/depan/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/depan/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/depan/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/depan/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/depan/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/depan/vendor/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/depan/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/depan/vendor/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('assets/depan/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/depan/vendor/aos/aos.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/depan/js/main.js') }}"></script>
    @stack('add-scripts')
</body>

</html>
