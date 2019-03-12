@extends('layouts.app')
@section('title')
   Equipos y Unidades
@endsection
@section('css')
     <link href="{{ asset('css/hamburger-menu.css') }}" rel="stylesheet">
@endsection
@section('content')
{{-- Contenido --}}
@include('components.hamburger-menu')  
{{-- fin del contenido --}} 
@endsection

@section('scripts')
<script src="{{ asset('js/reservations.js') }}" defer></script>

@endsection
