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
    <nav class="nav navbar nav-home main-navbar">
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
        <button type="submit" class="btn main-navbar btn-log-out">Cerrar sesion</button>
        @csrf
    </form>

@auth
<main>
    <div class="grid-container">
        <div class="grid-item"> 
            <a class="nav-link text-dark font-weight-bold custom-link" href="#">Reservaciones</a>
        </div>
        <div class="grid-item" >
            <a class="nav-link text-dark font-weight-bold custom-link" href="#" id="linkActividades">Actividades
                    <ul class="d-none" id="ulActividades">
                            <li class="actividades-list__item">Tipo de Actividades</li>
                            <li class="actividades-list__item">Equipos para Actividades</li>
                            <li class="actividades-list__item">Pases y Precios</li>
                            <li class="actividades-list__item">Horarios</li>
                        </ul>
            </a>
          
        </div>
       
        <div class="grid-item">
            <a class="nav-link text-dark font-weight-bold custom-link" href="#">Comisionistas</a>
        </div>
        <div class="grid-item">
            <a class="nav-link text-dark font-weight-bold custom-link" href="#">Cortes</a>
        </div>
        <div class="grid-item">
            <a class="nav-link text-dark font-weight-bold custom-link" href="#">Cobranza</a>
        </div>
        <div class="grid-item">
            <a class="nav-link text-dark font-weight-bold custom-link" href="#">Cupones</a>
        </div>
        <div class="grid-item">
            <a class="nav-link text-dark font-weight-bold custom-link" href="#">Reportes</a>
        </div>
        <div class="grid-item">
            <a class="nav-link text-dark font-weight-bold custom-link" href="#">Administración</a>
        </div>
    </div>
</main>
<section>
    <article>
        {{-- contenido no essificado hasta el moneto --}}
    </article>
</section>
<footer class="footer">
    <span >&#169; <?php echo date("Y");?></span>
</footer>
@endauth

<script src="{{asset('js/all.js')}}"></script>
    
</body>
</html>