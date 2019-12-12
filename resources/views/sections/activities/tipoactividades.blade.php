@extends('layouts.app')
@section('title')
   Tipo de Actividades
@endsection
@section('css')

     <link href="{{ asset('css/hamburger-menu.css') }}" rel="stylesheet">
     <link href="{{ asset('css/tipoactividades.css') }}" rel="stylesheet">
@endsection


@section('content')
{{-- comienza el contenido --}}
<div class="container-fluid grid-contanier">
    @include('components.hamburger-menu')
    <div id="tipo-actividad-container">
        <view-tipo-actividad></view-tipo-actividad>
        <form-tipo-actividad > </form-tipo-actividad>
    </div>
    {{-- @include('contents.activities.tipoactividades') --}}
</div>

{{-- @include('modals.activities.edittipoactividades') --}}
{{-- @include('modals.activities.addtipoactividades') --}}
{{-- finaliza el contenido --}}
@endsection

@section('scripts')

<script src="{{ asset('js/tipoactividades.js') }}" defer></script>
<script src="{{ asset('js/hamburgerMenu.js') }}" defer></script>
@endsection

