@extends('layouts.app')

@section('content')



@auth
<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle text-success bg-dark btn-logout" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
@endsection
