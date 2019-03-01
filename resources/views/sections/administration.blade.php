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
                    <div class="row justify-content-end">
                        <a href="" class="btn btn-success" id="addUser">Agregar Usuario</a>
                    </div>
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                    
                                        <th class="table-head" >Id</th>
                                        <th class="table-head" >Nombre</th>
                                        <th class="table-head" >Apellidos</th>
                                        <th  class="table-head">Acciones</th>
                                   
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($users as $user)
                                        {{-- {{dd($user)}} --}}
                                          @if($user->detele_at ==null)
                                    <tr data-id="{{$user->id}}">
                                        <th class="table-head table-head__id">{{$user->id}}</th>
                                        <td class=" table-head table-head__name">{{$user->first_name}} </td>
                                        <td class="table-head table-head__surname">{{$user->last_name}}</td>
                                        <td class="table-head table-head__actions"> 
                                            <a href="#" class="table-head table-head__btn btn-edit btn btn-primary" onclick="showEditModal(this)"></a>
                                            <a href="#!" class="table-head table-head__btn btn btn-delete btn-danger"></a>
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
<script src="{{asset('js/admin.js')}}"></script>
<script src="{{ asset('js/app.js') }}" ></script>

<script>


$(document).ready(function() {
  
    $('.btn-delete').click(function(){
      
       var row = $(this).parents('tr');
       var id = row.data('id');
       var form = $('#form-delete');
       var url = form.attr('action').replace(':USER_ID', id);
       var data = form.serialize();

       row.fadeOut();

       $.post(url,data, function(result){
            alert(result);
       });
    });
 });
</script>



{{-- <script src="{{asset('js/all.js')}}"></script> --}}
@endsection

@endsection

        