@extends('hsnstudio.layouts.app')

@section('title', 'Logo Brand & Sejarah - HSN Studio')

@section('content')
<section class="section bg-white text-center" id="logobrand">
    <div class="container">
        <h2 class="mb-4">Logo Brand HSN Studio</h2>
        
        <!-- Logo -->
        <div class="mb-4">
            <img src="{{ asset('images/LogoHsnStudio.png') }}" alt="Logo HSN Studio" class="img-fluid" style="max-width: 200px;">
        </div>
        
        <!-- Sejarah -->
        <div class="text-start mx-auto" style="max-width: 700px;">
            <h3>Sejarah Berdirinya HSN Studio</h3>
            <p>
                HSN Studio didirikan oleh <strong>Husain Mulyansyah</strong> dengan visi untuk menjadi studio kreatif terdepan yang memberikan solusi digital inovatif. 
                Berawal dari sebuah ide sederhana, HSN Studio berkembang menjadi tempat berkumpulnya para kreator berbakat yang berfokus pada desain grafis, pengembangan web, dan produksi konten digital.
            </p>
            <p>
                Dengan komitmen kuat terhadap kualitas dan kepuasan pelanggan, HSN Studio terus berinovasi dan beradaptasi dengan teknologi terbaru demi mendukung pertumbuhan bisnis kliennya.
            </p>
        </div>
    </div>
</section>
@endsection
