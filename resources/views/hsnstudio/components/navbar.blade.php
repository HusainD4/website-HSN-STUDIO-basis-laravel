<nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top navbar-custom">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4 text-uppercase" href="{{ url('/') }}">HSN Studio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link px-3 {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3" href="#" id="layananDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Layanan
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="layananDropdown">
                        <li><a class="dropdown-item" href="{{ url('/produk') }}">Produk Kami</a></li>
                        <li><a class="dropdown-item" href="{{ url('/kategori') }}">Kategori</a></li>
                        <li><a class="dropdown-item" href="{{ url('/jasa') }}">Jasa Kami</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3" href="#" id="tentangDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tentang Kami
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="tentangDropdown">
                        <li><a class="dropdown-item" href="{{ url('/portofolio') }}">Portofolio</a></li>
                        <li><a class="dropdown-item" href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
                        <li><a class="dropdown-item" href="{{ url('/logo-brand') }}">Logo Brand</a></li>
                        <li><a class="dropdown-item" href="{{ url('/galeri-kami') }}">Galeri Kami</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3" href="#" id="kontakDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Kontak
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="kontakDropdown">
                        <li><a class="dropdown-item" href="{{ url('/kritiksaran') }}">Kritik dan Saran</a></li>
                        <li><a class="dropdown-item" href="{{ url('/media-sosial') }}">Media Sosial Kami</a></li>
                    </ul>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-3 d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{-- Bisa ganti email dengan avatar kalau ada --}}
                            <i class="bi bi-person-circle fs-4 me-2"></i> 
                            <span class="d-none d-lg-inline">{{ auth()->user()->email }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="profileDropdown">
                            {{-- INI BAGIAN YANG DIPERBAIKI --}}
                            <li><a class="dropdown-item" href="{{ route('settings.index') }}">Settings</a></li>
                            <li><a class="dropdown-item" href="{{ route('account') }}">Account</a></li>
                            <li><a class="dropdown-item" href="{{ route('transaksi.saya') }}">Transaksi Saya</a></li>

                            <li>
                                <a class="dropdown-item" href="{{ route('cart.index') }}">
                                    Keranjang 
                                    @php
                                        $count = is_array(session('cart')) ? count(session('cart')) : 0;
                                    @endphp
                                    @if($count > 0)
                                        <span class="badge bg-danger ms-2">{{ $count }}</span>
                                    @endif
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link px-3" href="{{ route('hsnstudio.login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" href="{{ route('hsnstudio.register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>