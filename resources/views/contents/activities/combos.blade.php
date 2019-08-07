

   <div class="content" id="listContent">
    {{ csrf_field() }}
<div class="col-md-12">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-dark font-weight-bold">Combos</div>
                    <div class="card-body">
                        <div class="row justify-content-end my-2">
                            {{-- <a href="#" class=""  id="btnShowAddEU">Actividad</a> --}}
                            <button type="button" class="btn btn-success btn-crear" data-toggle="modal" data-target="#combos">
                                    <span class="font-weight-bolder btn-crear">+</span>  Combo</button>
                        </div>
                          {{-- alerts --}}
                          @include('components.ajax-alerts')
                         
                          {{-- btns container list--}}
                        <div class="container main-grid">
                                @foreach ($tipoactividades as $tipoactividad )
                                {{-- {{$tipoactividad}} --}}
                            {{-- columna y boton --}}
                           
                            <div class="colum-container">
                            <a href="#!" id=" btn{{($tipoactividad->nombre)}}" style="background-color:{{$tipoactividad->color}} " class="btn btn-info mx-3 my-3 btn-actividades font-weight-bolder show-btn" > {{($tipoactividad->nombre)}} / {{($tipoactividad->clave)}} / {{($tipoactividad->TipoUnidad->nombre)}} </a>
                       
                               
                            <div class="row d-none">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="table-head" >Clave</th>
                                            <th class="table-head" >Nombre</th>
                                            <th class="table-head title-" >Precio General</th>
                                            <th class="table-head title-" >Balance</th>
                                        </tr>
                                       
                                    </thead>
                                        <tbody>

                                      
                                            @foreach ($actividades as $actividad)
                                          
                                            @if( $actividad->tipoactividades_id == $tipoactividad->id && $actividad->combo ==1 )
                                     
                                            
                                        <tr id="trBg" class="mot"data-id="{{$actividad->id}}" data-clave="{{$actividad->clave}}"    data-active="{{$actividad->active}}"  >
                                        <td class=" table-head table-head__name" >  {{$actividad->clave}} 
                                            </td>
                                            <td class="table-head table-head__surname"> <p class="flex-content">  {{$actividad->nombre}}</p>
                                            </td>
                                            <td class="table-head  text-capitalize precioFix"> {{$actividad->precio}}                                             </td>
                                            <td class="table-head  text-capitalize balanceFix"> {{$actividad->balance}}                                                 </td>
                                            <td class="table-head table-head__actions"> 
                                            <button type="button" class="table-head table-head__btn btn-edit  btn btn-primary btn-editar"  data-toggle="modal" data-target="#addActivities" onclick="editarActividad(this);" data-isEdit="true" data-id="{{$actividad->id}}" id="editActividad">
                                           
                                            </button>
                                            <input type="hidden" name="idactividad"    value="{{$actividad->id}}" id="idActividad">
                                             <a href="#!" class="table-head table-head__btn btn btn-disabled btn-secondary" onclick="desactivarActividad(this)"  data-id="{{$actividad->id}}"  data-desactivar="{{$actividad->active}}"   data-btn-status="{{$actividad->active}}"  ></a>

                                                <a href="#!" class="table-head table-head__btn btn btn-delete btn-danger" onclick="eliminarActividad(this)" data-id="{{$actividad->id}}" data-eliminar="true"></a>
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
