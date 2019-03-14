@extends('layouts.app')
@section('title')
   Tipo de Equipo y Unidades
@endsection
@section('css')

     <link href="{{ asset('css/hamburger-menu.css') }}" rel="stylesheet">
     <link href="{{ asset('css/tipoequipounidad.css') }}" rel="stylesheet">
@endsection

{{-- Contenido --}}

@section('content')
{{-- comienza el contenido --}}
    <div class="container-fluid grid-contanier">
        @include('components.hamburger-menu')
       <div class="content">
           <div class="col-md-12">
                <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header text-dark font-weight-bold">Tipo Equipos y Unidades</div>
                                <div class="card-body">
                                    <div class="row justify-content-end my-2">
                                        <a href="#" class="btn btn-success" id="btnAddTipoEU"><span class="font-weight-bolder">+</span> Equipo/Unidad</a>
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
                                                        <th class="table-head" >Id</th>
                                                        <th class="table-head" >Nombre</th>
                                                        <th class="table-head" >Medio</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        @foreach ($tipounidades as $tipounidad)
                                              
                                                          @if($tipounidad->detele_at ==null)
                                               
                                                    <tr id="trBg" class="" data-id="{{$tipounidad->id}}"data-name="{{$tipounidad->nombre}}" >
                                                        
                                                        <td class=" table-head table-head__name"  data-active="{{$tipounidad->active}}">{{$tipounidad->id}}  </td>
                                                        <td class="table-head table-head__surname" data-active="{{$tipounidad->active}}">{{$tipounidad->nombre}}</td>
                                                        <td class="table-head table-head__surname text-capitalize" data-active="{{$tipounidad->active}}">{{$tipounidad->medio}}</td>
                                                        <td class="table-head table-head__actions"> 
                                                        <a href="#!" class="table-head table-head__btn btn-edit btn btn-primary" onclick="showEditModal({{$tipounidad->id}});" data-id="{{$tipounidad->id}}"></a>
                                                            @if ($tipounidad->id != (Auth::user()->id))
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
       </div>
        
    </div>

@include('modals.tipoequipounidad')
{{-- finaliza el contenido --}}
@endsection

@section('scripts')
<script src="{{ asset('js/tipounidad.js') }}" defer></script>
<script src="{{ asset('js/hamburgerMenu.js') }}" defer></script>

@endsection
