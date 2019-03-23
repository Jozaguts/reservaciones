<div class="content" id="listContent">
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-dark font-weight-bold">Tipo De Actividades</div>
                        <div class="card-body">
                            <div class="row justify-content-end my-2">
                                <a href="#" class="btn btn-success" id="btnAddTipoActividad"><span class="font-weight-bolder">+</span> Tipo Actividad</a>
                            </div>
                              {{-- alerts --}}
                              @include('components.ajax-alerts')
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
                                                        <td class="table-head table-head__surname text-capitalize" data-active="{{$tipoactividad->active}}">{{$tipoactividad->color}}
                                                        </td>
                                                        <td class="table-head table-head__actions"> 
                                                            <a href="#!" class="table-head table-head__btn btn-edit btn btn-primary" onclick="showEditModal({{$tipoactividad->id}});" data-id="{{$tipoactividad->id}}">
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