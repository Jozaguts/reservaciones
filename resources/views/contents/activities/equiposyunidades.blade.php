<div class="content" id="listContent">
        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-dark font-weight-bold">Equipos y Unidades</div>
                            <div class="card-body">
                                <div class="row justify-content-end my-2">
                                    <a href="#" class="btn btn-success" id="btnShowAddEU"><span class="font-weight-bolder">+</span> Equipo/Unidad</a>
                                </div>
                                  {{-- alerts --}}
                                  @include('components.ajax-alerts')

                                  {{-- btns container list--}}
                                <div class="container main-grid">


                                    {{-- columna y boton --}}
                                    <div class="colum-container">
                                        <a href="#!"id="btnMoto" class=" btn btn-info mx-3 my-3" >Motos</a>
                                    <div class="row d-none" id="motoContent">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="table-head" >Clave</th>
                                                    <th class="table-head" >Descripción</th>
                                                    <th class="table-head" >Capacidad</th>
                                                    <th class="table-head" >Color</th>
                                                </tr>
                                               
                                            </thead>
                                                <tbody>
                                                   
                                                    {{-- <a href="#!"id="btnBus" class=" btn btn-info mx-3" >Autobus</a> --}}
                                              
                                                    @foreach ($unidades as $unidad)
                                                    @if($unidad->detele_at ==null)
                                                    @if ($unidad->clave == 'mot')
                                                        <tr id="trBg" class="mot" data-id="{{$unidad->id}}"data-clave="{{$unidad->clave}}" >
                                                            <td class=" table-head table-head__name" data-active="{{$unidad->active}}">{{$unidad->clave}} 
                                                            </td>
                                                            <td class="table-head table-head__surname" data-active="{{$unidad->active}}">{{$unidad->descripcion}}
                                                            </td>
                                                            <td class="table-head table-head__surname text-capitalize" data-active="{{$unidad->active}}">{{$unidad->capacidad}}
                                                            </td>
                                                            <td class="table-head table-head__surname text-capitalize" data-active="{{$unidad->active}}">{{$unidad->color}}
                                                                </td>
                                                            <td class="table-head table-head__actions"> 
                                                                <a href="#!" class="table-head table-head__btn btn-edit btn btn-primary" onclick="showEditModal({{$unidad->id}});" data-id="{{$unidad->id}}">
                                                                </a>
                                                                <a href="#!" class="table-head table-head__btn btn btn-delete btn-danger"></a>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                        </table>
                                    </div>
                                    </div>
                                    {{-- finaliza primera columna y boton --}}
                                    {{-- segunda coluna y boton --}}
                                    <div class="colum-container">
                                    <a href="#!"id="btnBus" class=" btn btn-info mx-3 my-3" >Autobus</a>
                                    <div class="row d-none" id="busContent">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="table-head" >Clave</th>
                                                        <th class="table-head" >Descripción</th>
                                                        <th class="table-head" >Capacidad</th>
                                                        <th class="table-head" >Color</th>
                                                    </tr>
                                                </thead>
                                                    <tbody>      
                                                        @foreach ($unidades as $unidad)
                                                        @if($unidad->detele_at ==null)
                                                        @if ($unidad->clave == 'aut')
                                                            <tr id="trBg" class="mot" data-id="{{$unidad->id}}"data-clave="{{$unidad->clave}}" >
                                                                <td class=" table-head table-head__name" data-active="{{$unidad->active}}">{{$unidad->clave}} 
                                                                </td>
                                                                <td class="table-head table-head__surname" data-active="{{$unidad->active}}">{{$unidad->descripcion}}
                                                                </td>
                                                                <td class="table-head table-head__surname text-capitalize" data-active="{{$unidad->active}}">{{$unidad->capacidad}}
                                                                </td>
                                                                <td class="table-head table-head__surname text-capitalize" data-active="{{$unidad->active}}">{{$unidad->color}}
                                                                    </td>
                                                                <td class="table-head table-head__actions"> 
                                                                    <a href="#!" class="table-head table-head__btn btn-edit btn btn-primary" onclick="showEditModal({{$unidad->id}});" data-id="{{$unidad->id}}">
                                                                    </a>
                                                                    <a href="#!" class="table-head table-head__btn btn btn-delete btn-danger"></a>
                                                                </td>
                                                            </tr>
                                                            @endif
                                                        @endif
                                                        @endforeach
                                                    </tbody>
                                            </table>
                                        </div> {{-- finaliza la columna  --}}
                                    </div>
                                </div>
                                    
                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
{!! Form::open(['route' => ['tipounidades.destroy', ':TIPO_ID'],'method'=>'DELETE','id'=>'form-delete'])!!}
{!!Form::close() !!}