@extends('layouts.app')
@section('title')
   Tipo de Actividades
@endsection
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/css/bootstrap-colorpicker.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/js/bootstrap-colorpicker.min.js"></script>  

     <link href="{{ asset('css/hamburger-menu.css') }}" rel="stylesheet">
     <link href="{{ asset('css/tipoactividades.css') }}" rel="stylesheet">
@endsection

{{-- Contenido --}}

@section('content')
{{-- comienza el contenido --}}
<div class="container-fluid grid-contanier">
    @include('components.hamburger-menu')
    @include('contents.activities.tipoactividades')        
</div>

@include('modals.activities.edittipoactividades')
@include('modals.activities.addtipoactividades')

{{-- finaliza el contenido --}}
@endsection

@section('scripts')

<script src="{{ asset('js/tipoactividades.js') }}" defer></script>
<script src="{{ asset('js/hamburgerMenu.js') }}" defer></script>
@endsection

