<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'HSN Studio')</title>

    <!-- SEO Meta -->
    <meta name="description" content="HSN Studio - Mewujudkan ide digital Anda menjadi karya luar biasa. Kreativitas dan teknologi dalam satu harmoni." />
    <meta name="keywords" content="HSN Studio, Digital Studio, Kreativitas, Teknologi, Portofolio, Layanan Digital" />
    <meta name="author" content="HSN Studio" />

    <!-- Open Graph -->
    <meta property="og:title" content="HSN Studio" />
    <meta property="og:description" content="Mewujudkan ide digital Anda menjadi karya luar biasa. Kreativitas dan teknologi dalam satu harmoni." />
    <meta property="og:image" content="URL-gambar-thumbnail.jpg" />
    <meta property="og:url" content="https://www.hsnstudio.com" />
    <meta property="og:type" content="website" />

    <!-- Favicon -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800&display=swap"
        rel="stylesheet"
    />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    />

    <style>
        html {
            scroll-behavior: smooth;
        }
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
            0% {
                background-position: 200% center;
            }
            100% {
                background-position: -200% center;
            }
        }
        .navbar-brand {
            font-weight: 700 !important;
            background: linear-gradient(
                to right,
                #007bff 20%,
                #ff007f 40%,
                #ff8c00 60%,
                #007bff 80%
            );
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
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.25);
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hero .btn-primary:hover {
            background-color: var(--white);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        .section {
            padding: 80px 0;
        }
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
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .content-page-container {
            padding-top: 5rem;
            padding-bottom: 5rem;
        }
        .content-page-card {
            background-color: var(--white);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            text-align: center;
        }
        .content-page-card h2 {
            margin-bottom: 1.5rem;
        }
        .content-page-card p {
            font-size: 1.1rem;
            line-height: 1.8;
        }

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
            background: rgba(0, 0, 0, 0.6);
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
            background-color: rgba(0, 0, 0, 0.85);
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
    </style>
</head>
<body>
    @include('hsnstudio.components.navbar')

    <main>
        @yield('content')
    </main>

    <!-- Lightbox -->
    <div id="lightbox" class="lightbox">
        <span class="close">&times;</span>
        <img class="lightbox-content" id="lightbox-img" alt="Preview Gambar">
    </div>

    @include('hsnstudio.components.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Lightbox Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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

            if (closeBtn) {
                closeBtn.addEventListener('click', () => {
                    lightbox.style.display = 'none';
                });
            }

            if (lightbox) {
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
