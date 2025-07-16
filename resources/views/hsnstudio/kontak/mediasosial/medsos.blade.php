@extends('hsnstudio.layouts.app')

@section('title', 'Media Sosial Kami - HSN Studio')

@section('content')
<style>
/* General Container */


/* Card Styling */
.content-page-card {
    background: #fff;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s ease;
}

.content-page-card:hover {
    transform: translateY(-5px);
}

.content-page-card h2 {
    color: #ec407a; /* Pink */
    font-weight: bold;
    margin-bottom: 20px;
}

.content-page-card .lead {
    font-size: 1.2rem;
    color: #555;
}

/* Grid for Social Icons */
.social-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

/* Social Link Container */
.social-link {
    text-decoration: none;
    color: #333;
    transition: transform 0.3s ease;
}

.social-link:hover {
    transform: scale(1.05);
}

/* Icon Circle Base */
.social-icon-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    margin: 0 auto 10px;
    color: white;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    transition: background 0.3s ease, transform 0.3s ease;
}

/* Platform Colors */
.instagram {
    background: linear-gradient(45deg, #feda75, #d62976, #962fbf, #4f5bd5);
}

.facebook {
    background-color: #3b5998;
}

.twitter {
    background-color: #1da1f2;
}

.tiktok {
    background: linear-gradient(45deg, #ff0050, #00f2ea);
}

.youtube {
    background-color: #ff0000;
}

/* Text below icon */
.social-link p {
    font-weight: 600;
    color: #444;
}
</style>

<div class="container content-page-container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="content-page-card">
                <h2>Ikuti Kami! 💖</h2>
                <p class="lead mb-5">Jangan sampai ketinggalan update terbaru, karya, dan keseruan lainnya dari kami!</p>

                {{-- Grid untuk Ikon Media Sosial --}}
                <div class="social-grid">
                    
                    <a href="#" class="social-link">
                        <div class="social-icon-circle instagram">
                            <i class="fab fa-instagram"></i>
                        </div>
                        <p>Instagram</p>
                    </a>

                    <a href="#" class="social-link">
                        <div class="social-icon-circle facebook">
                            <i class="fab fa-facebook-f"></i>
                        </div>
                        <p>Facebook</p>
                    </a>

                    <a href="#" class="social-link">
                        <div class="social-icon-circle twitter">
                            <i class="fab fa-twitter"></i>
                        </div>
                        <p>Twitter</p>
                    </a>

                    <a href="#" class="social-link">
                        <div class="social-icon-circle tiktok">
                            <i class="fab fa-tiktok"></i>
                        </div>
                        <p>TikTok</p>
                    </a>

                    <a href="#" class="social-link">
                        <div class="social-icon-circle youtube">
                            <i class="fab fa-youtube"></i>
                        </div>
                        <p>YouTube</p>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br><br>
@endsection