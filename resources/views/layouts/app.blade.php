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
                <li><a class="dropdown-item {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Főoldal</a></li>
                <li><a class="dropdown-item {{ request()->routeIs('szolgaltatasok.index') ? 'active' : '' }}" href="{{ route('szolgaltatasok.index') }}">Szolgáltatások</a></li>
                <li><a class="dropdown-item {{ request()->routeIs('idopontfoglalas.index') ? 'active' : '' }}" href="{{ route('idopontfoglalas.index') }}">Időpontfoglalás</a></li>
                <li><a class="dropdown-item {{ request()->routeIs('termekek.index') ? 'active' : '' }}" href="{{ route('termekek.index') }}">Termékek</a></li>
                <li><a class="dropdown-item {{ request()->routeIs('dolgozok.index') ? 'active' : '' }}" href="{{ route('dolgozok.index') }}">Munkatársaink</a></li>
                <li><a class="dropdown-item {{ request()->is('kapcsolat') ? 'active' : '' }}" href="/kapcsolat">Kapcsolat</a></li>

                <li><hr class="dropdown-divider"></li>

                {{-- Ha NINCS bejelentkezve sem a 'web', sem a 'worker' guarddal (Teljesen vendég) --}}
                @if(!Auth::guard('web')->check() && !Auth::guard('worker')->check())
                    <li><a class="dropdown-item {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Bejelentkezés</a></li>
                    <li><a class="dropdown-item {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">Regisztráció</a></li>
                @endif

                {{-- Ha sima FELHASZNÁLÓKÉNT (web guard) van bejelentkezve --}}
                @if(Auth::guard('web')->check())
                    <li class="dropdown-header text-muted">Fiók: {{ Auth::guard('web')->user()->nev }}</li>
                    <li><a class="dropdown-item {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.index') }}">Profilom</a></li>
                    
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                Kijelentkezés
                            </button>
                        </form>
                    </li>
                @endif

                {{-- Ha DOLGOZÓKÉNT (worker guard) van bejelentkezve --}}
                @if(Auth::guard('worker')->check())
                    <li class="dropdown-header text-primary fw-bold">Dolgozó: {{ Auth::guard('worker')->user()->nev }}</li>
                    <li><a class="dropdown-item {{ request()->routeIs('worker.dashboard') ? 'active' : '' }}" href="{{ route('worker.dashboard') }}">Vezérlőpult</a></li>
                    
                    <li>
                        <form method="POST" action="{{ route('worker.logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                Kijelentkezés
                            </button>
                        </form>
                    </li>
                @endif
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

{{-- ÚJ: Vissza a tetejére (Scroll to Top) gomb --}}
<button type="button" class="btn btn-primary rounded-circle shadow-lg d-none" id="scrollToTopBtn" aria-label="Vissza a tetejére">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
    </svg>
</button>

{{-- FLATPICKR JS --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/hu.js"></script>


{{-- Oldal-specifikus JS --}}
@yield('scripts')

<script>
// Vissza a tetejére gomb logikája
document.addEventListener('DOMContentLoaded', function() {
    const scrollBtn = document.getElementById('scrollToTopBtn');

    // Figyeljük a görgetést
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) { // 300px görgetés után jelenik meg
            scrollBtn.classList.add('show');
            scrollBtn.classList.remove('d-none');
        } else {
            scrollBtn.classList.remove('show');
            // Egy kis késleltetés, hogy az opacity animáció le tudjon futni, mielőtt eltüntetjük (display: none)
            setTimeout(() => {
                if (window.scrollY <= 300) {
                    scrollBtn.classList.add('d-none');
                }
            }, 300);
        }
    });

    // Kattintás esemény
    scrollBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth' // Finom görgetés
        });
    });
});
</script>

</body>
</html>