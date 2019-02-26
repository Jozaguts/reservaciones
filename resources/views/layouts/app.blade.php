<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') {{ config('app.name', 'Tripical Adventures') }}</title>
  

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <link href="{{ asset('css/login-resposive.css') }}" rel="stylesheet">
</head>
<body>
        <nav class="nav navbar nav-home main-navbar">
                <div class="nav-title-container">
                    <h2 class="nav-title-container__title">Tropical-Adventures</h2>
                </div>
                @auth
                <div class="user-name-contanier">
                    <h4 class="user-name-contanier__user-name" id="btnUserName" >{{Auth::user()->name}} 
                            <span class="arrow-down"></span> 
                        </h4>
                </div>
                @endauth
            </nav>
        
        
    </div>
        <main class="py-4 main-container">
            @yield('content')
            @yield('footer')
        </main>
    </div>
    <!-- Scripts -->
    @yield('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
