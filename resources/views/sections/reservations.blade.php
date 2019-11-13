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
<div class="container-fluid grid-contanier">
@include('components.hamburger-menu')
@include('contents.reservation.home')
@endsection

@section('scripts')
<script src="{{ asset('js/reservations.js') }} "></script>
<script src="{{asset('js/hamburgerMenu.js')}}" ></script>
@endsection

