<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm p-3">
    <div class="container">
        <a class="navbar-brand" href="#">Almuna Laundry</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                <li class="nav-item mx-3">
                    <a class="nav-link" href="{{ route('dashboard') }}">Beranda</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link" href="{{ route('list-service') }}">Order Layanan</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link" href="{{ route('lacak-status') }}">Lacak Status</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link" href="{{ route('tentang-kami') }}">Tentang Kami</a>
                </li>
            </ul>
            @auth
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle custom-name-dropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Hi, {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item p-2" href="{{ route('profile.update') }}"><i
                                    class="bi bi-person-fill"></i> Lihat Profil</a>
                        </li>
                        <li><a class="dropdown-item p-2" href="{{ route('saldo') }}"><i class="bi bi-database-fill"></i>
                                Saldo
                                Deposit</a></li>
                        <li><a class="dropdown-item p-2" href="#"><i class="bi bi-clock-history"></i> Riwayat
                                Order</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item p-2"><i class="bi bi-box-arrow-right"></i>
                                    Keluar</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="button-masuk">Masuk</a>
            @endauth
        </div>
    </div>
</nav>
