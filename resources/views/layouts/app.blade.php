<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh szalon</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

    {{-- FLATPICKR CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
    .idopont-btn {
        min-width: 90px;
        transition: 0.2s;
    }

    .idopont-btn.active {
        background-color: #198754 !important;
        color: #fff !important;
        border-color: #198754 !important;
        transform: scale(1.08);
    }

    .idopont-btn:hover {
        transform: scale(1.04);
    }

    .alert-custom {
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 15px;
    }

    .dolgozo-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .dolgozo-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 1rem 3rem rgba(0,0,0,0.15) !important;
        z-index: 10;
    }
    .hero-slide {
        height: 85vh;
        position: relative;
    }

    .hero-img {
        height: 100%;
        object-fit: cover;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .carousel-caption {
        z-index: 2; 
        bottom: 0;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-up {
        animation: fadeUp 1s ease-out forwards;
        opacity: 0;
    }

    .delay-100 { animation-delay: 0.2s; }
    .delay-200 { animation-delay: 0.4s; }
    .brand-logo {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: #1b1b1b;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .brand-logo:hover {
        color: #0d6efd;
    }

    .brand-italic {
        font-style: italic;
        font-weight: 400;
        color: #555;
    }
</style>

</head>

<body>

{{-- Menü --}}
<nav class="navbar navbar-light bg-light shadow-sm fixed-top">
    <div class="container d-flex justify-content-between align-items-center">
        
        {{-- Logó / Márkanév --}}
        <a class="navbar-brand brand-logo" href="{{ route('home') }}">
            Fresh <span class="brand-italic">szalon</span>
        </a>

        {{-- Dropdown Menü --}}
        <div class="dropdown">
            <button class="btn btn-outline-dark dropdown-toggle" type="button" id="mainMenuDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Menü
            </button>
            
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="mainMenuDropdown">
                {{-- Általános menüpontok --}}
                <li><a class="dropdown-item" href="{{ route('home') }}">Főoldal</a></li>
                <li><a class="dropdown-item" href="{{ route('szolgaltatasok.index') }}">Szolgáltatások</a></li>
                <li><a class="dropdown-item" href="{{ route('idopontfoglalas.index') }}">Időpontfoglalás</a></li>
                
                {{-- Megjegyzés: A Kapcsolat route-ot nem láttam a web.php-ban, így hagyom sima linken --}}
                <li><a class="dropdown-item" href="{{ route('dolgozok.index') }}">Munkatársaink</a></li>
                <li><a class="dropdown-item" href="/kapcsolat">Kapcsolat</a></li>


                <li><hr class="dropdown-divider"></li>

                {{-- Vendég nézet --}}
                @guest
                    <li><a class="dropdown-item" href="{{ route('login') }}">Bejelentkezés</a></li>
                    <li><a class="dropdown-item" href="{{ route('register') }}">Regisztráció</a></li>
                @endguest

                {{-- Bejelentkezett felhasználó --}}
                @auth
                    <li class="dropdown-header text-muted">Fiók: {{ Auth::user()->name }}</li>
                    <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profilom</a></li>
                    
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                Kijelentkezés
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>

    </div>
</nav>

{{-- Tartalom --}}
<main class="py-4 pt-5 mt-4">
    @yield('content')
</main>

{{-- Lábléc --}}
<footer class="bg-dark text-white text-center py-3">
    <div class="container">
        <p>Fresh szalon &copy; {{ date('Y') }}</p>
        <p>Cím: Szalon utca 1. | Telefon: +36 1 234 567 | Email: info@freshszalon.hu</p>
    </div>
</footer>

{{-- FLATPICKR JS --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/hu.js"></script>


{{-- Oldal-specifikus JS --}}
@yield('scripts')

</body>
</html>
