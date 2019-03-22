@extends('layouts.app')
@section('title')
   Tipo de Actividades
@endsection
@section('css')

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


@include('modals.activities.addtipoactividades')
@include('modals.activities.edittipoactividades')
{{-- finaliza el contenido --}}
@endsection

@section('scripts')
<script src="{{ asset('js/tipoactividades.js') }}" defer></script>
<script src="{{ asset('js/hamburgerMenu.js') }}" defer></script>

@endsection