<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/app.css">
<link rel="stylesheet" href="{{asset('css/login-resposive.css')}}">
    <title>Inico</title>
</head>
<body>
    <nav class="nav navbar bg-success">
        <div class="nav-title-container">
            <h2 class="nav-title-container__title">Tropical-Adventures</h2>
        </div>
        <div class="user-name-contanier">
               
        <a href="#" class="user-name-contanier__link">{{Auth::user()->name}}</a>
        <span class="arrow-down"></span> 
            
        </div>
    </nav>
            
{{-- <div class="logout-contanier">

<li class="nav-item dropdown">
<a id="navbarDropdown" class="nav-link dropdown-toggle text-success bg-dark btn-logout" href="#" role="button"                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
{{ Auth::user()->name }} <span class="caret"></span>
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
<a class="dropdown-item" href="{{ route('logout') }}"
onclick="event.preventDefault();
document.getElementById('logout-form').submit();">
{{ __('Cerrar sesión') }}
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
@csrf
</form>
</div>
</li>

</div> --}}
       
  

@auth
<ul class="nav justify-content-center">
    <li class="nav-item bg-light col-sm-6 " >
        <a class="nav-link text-dark font-weight-bold custom-link" href="#">Reservaciones</a>
    </li>
    <li class="nav-item bg-light col-sm-6  ">
        <a class="nav-link text-dark font-weight-bold custom-link " href="#">Actividades</a>
    </li>
    <li class="nav-item bg-light col-sm-6  " >
        <a class="nav-link text-dark font-weight-bold custom-link" href="#">Comisionistas</a>
    </li>
    <li class="nav-item bg-light col-sm-6  ">
        <a class="nav-link text-dark font-weight-bold custom-link" href="#">Cortes</a>
    </li>
    <li class="nav-item bg-light col-sm-6  " >
        <a class="nav-link text-dark font-weight-bold custom-link" href="#">Cobranza</a>
    </li>
    <li class="nav-item bg-light col-sm-6  ">
        <a class="nav-link text-dark font-weight-bold custom-link" href="#">Cupones</a>
    </li>
    <li class="nav-item bg-light col-sm-6  " >
        <a class="nav-link text-dark font-weight-bold custom-link" href="#">Reportes</a>
    </li>
    <li class="nav-item bg-light col-sm-6  ">
        <a class="nav-link text-dark font-weight-bold custom-link" href="#">Administración</a>
    </li>  
  
</ul>
@endauth


    
</body>
</html>