<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') {{ config('app.name', 'Demo') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')

</head>
<body>
@include('components.flash-message')
    <header class="nav navbar nav-home main-navbar">
        <div class="nav-title-container">
            <h2 class="nav-title-container__title">Tropical-Adventures</h2>
        </div>
        @auth
        <div class="user-name-contanier">
            <h4 class="user-name-contanier__user-name" id="btnUserName" >{{Auth::user()->first_name}} <span class="arrow-down"></span> 
            </h4>
        </div>
        @endauth
    </header>
    <form  action="{{ route('logout') }}" method="POST" class="d-none" id="btnLogOut">
        <button type="submit" class="btn main-navbar btn-log-out">Cerrar sesion</button> @csrf
    </form>      
    <main class=" main-container">
        @yield('content')
        @yield('footer')
    </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
    @yield('scripts')
    
  
    @yield('javascript')
</body>
</html>
