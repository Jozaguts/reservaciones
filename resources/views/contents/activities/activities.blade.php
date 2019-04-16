

   <div class="content" id="listContent">
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-dark font-weight-bold">Activiades</div>
                        <div class="card-body">
                            <div class="row justify-content-end my-2">
                                {{-- <a href="#" class=""  id="btnShowAddEU">Actividad</a> --}}
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addActivities">
                                        <span class="font-weight-bolder">+</span>  Actividad</button>
                            </div>
                              {{-- alerts --}}
                              @include('components.ajax-alerts')
                             
                              {{-- btns container list--}}
                            <div class="container main-grid">
                                    @foreach ($tipoactividades as $tipoactividad )
                                {{-- columna y boton --}}
                               
                                <div class="colum-container">
                                <a href="#!"id="btn{{($tipoactividad->nombre)}}" style="background-color:{{$tipoactividad->color}}" class="btn btn-info mx-3 my-3" onclick="showContent(this);">{{($tipoactividad->nombre)}} / {{($tipoactividad->clave)}} / {{($tipoactividad->TipoUnidad->nombre)}}</a>
                           
                                   
                                <div class="row d-none" id="{{($tipoactividad->nombre)}}Content">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="table-head" >Clave</th>
                                                <th class="table-head" >Nombre</th>
                                                <th class="table-head" >Precio General</th>
                                                <th class="table-head" >Balance</th>
                                            </tr>
                                           
                                        </thead>
                                            <tbody>

                                          
                                                @foreach ($actividades as $actividad)
                                              
                                                @if( $actividad->tipoactividades_id == $tipoactividad->id)
                                              
                                                
                                            <tr id="trBg" class="mot" data-id="{{$actividad->id}}"data-clave="{{$actividad->clave}}" >
                                            <td class=" table-head table-head__name" data-active="{{$actividad->active}}">{{$actividad->clave}} 
                                                </td>
                                                <td class="table-head table-head__surname" data-active="{{$actividad->active}}"> <p class="flex-content">{{$actividad->nombre}}</p>
                                                </td>
                                                <td class="table-head  text-capitalize" data-active="{{$actividad->active}}">{{$actividad->precio}}
                                                </td>
                                                <td class="table-head  text-capitalize" data-active="{{$actividad->active}}">{{$actividad->balance}}
                                                    </td>
                                                <td class="table-head table-head__actions"> 
                                                    <a href="#!" class="table-head table-head__btn btn-edit btn btn-primary" onclick="showEditModal({{$actividad->id}});" data-id="{{$actividad->id}}">
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
{!! Form::open(['route' => ['actividades.destroy', ':UNIDAD_ID'],'method'=>'DELETE','id'=>'form-delete'])!!}
{!!Form::close() !!}