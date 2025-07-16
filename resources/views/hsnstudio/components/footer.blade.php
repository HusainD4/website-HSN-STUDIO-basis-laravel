<footer class="footer-custom bg-dark text-white pt-5 pb-4 mt-5 border-top border-secondary">
    <div class="container">
        <div class="row gy-4">
            <!-- Brand & Tagline -->
            <div class="col-lg-4 col-md-6">
                <h3 class="navbar-brand fw-bold fs-4 text-uppercase">HSN Studio</h3>
                <p class="text-light">Mewujudkan ide digital Anda menjadi karya yang luar biasa. Kreativitas dan teknologi dalam satu harmoni.</p>
                <div class="mt-3 d-flex gap-3">
                    <a href="#" class="text-light fs-5" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-light fs-5" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light fs-5" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-light fs-5" title="TikTok"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>

            <!-- Navigasi -->
            <div class="col-lg-2 col-md-6">
                <h5 class="text-uppercase text-info">Navigasi</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/') }}" class="text-light text-decoration-none d-block py-1">Beranda</a></li>
                    <li><a href="{{ url('/produk') }}" class="text-light text-decoration-none d-block py-1">Layanan</a></li>
                    <li><a href="{{ url('/portofolio') }}" class="text-light text-decoration-none d-block py-1">Portofolio</a></li>
                    <li><a href="{{ url('/tentang-kami') }}" class="text-light text-decoration-none d-block py-1">Tentang Kami</a></li>
                    <li><a href="{{ url('/kritiksaran') }}" class="text-light text-decoration-none d-block py-1">Kontak</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-uppercase text-info">Hubungi Kami</h5>
                <ul class="list-unstyled">
                    <li class="py-1"><i class="fas fa-map-marker-alt me-2"></i>Jl. Prof Buya Hamka No. 57, Tegal</li>
                    <li class="py-1"><i class="fas fa-phone me-2"></i>+62 851-9825-7462</li>
                    <li class="py-1"><i class="fas fa-envelope me-2"></i>admin@hsnstudio.com</li>
                </ul>
            </div>

            <!-- Berlangganan -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-uppercase text-info">Berlangganan</h5>
                <p class="text-light">Dapatkan info dan penawaran terbaru dari kami langsung di email Anda.</p>
                <form>
                    <div class="input-group">
                        <input type="email" class="form-control bg-light text-dark" placeholder="Alamat email...">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bottom -->
        <div class="text-center mt-4 border-top pt-3 border-secondary">
            <p class="mb-0 text-light">&copy; {{ date('Y') }} <strong>HSN Studio</strong>. All Rights Reserved.</p>
        </div>
    </div>
</footer>
