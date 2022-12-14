@php use Illuminate\Support\Facades\Auth; @endphp
    <!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
          crossorigin="anonymous"/>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet"/>
    <title>@yield('title', 'Parkplatzverwaltung')</title>
</head>
<body>
<!-- header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home.index') }}">Parkplatzverwaltung</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="{{ route('home.index') }}">Home</a>
                @if (auth()->check())
                    <a class="nav-link active" href="{{ route('user.show', (Auth::check())? Auth::id() : 0) }}">User</a>
                    <a class="nav-link active" href="{{ route('user.addCar.index') }}">Add Car</a>
                @endif
                <a class="nav-link active" href="{{ route('parking_spot.index') }}">Parkplatz</a>
                <a class="nav-link active" href="{{ route('home.about') }}">About</a>
                <div class="vr bg-white mx-2 d-none d-lg-block"></div>
                @guest
                    <a class="nav-link active" href="{{ route('login') }}">Login</a>
                    <a class="nav-link active" href="{{ route('register') }}">Register</a>
                @else
                    <form id="logout" action="{{ route('logout') }}" method="POST">
                        <a role="button" class="nav-link active"
                           onclick="document.getElementById('logout').submit();">Logout</a>
                        @csrf
                    </form>
                @endguest
                <img class="img-profile rounded-circle  col-1"
                     src=" {{asset( '/storage/media/'. (Auth::user()->image ?? 'undraw_profile.svg')) }} " alt="z">
            </div>
        </div>
    </div>
</nav>

<header class="masthead bg-primary text-white text-center py-4">
    <div class="container d-flex align-items-center flex-column">
        <h2>@yield('subtitle', 'Laravel Parkplatzverwaltung')</h2>
    </div>
</header>
<!-- header -->

<div class="container my-4">
    @yield('content')
</div>

<!-- footer -->
<div class="copyright py-4 text-center text-white">
    <div class="container">
        <small>
            Copyright - <a class="text-reset fw-bold text-decoration-none" target="_blank"
                           href="https://twitter.com/danielgarax">
                Daniel
            </a> - <b>luzumi</b>
        </small>
    </div>
</div>
<!-- footer -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
</body>
</html>
