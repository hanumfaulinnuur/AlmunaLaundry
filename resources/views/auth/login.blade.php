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
    <title>Almuna Laundry | login</title>
</head>

<body>
    <div class="page-login">
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="row bg-white p-5 rounded-4 shadow p-3 bg-body-tertiary shadaw box-area w-100">
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ asset('assets/front_asset/image/pict.login.png') }}"
                        alt="" />
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <div class="form-login w-100">
                        <h1 class="text-center header-font-style">Almuna Laundry</h1>
                        <h3 class="text-center sub-header-font-style">Masuk Ke Akun Kamu!</h3>

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label login-label">Email</label>
                                <input type="email" id="email" name="email" :value="old('email')"
                                    class="form-control login-input" />
                            </div>

                            <div class="mb-3 position-relative">
                                <label for="password" class="form-label login-label">Password</label>
                                <input type="password" id="password" name="password"
                                    class="form-control login-input" />
                                <i class="bi bi-eye-slash toggle-password"
                                    style="position: absolute; top: 55px; right: 30px; cursor: pointer;"></i>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="mb-3 text-end">
                                    <a class="link-forgot-password" href="{{ route('password.request') }}">Lupa kata
                                        sandi ?</a>
                                </div>
                            @endif

                            <button type="submit" class="button-login">Masuk</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('.toggle-password');
        const passwordInput = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>
</body>

</html>
