<main>
    <div class="grid-container">
        <div class="grid-item">
            <a class="nav-link text-dark font-weight-bold custom-link" href="{{url('reservaciones')}}">Reservaciones</a>
        </div>
        <div class="grid-item dropdown">
            <a class="nav-link text-dark font-weight-bold custom-link dropdown-toggle" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Actividades 
            </a>
            <ul id="ulAct" class="dropdown-menu " aria-labelledby="dropdownMenuButton">

                <a href="{{url ('actividades')}}" class=" dropdown-item" >
                    <li class="list__item li-actividadaes">Actividades</li>
                </a>
                <a href="{{url ('asignaciones')}}" class=" dropdown-item">
                    <li class="list__item li-actividadaes">Asignaciones</li>
                </a>
                <a href="{{url ('tipoactividades')}}" class=" dropdown-item">
                    <li class="list__item li-actividadaes">Tipo de Actividades</li>
                </a>
                <a href="{{url ('tipounidades')}}" class=" dropdown-item">
                    <li class="list__item li-actividadaes">Tipo de Equipos y Unidades</li>
                </a>
                <a href="{{url ('unidades')}}" class=" dropdown-item">
                    <li class="list__item li-actividadaes">Equipos y Unidades</li>
                </a>
                <a href="{{url ('combos')}}" class="dropdown-item">
                    <li class="list__item li-actividadaes">Combos</li>
                </a>
            </ul>


        </div>

        <div class="grid-item dropdown">
            <a class="nav-link text-dark font-weight-bold custom-link dropdown-toggle" id="btnCom"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Comisionistas
            </a>
                <ul class="dropdown-menu" id="ulCom" aria-labelledby="btnCom">
                    <a href="#" class="dropdown-item">
                        <li class="list__item li-comisionistas ">Pago a comisionistas</li>
                    </a>
                    <a href="{{url ('comisionistas')}}" class="dropdown-item">
                        <li class="list__item li-comisionistas ">Tipo de comisionistas</li>
                    </a>
                    <a href="#" class="dropdown-item">
                        <li class="list__item li-comisionistas ">Catálogo de comisionistas</li>
                    </a>
                </ul>
            
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
                    <a href="{{url ('usuarios')}}" class="ul-link">
                        <li class="list__item li-administracion">Usuarios</li>
                    </a>
                    <li class="list__item li-administracion">Formas de Pago y Tipos de Cambio</li>
                </ul>
            </a>
        </div>
    </div>
</main>