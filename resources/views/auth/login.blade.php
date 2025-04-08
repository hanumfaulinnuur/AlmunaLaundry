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
    <title>login</title>
</head>

<body>
    <div class="page-login ">
        <div class="container  d-flex justify-content-center align-items-center min-vh-100">
            <div class="row bg-white p-5 rounded-4 shadow p-3 mb-5 bg-body-tertiary shadaw box-area">
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ asset('assets/front_asset/image/pict.login.png') }}" alt="">
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <div class="form-login">
                        <h1 class="text-center header-font-style">Almuna Laundry</h1>
                        <h3 class="text-center sub-header-font-style">login to your account !</h3>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            {{-- input email --}}
                            <div class="mb-3">
                                <label for="email" :value="__('Email')" class="form-label">Email</label>
                                <input type="email" id="email" name="email" :value="old('email')"
                                    class="form-control">

                            </div>
                            {{-- input password --}}
                            <div class="mb-3">
                                <label for="password" :value="('Password')"  class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <button type="submit" class="button-login">Masuk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>
