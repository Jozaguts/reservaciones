@extends('layouts.app')
@section('title')
   Equipos y Unidades
@endsection
@section('css')
     <link href="{{ asset('css/hamburger-menu.css') }}" rel="stylesheet">
     {{-- <link href="{{ asset('css/tipoequipounidad.css') }}" rel="stylesheet"> --}}
     <link href="{{ asset('css/equiposyunidades.css') }}" rel="stylesheet">
    
@endsection
@section('content')
{{-- Contenido --}}
<div class="container-fluid grid-contanier">
@include('components.hamburger-menu')
@include('contents.activities.equiposyunidades')      



@include('modals.activities.addequipounidad')
@include('modals.activities.editequipounidad')
</div>
{{-- fin del contenido --}} 
@endsection
@section('scripts')
<script src="{{ asset('js/hamburgerMenu.js') }}" defer></script>
<script src="{{ asset('js/equiposyunidades.js') }}" defer></script>
@endsection
