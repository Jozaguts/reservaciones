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
            <h2 class="nav-title-container__title">Demo</h2>
        </div>
        <div class="user-name-contanier">
               
            <h4 class="user-name-contanier__user-name" id="btnUserName" >{{Auth::user()->name}} 
                <span class="arrow-down"></span> 
            </h4>
         
        </div>
    </nav>
    <form  action="{{ route('logout') }}" method="POST" class="d-none" id="btnLogOut">
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
            <a class="nav-link text-dark font-weight-bold custom-link" href="#" id="btnAct">Actividades
                    <ul class="ul-content" id="ulAct">
                            <li class="list__item li-actividadaes">Tipo de Actividades</li>
                            <li class="list__item li-actividadaes">Equipos para Actividades</li>
                            <li class="list__item li-actividadaes">Pases y Precios</li>
                            <li class="list__item li-actividadaes">Horarios</li>
                        </ul>
            </a>  
          
        </div>
       
        <div class="grid-item">
            <a class="nav-link text-dark font-weight-bold custom-link" href="#" id="btnCom">Comisionistas
                <ul class="ul-content" id="ulCom">
                    <li class="list__item li-comisionistas ">Pago a Comisionistas</li>
                    <li class="list__item li-comisionistas">Catálogo de Comisionistas</li>  
                </ul>
            </a>
            
        </div>
        <div class="grid-item">
            <a class="nav-link text-dark font-weight-bold custom-link" href="#">Cortes</a>
        </div>
        <div class="grid-item">
            <a class="nav-link text-dark font-weight-bold custom-link" href="#">Cobranza</a>
        </div>
        <div class="grid-item">
            <a class="nav-link text-dark font-weight-bold custom-link" href="#" id="btnCup">Cupones
                <ul class="ul-content" id="ulCup">
                    <li class="list__item li-cupones">Inventario de Cupones</li>
                    <li class="list__item li-cupones">Autorización de Cupones</li>
                    <li class="list__item li-cupones">Generacón Manual</li>
                   
                </ul>
            </a>
        </div>
        <div class="grid-item">
            <a class="nav-link text-dark font-weight-bold custom-link" href="#">Reportes</a>
        </div>
        <div class="grid-item">
            <a class="nav-link text-dark font-weight-bold custom-link" href="#" id="btnAdm">Administración
                <ul class="ul-content" id="ulAdm">
                    <li class="list__item li-administracion">Usuarios</li>
                    <li class="list__item li-administracion">Formas de Pago y Tipos de Cambio</li>
                </ul>      
            </a>
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