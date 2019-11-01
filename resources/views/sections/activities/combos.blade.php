@extends('layouts.app')
@section('title')
   Actividades
@endsection
@section('css')

     <link href="{{ asset('css/hamburger-menu.css') }}" rel="stylesheet">
     <link href="{{ asset('css/activities.css') }}" rel="stylesheet">
     <link href="{{ asset('css/combos.css') }}" rel="stylesheet">
     
@endsection

{{-- Contenido --}}

@section('content')
{{-- contenedor GRID 20vw 80vw --}}
<div class="container-fluid grid-contanier">
    {{-- menu desplegable --}}
    @include('components.hamburger-menu')
    {{-- contenido principal --}}
    @include('contents.activities.combos')        
</div>


{{-- @include('modals.activities.addactivities') --}}
@include('modals.activities.combos') 
{{-- finaliza el contenido --}}
@endsection

@section('scripts')
{{-- <script src="{{ asset('js/activities.js') }}" defer></script> --}}
<script src="{{ asset('js/combos.js') }}" ></script>

<script src="{{ asset('js/hamburgerMenu.js') }}" ></script>






@endsection