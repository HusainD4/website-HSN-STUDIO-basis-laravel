<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HSN Studio')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        :root {
            --bright-blue: #3498db;
            --bright-pink: #e91e63;
            --dark-text: #2c3e50;
            --white: #ffffff;
            --light-bg: #f4f6f9;
        }
        body {
            font-family: 'Nunito', sans-serif;
            background-color: var(--light-bg);
            color: #333;
        }
        .navbar-custom {
            background: linear-gradient(90deg, #0f2027, #203a43, #2c5364);
        }
        @keyframes shine-text {
            0% { background-position: 200% center; }
            100% { background-position: -200% center; }
        }
        .navbar-brand {
            font-weight: 700 !important;
            background: linear-gradient(to right, #007bff 20%, #ff007f 40%, #ff8c00 60%, #007bff 80%);
            background-size: 200% auto;
            color: transparent;
            background-clip: text;
            -webkit-background-clip: text;
            animation: shine-text 5s linear infinite;
        }
        .navbar-nav .nav-link {
            color: #ffffffcc;
            position: relative;
            padding: 8px 0;
            margin: 0 15px;
            transition: color 0.3s ease, transform 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            color: #ffffff;
            transform: translateY(-3px);
        }
        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            width: 0%;
            height: 2px;
            background-color: #ffffff;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            transition: width 0.3s ease;
        }
        .navbar-nav .nav-link:hover::after,
        .navbar-nav .nav-link.active::after {
            width: 100%;
        }
        .hero {
            background: linear-gradient(45deg, var(--bright-blue), var(--bright-pink));
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: 800;
            color: var(--white);
            text-shadow: 2px 2px 4px rgba(0,0,0,0.25);
        }
        .hero p {
            color: var(--white);
            font-weight: 700;
            opacity: 0.9;
        }
        .hero .btn-primary {
            background-color: var(--white);
            color: var(--bright-pink);
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 700;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hero .btn-primary:hover {
            background-color: var(--white);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
        .section { padding: 80px 0; }
        h2 {
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
            margin-bottom: 3rem !important;
            font-weight: 800;
            color: var(--dark-text);
        }
        h2::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(45deg, var(--bright-blue), var(--bright-pink));
            border-radius: 2px;
        }
        #layanan .icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, var(--bright-blue), var(--bright-pink));
            -webkit-background-clip: text;
            color: transparent;
        }
        #layanan h4 {
            font-weight: 700;
            color: #333;
            margin-top: 1.5rem;
        }
        @keyframes bounce-in {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
            transition: box-shadow 0.3s ease;
        }
        .card:hover {
            animation: bounce-in 0.5s ease;
            box-shadow: 0 15px 40px rgba(233, 30, 99, 0.3);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .card .btn-custom {
            background: linear-gradient(45deg, var(--bright-blue), var(--bright-pink));
            border: none;
            color: var(--white);
            font-weight: 700;
            padding: 8px 20px;
            border-radius: 50px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card .btn-custom:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .content-page-container {
            padding-top: 5rem;
            padding-bottom: 5rem;
        }
        .content-page-card {
            background-color: var(--white);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            text-align: center;
        }
        .content-page-card h2 { margin-bottom: 1.5rem; }
        .content-page-card p { font-size: 1.1rem; line-height: 1.8; }
        
        .gallery-grid {
            column-count: 3;
            column-gap: 1rem;
        }
        .gallery-item {
            margin-bottom: 1rem;
            display: inline-block;
            width: 100%;
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            cursor: pointer;
        }
        .gallery-item img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.4s ease;
        }
        .gallery-item .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            color: var(--white);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        .gallery-item:hover img {
            transform: scale(1.1);
        }
        .gallery-item:hover .overlay {
            opacity: 1;
        }
        .overlay .overlay-text {
            font-weight: 700;
            font-size: 1.2rem;
        }
        .overlay .overlay-icon {
            font-size: 2rem;
            margin-top: 0.5rem;
        }
        
        .lightbox {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.85);
            justify-content: center;
            align-items: center;
        }
        .lightbox img {
            max-width: 90%;
            max-height: 80%;
            border-radius: 10px;
        }
        .lightbox .close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: var(--white);
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }
        @media (max-width: 768px) {
            .gallery-grid { column-count: 2; }
        }
        @media (max-width: 576px) {
            .gallery-grid { column-count: 1; }
        }

        .social-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
        }
        .social-link {
            text-decoration: none;
            color: var(--dark-text);
            text-align: center;
            transition: transform 0.3s ease;
        }
        .social-link:hover {
            transform: translateY(-10px);
        }
        .social-icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2.5rem;
            color: var(--white);
            margin: 0 auto 1rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .social-link .instagram { background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%); }
        .social-link .facebook { background: #1877F2; }
        .social-link .twitter { background: #1DA1F2; }
        .social-link .tiktok { background: #000000; }
        .social-link .youtube { background: #FF0000; }
        .social-link p {
            font-weight: 700;
            margin-bottom: 0;
        }

        /*=====================================
          STYLE FOOTER PROFESIONAL
        =======================================*/
        .footer-custom {
            background: linear-gradient(90deg, #0f2027, #203a43, #2c5364); /* Sama seperti navbar untuk konsistensi */
            color: rgba(255, 255, 255, 0.8);
            padding: 80px 0 20px 0;
        }

        .footer-custom .footer-brand {
            font-weight: 700;
            color: var(--white);
            font-size: 1.8rem;
            background: linear-gradient(to right, #3498db 20%, #e91e63 40%, #f1c40f 60%, #3498db 80%);
            background-size: 200% auto;
            color: transparent;
            background-clip: text;
            -webkit-background-clip: text;
            animation: shine-text 5s linear infinite;
        }

        .footer-custom .footer-tagline {
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .footer-custom .footer-heading {
            color: var(--white);
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-custom .footer-heading::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(45deg, var(--bright-blue), var(--bright-pink));
            border-radius: 2px;
        }

        .footer-custom .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            padding-bottom: 5px;
        }

        .footer-custom .footer-links a:hover {
            color: var(--white);
            transform: translateX(5px);
        }

        .footer-custom .footer-contact li {
            margin-bottom: 10px;
        }

        .footer-custom .input-group .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--white);
            border-radius: 50px 0 0 50px;
        }
        .footer-custom .input-group .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        .footer-custom .input-group .form-control:focus {
            background-color: rgba(255, 255, 255, 0.2);
            box-shadow: none;
            border-color: var(--bright-blue);
            color: var(--white);
        }

        .footer-custom .btn-subscribe {
            background: linear-gradient(45deg, var(--bright-blue), var(--bright-pink));
            border: none;
            color: var(--white);
            border-radius: 0 50px 50px 0;
        }

        .footer-custom .footer-social-links .social-icon {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: var(--white);
            text-decoration: none;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .footer-custom .footer-social-links .social-icon:hover {
            background: var(--bright-pink);
            transform: translateY(-5px);
        }

        .footer-custom .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 40px;
            padding-top: 20px;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.6);
        }
    </style>
</head>
<body>
    @include('hsnstudio.components.navbar')

    <main>
        @yield('content')
    </main>

    <div id="lightbox" class="lightbox">
        <span class="close">&times;</span>
        <img class="lightbox-content" id="lightbox-img">
    </div>

    <footer class="footer-custom">
        <div class="container">
            <div class="row gy-4">

                <div class="col-lg-4 col-md-6">
                    <h3 class="footer-brand">HSN Studio</h3>
                    <p class="footer-tagline">Mewujudkan ide digital Anda menjadi karya yang luar biasa. Kreativitas dan teknologi dalam satu harmoni.</p>
                    <div class="footer-social-links mt-3">
                        <a href="#" class="social-icon" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon" title="TikTok"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h4 class="footer-heading">Navigasi</h4>
                    <ul class="footer-links list-unstyled">
                        <li><a href="#">Beranda</a></li>
                        <li><a href="#layanan">Layanan</a></li>
                        <li><a href="#portofolio">Portofolio</a></li>
                        <li><a href="#tentang">Tentang Kami</a></li>
                        <li><a href="#kontak">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h4 class="footer-heading">Hubungi Kami</h4>
                    <ul class="footer-contact list-unstyled">
                        <li><i class="fas fa-map-marker-alt me-2"></i> Jl. Merdeka No. 123, Tegal</li>
                        <li><i class="fas fa-phone me-2"></i> (0283) 123-456</li>
                        <li><i class="fas fa-envelope me-2"></i> kontak@hsnstudio.com</li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h4 class="footer-heading">Berlangganan</h4>
                    <p>Dapatkan info dan penawaran terbaru dari kami langsung di email Anda.</p>
                    <form>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Alamat email..." aria-label="Alamat email">
                            <button class="btn btn-subscribe" type="button"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>

            </div>

            <div class="footer-bottom text-center">
                <p class="mb-0">&copy; {{ date('Y') }} HSN Studio. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // JavaScript untuk Lightbox Galeri
            const galleryItems = document.querySelectorAll('.gallery-item');
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            const closeBtn = document.querySelector('.lightbox .close');

            galleryItems.forEach(item => {
                item.addEventListener('click', () => {
                    lightbox.style.display = 'flex';
                    lightboxImg.src = item.querySelector('img').src;
                });
            });

            if(closeBtn) {
                closeBtn.addEventListener('click', () => {
                    lightbox.style.display = 'none';
                });
            }

            if(lightbox) {
                lightbox.addEventListener('click', (e) => {
                    if (e.target === lightbox) {
                        lightbox.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>
</html>