@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('css/login-resposive.css')}}">
@endsection
    @section('content')
        @if(Session::has('flash_message'))
            {{Session::get('flash_message')}}
        @endif
        @include('components.menu')


@endsection
@section('scripts')
<script src="{{asset('js/all.js')}}"></script>
@endsection





