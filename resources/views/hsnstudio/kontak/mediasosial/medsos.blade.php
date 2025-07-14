@extends('hsnstudio.layouts.app')

@section('title', 'Media Sosial Kami - HSN Studio')

@section('content')
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
@endsection