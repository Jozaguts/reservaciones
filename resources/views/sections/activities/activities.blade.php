@extends('layouts.app')
@section('title')
   Actividades
@endsection
@section('css')

     <link href="{{ asset('css/hamburger-menu.css') }}" rel="stylesheet">
     <link href="{{ asset('css/activities.css') }}" rel="stylesheet">
     
@endsection

{{-- Contenido --}}

@section('content')
{{-- comienza el contenido --}}
<div class="container-fluid grid-contanier">
    @include('components.hamburger-menu')
    @include('contents.activities.activities')        
</div>


@include('modals.activities.addactivities')
@include('modals.activities.editactivities')
{{-- finaliza el contenido --}}
@endsection

@section('scripts')


{{-- <script src="{{ asset('js/activities.js') }}" defer></script> --}}
<script src="{{ asset('js/test.js') }}" defer></script>

<script src="{{ asset('js/hamburgerMenu.js') }}" defer></script>






@endsection