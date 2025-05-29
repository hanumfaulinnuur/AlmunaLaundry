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
    <title>Almuna Laundry | Forgot Password</title>
</head>

<body>
    <div class="page-login">
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="row bg-white p-5 rounded-4 shadow p-3 bg-body-tertiary shadaw box-area w-100">
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ asset('assets/front_asset/image/forgot-password.png') }}"
                        alt="" />
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <div class="form-login w-100">
                        <h1 class="text-center header-font-style">Lupa Password mu ?</h1>
                        <h3 class="text-center sub-header-font-style my-4">
                            Cukup masukan alamat email Anda dan kami akan mengirimkan tautan reset kata sandi ke email
                            Anda!
                        </h3>

                        <!-- Alert sukses -->
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label login-label">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                    autofocus class="form-control login-input @error('email') is-invalid @enderror" />
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="button-login mt-4">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS bundle untuk fungsi alert dismiss -->
    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
