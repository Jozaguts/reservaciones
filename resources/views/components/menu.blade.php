<main>
    <div class="grid-container">
        <div class="grid-item"> 
        <a class="nav-link text-dark font-weight-bold custom-link" href="{{url('reservaciones')}}">Reservaciones</a>
        </div>
        <div class="grid-item" >
            <a class="nav-link text-dark font-weight-bold custom-link" href="#" id="btnAct">Actividades
                    <ul class="ul-content" id="ulAct">
                            <a href="{{url ('tipoactividades')}}" class="ul-link"><li class="list__item li-actividadaes">Tipo de Actividades</li></a>
                            <a href="{{url ('actividades')}}" class="ul-link"><li class="list__item li-actividadaes">Actividades</li></a>
                            <a href="{{url ('tipounidades')}}" class="ul-link"> <li class="list__item li-actividadaes">Tipo de Equipos y Unidades</li></a>
                            <a href="{{url ('unidades')}}" class="ul-link"><li class="list__item li-actividadaes">Equipos y Unidades</li></a>
                            <a href="{{url ('combos')}}" class="sub-li__link"> <li class="list__item li-actividadaes">Combos</li></a>
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
</main>