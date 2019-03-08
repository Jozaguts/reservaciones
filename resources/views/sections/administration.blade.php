@extends('layouts.app')
@section('title')
    Adminstración de Usuarios
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('css/login-resposive.css')}}">
<link rel="stylesheet" href="{{asset('css/users.css')}}">
@endsection
@section('content')
{{--@include('components.menu')  --}}
<div class="container mt-3">
     
      <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-dark font-weight-bold">Lista de Usuarios</div>
                <div class="card-body">
                    <div class="row justify-content-end my-2">
                        <a href="" class="btn btn-success" id="addUser"><span class="font-weight-bolder">+</span> Usuario</a>
                    </div>
                    @if ($errors->any())
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6 offset-md-2">
                                <div class="alert alert-danger float-right">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    @endif
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="table-head" >Nombre</th>
                                        <th class="table-head" >Apellidos</th>
                                        <th class="table-head" >Rol</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($users as $user)
                              
                                          @if($user->detele_at ==null)
                               
                        <tr id="trBg" class="" data-id="{{$user->id}}"data-name="{{$user->first_name}}" >
                            
                            <td class=" table-head table-head__name"  data-active="{{$user->active}}">{{$user->first_name}}  </td>
                            <td class="table-head table-head__surname" data-active="{{$user->active}}">{{$user->last_name}}</td>
                            <td  class="table-head table-head__surname text-capitalize" data-active="{{$user->active}}" >{{$user->roles->implode('name','')}}</td>
                            <td class="table-head table-head__actions"> 
                            <a href="#!" class="table-head table-head__btn btn-edit btn btn-primary" onclick="showEditModal({{$user->id}});" data-id="{{$user->id}}"></a>
                                @if ($user->id != (Auth::user()->id))
                                <a href="#!" class="table-head table-head__btn btn btn-delete btn-danger"></a>
                                @endif
                                
                            </td>
                            @endif
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
    @include('components.user-edit')
</div>
{!! Form::open(['route' => ['usuarios.destroy', ':USER_ID'],'method'=>'DELETE','id'=>'form-delete'])!!}
{!!Form::close() !!}
@section('scripts')
<script src="{{ asset('js/app.js') }}" ></script>
<script src="{{asset('js/admin.js')}}"></script>




@endsection

@endsection

        