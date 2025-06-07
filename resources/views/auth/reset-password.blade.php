<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/front_asset/CSS/style.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }}" />
    <link href="{{ asset('assets/front_asset/image/blue washing machine.png') }}" rel="icon">
    <title>Almuna Laundry | Reset Passowrd</title>
</head>

<body>
    <div class="page-login">
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="row bg-white p-5 rounded-4 shadow p-3  bg-body-tertiary shadaw box-area w-100">
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ asset('assets/front_asset/image/reset-password.png') }}"
                        alt="" />
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <div class="form-login w-100">
                        <h1 class="text-center header-font-style">Konfirmasi Kata Sandi</h1>
                        <h3 class="text-center sub-header-font-style">Masukan Kata Sandi Baru Mu !</h3>
                        <form method="POST" action="{{ route('password.store') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="mb-3">
                                <label for="email" class="form-label login-label">Email</label>
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', $request->email ?? '') }}" required autofocus
                                    autocomplete="username" class="form-control login-input" />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label login-label">Password</label>
                                <input type="password" id="password" name="password" required
                                    autocomplete="new-password" class="form-control login-input" />
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label login-label">Konfirmasi
                                    Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                    autocomplete="new-password" class="form-control login-input" />
                            </div>
                            <button type="submit" class="button-login">Perbarui</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
