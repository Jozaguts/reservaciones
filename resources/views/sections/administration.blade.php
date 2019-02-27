@extends('layouts.app')
@section('title')
    Adminstración de Usuarios
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('css/login-resposive.css')}}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lista de Usuarios</div>
                <div class="card-body">
                    <div class="row justify-content-end">
                        <a href="" class="btn btn-success" id="addUser">Agregar Usuario</a>
                    </div>
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th >Id</th>
                                        <th >Nombre</th>
                                        <th >Apellido</th>
                                        <th >Acciones</th>
                                   
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($users as $user)
                                    <tr>
                                       
                                        <th>{{$user->id}}</th>
                                        <td>{{$user->first_name}} </td>
                                        <td>{{$user->last_name}}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary">Editar</a>
                                            <a href="#" class="btn btn-danger">Eliminar</a>
                                        </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.register-form')
</div>

@section('scripts')
<script src="{{asset('js/admin.js')}}"></script>
@endsection

@endsection

        