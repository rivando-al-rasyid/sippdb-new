<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('user/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('user/img/favicon.png') }}">
    <title>
        Material Dashboard 2 by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('user/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('user/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('user/css/material-kit.css?v=3.1.0') }}" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('layouts.partials.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('layouts.partials.navbar')

        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @yield('content')
        </div>
        <div class="container-fluid py-4">
            @include('layouts.partials.footer')
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="{{ asset('user/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('user/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('user/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('user/js/material-kit.min.js?v=3.1.0') }}"></script>
</body>

</html>
