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
                                        @foreach ($tipounidades as $tipo )
                                    {{-- columna y boton --}}
                                    <div class="colum-container">
                                        <a href="#!"id="btn{{($tipo->nombre)}}" class="btn btn-info mx-3 my-3" onclick="showContent(this);">{{($tipo->nombre)}} </a>
                                    <div class="row d-none" id="{{($tipo->nombre)}}Content">
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
                                                    @if( $unidad->tipounidad->nombre == $tipo->nombre)
                                                   
                                                    
                                                <tr id="trBg" class="mot" data-id="{{$unidad->id}}"data-clave="{{$unidad->clave}}" >
                                                <td class=" table-head table-head__name" data-active="{{$unidad->active}}" data-tipo-unidad="{{$unidad->tipounidad->id}}">{{$unidad->clave}} 
                                                    </td>
                                                    <td class="table-head table-head__surname" data-active="{{$unidad->active}}"> <p class="flex-content">{{$unidad->descripcion}}</p>
                                                    </td>
                                                    <td class="table-head  text-capitalize" data-active="{{$unidad->active}}">{{$unidad->capacidad}}
                                                    </td>
                                                    <td class="table-head  text-capitalize" data-active="{{$unidad->active}}">{{$unidad->color}}
                                                        </td>
                                                    <td class="table-head table-head__actions"> 
                                                        <a href="#!" class="table-head table-head__btn btn-edit btn btn-primary" onclick="showEditModal({{$unidad->id}});" data-id="{{$unidad->id}}">
                                                        </a>
                                                        <a href="#!" class="table-head table-head__btn btn btn-delete btn-danger"></a>
                                                    </td>
                                                </tr>
                                                        
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                        </table>
                                    </div>
                                    </div>
                                    @endforeach
                               
                                            
                                </div>
                                    
                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
{!! Form::open(['route' => ['unidades.destroy', ':UNIDAD_ID'],'method'=>'DELETE','id'=>'form-delete'])!!}
{!!Form::close() !!}