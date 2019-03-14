<nav class="hamburger-menu" id="hamburgerMenu">
        <a href="#" class="hm-list__link btn-menu" id="btnMenu">
                <span class="hb-icon menu mt-2 ml-4" id="spanBtnMenu" ></span>
         </a>
    <ul class="hm-list d-none mt-5" id="hmContanier">
        
         <div class="user-name-contanier">
                <a href="#" class="hm-list__link ">
                    <h4 class="hm-list__item user-name underline-from-left" id="btnUserName" ><span class="hb-icon user"></span>{{Auth::user()->first_name}} </h4> 
                </a>
            </div>
            <div class="log-out-container">
            <a href="#" class="hm-list__link ">
                <span class="hm-list__item hm-btn-logout log-out "><i class="hb-icon logout"></i>Cerrar Sesión</span>
            </a>
            </div>
                   
     
            
        <a href="{{url('reservaciones')}}" class="hm-list__link">
            <li class="hm-list__item reservaciones"><span class="hb-icon booking"></span>Reservaciones</li>
        </a>
        <a href="#" class="hm-list__link " >
            <li class="hm-list__item actividades" id="actLink" ><span class="hb-icon activity"></span>Actividades</li>
        </a>
        <ul class="sub-ul d-none" id="subUlAct">
            <a href="#" class="sub-li__link"><li class="sub-ul__item sub-li-actividadaes">Tipo de Actividades</li></a>
            <a href="#" class="sub-li__link"><li class="sub-ul__item sub-li-actividadaes">Actividades</li></a>
             <a href="#" class="sub-li__link"><li class="sub-ul__item sub-li-actividadaes">Tipo de Equipos y Unidades</li></a>
           <a href="#" class="sub-li__link"> <li class="sub-ul__item sub-li-actividadaes">Equipos y Unidades</li></a>
        </ul>
        <a href="#" class="hm-list__link ">
        <li class="hm-list__item comisionistas" id="comLink"><span class="hb-icon commission-agent"></span>Comisionistas</li>
        </a>
        <ul class="sub-ul d-none" id="subUlCom">
            <a href="#" class="sub-li__link"><li class="sub-ul__item  sub-li-comisionistas ">Pago a Comisionistas</li></a>
            <a href="#" class="sub-li__link"><li class="sub-ul__item sub-li-comisionistas">Catálogo de Comisionistas</li></a>
        </ul>
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
            <li class="hm-list__item cupones" id="cupLink"><span class="hb-icon coupons"></span>Cupones</li>
        </a>
        <ul class="sub-ul d-none" id="subUlCup">
             <a href="#" class="sub-li__link"><li class="sub-ul__item sub-li-cupones">Inventario de Cupones</li></a>
             <a href="#" class="sub-li__link"><li class="sub-ul__item sub-li-cupones">Autorización de Cupones</li></a>
             <a href="#" class="sub-li__link"><li class="sub-ul__item sub-li-cupones">Generacón Manual</li></a>
        </ul>
        <a href="#" class="hm-list__link ">
            <li class="hm-list__item administracion" id="admLink"><span class="hb-icon administrator"></span>Administración</li>
        </a>
        <ul class="sub-ul" id="subUlAdm">
            <a href="{{url ('usuarios')}}" class="sub-ul__link"> <li class="sub-ul__item sub-li-administracion">Usuarios</li></a>
            <a href="#" class="sub-li__link"><li class="sub-ul__item sub-li-administracion">Formas de Pago y Tipos de Cambio</li></a>
        </ul>  

    </ul>
</nav>