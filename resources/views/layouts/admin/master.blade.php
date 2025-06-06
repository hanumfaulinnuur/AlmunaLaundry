<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Almuna Laundry | @yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
                
    <!-- Favicons -->
    <link href="{{ asset('assets/back_asset/img/blue washing machine.png') }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/back_asset/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/back_asset/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/back_asset/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/back_asset/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/back_asset/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/back_asset/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/back_asset/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/back_asset/css/style.css') }}" rel="stylesheet">
</head>

<body>


    <!-- =======  Header ======= -->
    @include('layouts.admin.app.header')
    <!-- =======End Header ======= -->

    <!-- =======   Sidebar ======= -->
    @include('layouts.admin.app.sidebar')
    <!-- ======= End Sidebar ======= -->


    <!-- ======= Content ======= -->
    @yield('content')
    <!-- ======= End Content ======= -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/back_asset/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/back_asset/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/back_asset/vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/back_asset/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/back_asset/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/back_asset/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/back_asset/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/back_asset/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/back_asset/js/main.js') }}"></script>

</body>

</html>
