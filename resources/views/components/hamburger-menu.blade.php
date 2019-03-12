<nav class="hamburger-menu" id="hamburgerMenu">
        <a href="#" class="hm-list__link btn-menu" id="btnMenu">
                <span class="hb-icon menu mt-2 ml-4"></span>
         </a>
    <ul class="hm-list d-none mt-5" id="hmContanier">
        
         <div class="user-name-contanier">
                <a href="#" class="hm-list__link ">
                    <h4 class="hm-list__item user-name" id="btnUserName" ><span class="hb-icon user"></span>{{Auth::user()->first_name}} </h4> 
                </a>
            </div>
            <div class="log-out-container">
            <a href="#" class="hm-list__link ">
                <span class="hm-list__item hm-btn-logout log-out"><i class="hb-icon logout"></i>Cerrar Sesión</span>
            </a>
            </div>
                   
     
            
        <a href="{{url('reservaciones')}}" class="hm-list__link">
            <li class="hm-list__item reservaciones"><span class="hb-icon booking"></span>Reservaciones</li>
        </a>
        <a href="#" class="hm-list__link ">
            <li class="hm-list__item actividades" ><span class="hb-icon activity"></span>Actividades</li>
        </a>
        <a href="#" class="hm-list__link ">
        <li class="hm-list__item comisionistas"><span class="hb-icon commission-agent"></span>Comisionistas</li>
        </a>
        <a href="#" class="hm-list__link ">
            <li class="hm-list__item cortes"><span class="hb-icon balance"></span>Cortes</li>
        </a>
        <a href="#" class="hm-list__link ">
            <li class="hm-list__item cobranza"><span class="hb-icon collection"></span>Cobranza</li>
        </a>
        <a href="#" class="hm-list__link ">
            <li class="hm-list__item reportes"><span class="hb-icon reports"></span>Reportes</li>
        </a>
        <a href="#" class="hm-list__link ">
            <li class="hm-list__item cupones"><span class="hb-icon coupons"></span>Cupones</li>
        </a>
        <a href="#" class="hm-list__link ">
            <li class="hm-list__item administracion"><span class="hb-icon administrator"></span>Administración</li>
        </a>

    </ul>
</nav>

{{-- 
       <nav>
            <div class="grid-container">
                    <div class="grid-item"> 
                    <a class="nav-link text-dark font-weight-bold custom-link">Reservaciones</a>
                    </div>
                    <div class="grid-item" >
                        <a class="nav-link text-dark font-weight-bold custom-link" href="#" id="btnAct">Actividades
                                <ul class="ul-content" id="ulAct">
                                    <li class="list__item li-actividadaes">Tipo de Actividades</li>
                                    <li class="list__item li-actividadaes">Actividades</li>
                                    <li class="list__item li-actividadaes">Tipo de Equipos y Unidades</li>
                                    <li class="list__item li-actividadaes">Equipos y Unidades</li>
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
                        <a class="nav-link text-dark font-weight-bold custom-link" href="#">Reportes</a>
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
                        <a class="nav-link text-dark font-weight-bold custom-link" href="#" id="btnAdm">Administración
                            <ul class="ul-content" id="ulAdm">
                                <a href="{{url ('usuarios')}}" class="ul-link"> <li class="list__item li-administracion">Usuarios</li></a>
                                <li class="list__item li-administracion">Formas de Pago y Tipos de Cambio</li>
                            </ul>      
                        </a>
                    </div>
                </div>
       </nav> --}}
