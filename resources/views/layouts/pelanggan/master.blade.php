<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font google popins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- link style css -->
    <link rel="stylesheet" href="{{ asset('assets/front_asset/CSS/style.css') }}">
    <!-- link booststrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    <link href="{{ asset('assets/front_asset/image/blue washing machine.png') }}" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>Almuna Laundry | @yield('title')</title>
</head>

@include('layouts.pelanggan.app.header')

<body>
    @yield('content')
</body>
@include('layouts.pelanggan.app.footer')

</html>
