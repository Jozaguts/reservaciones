@extends('layouts.app')
@section('title')
    Reservaciones
@endsection
@section('css')
     {{-- <link href="{{ asset('css/login-resposive.css') }}" rel="stylesheet"> --}}
     <link href="{{ asset('css/hamburger-menu.css') }}" rel="stylesheet">
@endsection

{{-- Contenido --}}

@section('content')
@include('components.hamburger-menu')   
@endsection

@section('scripts')
<script src="{{ asset('js/reservations.js') }}" defer></script>

@endsection

