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
    <nav class="nav navbar bg-success nav-home">
        <div class="nav-title-container">
            <h2 class="nav-title-container__title">Tropical-Adventures</h2>
        </div>
        <div class="user-name-contanier">
               
            <h4 class="user-name-contanier__user-name" id="userName">{{Auth::user()->name}} 
                <span class="arrow-down"></span> 
            </h4>
         
        </div>
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        <button type="submit" class="btn btn-success btn-log-out">Cerrar sesion</button>
        @csrf
    </form>

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

<script src="{{asset('js/all.js')}}"></script>
    
</body>
</html>