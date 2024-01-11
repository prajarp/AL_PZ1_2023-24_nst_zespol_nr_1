<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pedaliadia')</title>
    <!-- Include your CSS files or CDN links here -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @laravelViewsStyles
</head>
<body style = "background-color:#ededed">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            {{-- <img src="{{ asset('png/logo.png') }}" alt="Logo" height="30"> --}}
            Miejsce na logo
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <!-- Add your dropdown menus here -->
                <li class="nav-item">
                    <a class = "nav-link" href=" {{ route('books') }}">Ksiazki</a>
                </li>
            </ul>

            <div class="navbar-nav">
                <!-- Place for username or login/logout links -->
                @if(!session()->exists('user'))
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="menu2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{session()->get('user')}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="menu2">
                        @if(strtolower(session()->get('userRole'))=='admin')
                        <a class="dropdown-item btn btn-secondary" onclick="window.location='{{route('maintainBooks')}}'">Zarzadzaj Ksiazkami</a>
                        <a class="dropdown-item btn btn-secondary" onclick="window.location='{{route('maintainUsers')}}'">Zarzadzaj Uzytkownikami</a>
                        @else
                        <a class="dropdown-item btn btn-secondary" onclick="window.location='{{route('showCart')}}'">Koszyk</a>
                        <a class="dropdown-item btn btn-secondary" onclick="window.location='{{route('showBooks')}}'">Wypozyczone Ksiazki</a>
                        <a class="dropdown-item btn btn-secondary" onclick="window.location='{{route('history')}}'">Historia Zamowien</a>
                        @endif
                    </div>
                </li>
                    <span class="navbar-text mr-3 btn btn-secondary" onclick="window.location='{{route('logout')}}'">Wyloguj sie</span>
                @endif
            </div>
        </div>
    </nav>

    <div class="container mt-4" style="background-color:#ededed">
        @yield('content')
    </div>

    <!-- Include your JS files or CDN links here -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @laravelViewsScripts
</body>
</html>
