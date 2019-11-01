<div class="content" id="listContent">
        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-dark font-weight-bold">Tipo Equipos y Unidades</div>
                            <div class="card-body">
                                <div class="row justify-content-end my-2">
                                    <a href="#" class="btn btn-success" id="btnAddTipoEU"><span class="font-weight-bolder">+</span> Equipo/Unidad</a>
                                </div>
                                  {{-- alerts --}}
                                  @include('components.ajax-alerts')
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
                                                            <td class=" table-head table-head__name" data-active="{{$tipounidad->active}}">{{$tipounidad->id}} 
                                                            </td>
                                                            <td class="table-head table-head__surname" data-active="{{$tipounidad->active}}">{{$tipounidad->nombre}}
                                                            </td>
                                                            <td class="table-head table-head__surname text-capitalize" data-active="{{$tipounidad->active}}">{{$tipounidad->medio}}
                                                            </td>
                                                            <td class="table-head table-head__actions"> 
                                                                <a href="#!" class="table-head table-head__btn btn-edit btn btn-primary" onclick="showEditModal({{$tipounidad->id}});" data-id="{{$tipounidad->id}}">
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
{!! Form::open(['route' => ['tipounidades.destroy', ':TIPO_ID'],'method'=>'DELETE','id'=>'form-delete'])!!}
{!!Form::close() !!}