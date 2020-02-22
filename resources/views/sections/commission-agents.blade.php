@extends('layouts.app')
@section('title')
    Tipo de comisionistas
@endsection
@section('css')
{{-- <link rel="stylesheet" href="{{asset('css/login-resposive.css')}}"> --}}
<link rel="stylesheet" href="{{asset('css/users.css')}}">
<link rel="stylesheet" href="{{asset('css/hamburger-menu.css')}}">
@endsection
@section('content')
{{-- <div class="container mt-3"> --}}
    <div class="container-fluid grid-contanier">
        @include('components.hamburger-menu')

        <div class="row justify-content-center" id="comisionistas">
            <comisionistas-component></comisionistas-component>
        </div>
</div>

@section('scripts')
<script src="{{asset('js/hamburgerMenu.js')}}"></script>
<script src="{{asset('js/comisionistas.js')}}"></script>
@endsection
@endsection

