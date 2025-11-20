<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh szalon</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@yield('scripts')
<body>
    {{-- Menü --}}
<nav class="navbar bg-light">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand fw-bold" href="/">Fresh szalon</a>

        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Főoldal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/szolgaltatasok">Szolgáltatások</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/idopontfoglalas">Időpontfoglalás</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/kapcsolat">Kapcsolat</a>
            </li>

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="/login">Bejelentkezés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Regisztráció</a>
                </li>
            @endguest

            @auth
                <li class="nav-item">
                    <a class="nav-link" href="/profil">Profil</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button class="btn btn-link nav-link p-0 m-0">
                            Kijelentkezés
                        </button>
                    </form>
                </li>
            @endauth
        </ul>
    </div>
</nav>


    {{-- Tartalom --}}
    <main class="py-4">
        @yield('content')
    </main>

    {{-- Lábléc --}}
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p>Fresh szalon &copy; {{ date('Y') }}</p>
            <p>Cím: Szalon utca 1. | Telefon: +36 1 234 567 | Email: info@freshszalon.hu</p>
        </div>
    </footer>

</body>
</html>