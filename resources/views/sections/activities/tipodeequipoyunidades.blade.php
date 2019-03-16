@extends('layouts.app')
@section('title')
   Tipo de Equipo y Unidades
@endsection
@section('css')

     <link href="{{ asset('css/hamburger-menu.css') }}" rel="stylesheet">
     <link href="{{ asset('css/tipoequipounidad.css') }}" rel="stylesheet">
@endsection

{{-- Contenido --}}

@section('content')
{{-- comienza el contenido --}}
<div class="container-fluid grid-contanier">
    @include('components.hamburger-menu')
    @include('contents.tipoequipoyunidades')        
</div>


@include('modals.tipoequipounidad')
@include('modals.edittipoequipounidad')
{{-- finaliza el contenido --}}
@endsection

@section('scripts')
<script src="{{ asset('js/tipounidad.js') }}" defer></script>
<script src="{{ asset('js/hamburgerMenu.js') }}" defer></script>

@endsection
