<div class="content" id="vista_tipo_actividad" >
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-dark font-weight-bold">Tipo De Actividades</div>
                        <div class="card-body">
                            <div class="row justify-content-end my-2">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tipo_actividad_modal"><span class="font-weight-bolder">+</span> Tipo Actividad</button>


                            </div>
                              {{-- alerts --}}

                                <div class="row">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="table-head" >Clave</th>
                                                <th class="table-head" >Nombre</th>
                                                <th class="table-head" >Color</th>

                                            </tr>
                                        </thead>
                                            <tbody>
                                                @foreach ($tipoactividades as $tipoactividad)
                                                @if($tipoactividad->detele_at ==null)
                                                    <tr id="trBg" class="" data-id="{{$tipoactividad->id}}"data-clave="{{$tipoactividad->clave}}" >
                                                        <td class=" table-head table-head__name" data-active="{{$tipoactividad->active}}">{{$tipoactividad->clave}}

                                                        </td>
                                                        <td class="table-head table-head__surname" data-active="{{$tipoactividad->active}}">{{$tipoactividad->nombre}}
                                                        </td>
                                                        <td class="table-head table-head__surname text-capitalize" data-active="{{$tipoactividad->active}}" style="">
                                                            <span style="display:block; width:5rem; height: 1.5rem; background-color: {{$tipoactividad->color}};" ></span>
                                                        </td>
                                                        <td class="table-head table-head__actions">
                                                            
                                                            <a href="#!" class="table-head table-head__btn btn-edit btn btn-primary" data-id="{{$tipoactividad->id}}" data-toggle="modal" data-target="#tipo_actividad_modal">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
{!! Form::open(['route' => ['tipoactividades.destroy', ':TIPO_ID'],'method'=>'DELETE','id'=>'form-delete'])!!}
{!!Form::close() !!}
