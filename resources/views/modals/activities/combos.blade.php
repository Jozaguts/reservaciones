 <!-- The Modal -->
 <div class="modal fade" id="combos" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
                  <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Combos</h4>
          <button type="button" class="close" onclick="checkEmpty();">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general"   role="tab" aria-controls="home" aria-selected="true">General</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="PreciosYPases-tab" data-toggle="tab" href="#PreciosYPases"    role="tab" aria-controls="PreciosYPases" aria-selected="false">Precios y Pases</a>
                </li>
                <span id='alerta'class=""> </span>
                <div class="loading d-none" id="loading">
                  <div class="dot d1"></div>
                  <div class="dot d2"></div>
                  <div class="dot d3"></div>
                </div>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show " id="general" role="tabpanel" aria-labelledby="home-tab">

                    {{-- <div class="container mt-3">

                    </div> --}}
                <form action="#!" method="post" id="combosForm">
                    @csrf
                  <div class="row">
                    <div class="col-sm-6 offset-md-2">
                        @include('components.alertsintomodals')
                    </div>
                </div>
                  <input type="hidden" name="idusuario" id="idUsuario"  value="{{Auth::user()->id}}">

                        <div class="container mt-2">
                               <div class="row">
                                <div class="col-3">
                                  <div class="form-group">
                                    <label for="">Clave</label>
                                    <input type="text" name="clave" id="clave" class="form-control general input-clave" placeholder="" aria-describedby="helpId" maxlength="5" required style="text-transform:uppercase" autofocus>
                                  </div>
                                </div>
                                <div class="col-4 offset-1">
                                 <div class="form-group">
                                   <label for="" >Nombre</label>
                                   <input type="text" name="nombre" id="nombre" class="form-control general input-nombre" placeholder="" aria-describedby="helpId" required maxlength="40" >
                                 </div>
                             </div>
                             <div class="col-4 ">
                             <div class="form-group float-right">
                               <label for="">Tipo de Actividad</label>
                               <select class="form-control " name="tipoactividades_id" id="tipoactividades_id" required>
                                 @foreach ($tipoactividades as $tipoactividad)
                               <option value="{{$tipoactividad->id}}" data-tipoUnidad="{{  $tipoactividad->TipoUnidad->id}}">{{$tipoactividad->nombre}}</option>
                               @endforeach
                               </select>

                             </div>
                           </div>
                            </div>
                            <div class="row">
                                 <div class="col-3">
                                    <div class="form-group">
                                        <label for="">Max Cortesias</label>
                                        <input type="number" class="form-control general input-cortesias" name="maxcortesias" id="maxCortesias" aria-describedby="helpId" placeholder="">
                                    </div>
                                </div>
                                <div class="col-4 offset-1">
                                    <div class="form-group  ">
                                        <label for="">Max Cupones</label>
                                        <input type="number" class="form-control general input-cupones" name="maxcupones" id="maxCupones" aria-describedby="helpId" placeholder="">
                                    </div>
                                </div>
                                <div class="col-4 ">
                                    <div class="form-group float-right">
                                        <label for=""> Anticipo</label>
                                        <select class="form-control input-anticipo" name="anticipo_id" id="anticipoId" required>
                                            @foreach ($anticipos as $anticipo)
                                                <option value="{{$anticipo->id}}">{{$anticipo->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for=""> Agregar Actividad</label>
                                        <select class="form-control input-agregar-actividad"  id="actividad" required>
                                            @foreach ($actividades as $actividad)
                                            @if($actividad->combo ==0){
                                              <option value="{{$actividad->id}}">{{$actividad->clave}} | {{$actividad->nombre}}</option>
                                            }
                                            @endif

                                            @endforeach
                                        </select>
                                        <a href="#!" class="btn btn-success ml-3 btn-agregar" >+</a>
                                    </div>
                                </div>
                                <div class="col-3 offset-1">
                                    <div class="form-group">
                                    <label for=""> Aplicar Mismo Día </label>
                                    <input type="checkbox" class="form-control d-inline-block checkbox" name="mismo_dia" id="mismo_dia"  checked>
                                  </div>
                                </div>
                                <div class="col-2 ">
                                  <div class="form-group">
                                  <button class="btn btn-success btn-guardar" disabled>Guardar</button>
                                </div>
                              </div>

                            </div>
                            <div class="row table-container">
                              <div class="col-12">
                                  <div class="form-group">
                                    <table class="table">
                                      <thead>
                                        <tr>
                                          <th>Clave</th>
                                          <th class="th-nombre">Nombre</th>
                                          <th class="th-precio">Precio</th>
                                          <th class="th-balance">Balance</th>
                                          <th>Horario <span class="ml-5">Fín</span> <span class="ml-5">Días</span></th>

                                        </tr>
                                      </thead>
                                      <tbody id="bodyTable">


                                      </tbody>
                                    </table>
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                             <div class="col-4 lead text-center">HORA INICIO:  (Horario menor)</div>
                             <div class="col-4 lead text-center"> HORA FIN: (Horario Mayor)</div>
                             <div class="col-4 lead text-center">PRECIO SUGERIDO</div>
                            </div>
                            <div class="row mt-3">
                              <div class="col-12 lead text-center">(No pueden ser agregadas actividades de Renta)</div>

                             </div>

                            </div>
                     </form>
                </div>
                <div class="tab-pane fade" id="PreciosYPases" role="tabpanel" aria-labelledby="PreciosYPases-tab">
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-sm-6 offset-md-2">
                                @include('components.alertsintomodals')
                            </div>
                        </div>
                    </div>
                    <form action="#!" method="post" id="AddPreciosYPasesForm">
                        {{ csrf_field() }}
                     {{-- <meta name="csrf-token" content="{{ csrf_token() }}" id="_token"> --}}
                      <div class="container">
                        <div class="row ">
                          <div class="col-3 offset-2">
                            <div class="form-group flex-column">
                              <label for="" >Balance general (MXN)</label>
                              <input type="text" name="balance" id="balanceG" class="form-control" placeholder="" aria-describedby="helpId" required  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
                            </div>
                          </div>
                          <div class="col-3 offset-2 mb-2">
                              <div class="form-group flex-column">
                                <label for="">Precio General (MXN)</label>
                                <input type="text" name="precio" id="precioG" class="form-control" placeholder="" aria-describedby="helpId" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                              </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-6"><label for="" class="float-right">En Ocupación</label></div>
                          <div class="col-4"><label for=""  class="float-right">Acepta</label></div>
                        </div>
                        <div class="row mb-0"style="background-color: #FFFDCC">
                            <div class="col-1 padding-col" style="background-color: white">
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Nombre</label>
                                </div>
                              </div>
                              <div class="col-1 padding-col "style="background-color: #CCFFFD">
                                  <div class="form-group">
                                      <label for="" class="font-weight-bold">Precio 1</label>
                                  </div>
                                </div>
                                <div class="col-1 padding-col "style="background-color: #CCFFFD">
                                    <div class="form-group">
                                        <label for="" class="font-weight-bold">Precio 2</label>
                                    </div>
                                  </div>
                                  <div class="col-1 padding-col "style="background-color: #CCFFFD">
                                      <div class="form-group">
                                          <label for="" class="font-weight-bold">Precio 3</label>
                                      </div>
                                    </div>
                                    <div class="col-1 padding-col  pl-4"style="background-color: #CCFFCC">
                                        <div class="form-group">
                                            <label for="" class="font-weight-bold">Doble</label>
                                        </div>
                                      </div>
                                      <div class="col-1 padding-col  "style="background-color: #CCFFCC">
                                          <div class="form-group">
                                              <label for="" class="font-weight-bold">Balance</label>
                                          </div>
                                        </div>
                                        <div class="col-1 padding-col  "style="background-color: #CCFFCC">
                                            <div class="form-group">
                                                <label for="" class="font-weight-bold">Triple</label>
                                            </div>
                                          </div>
                                          <div class="col-1 padding-col " style="background-color: #CCFFCC">
                                              <div class="form-group">
                                                  <label for="" class="font-weight-bold">Balance</label>
                                              </div>
                                            </div>
                                            <div class="col-1 padding-col ml-3" style="background-color: #FFFDCC">
                                                <div class="form-group">
                                                    <label for="" class="font-weight-bold">Promo</label>
                                                </div>
                                              </div>
                                              <div class="col-1 padding-col " style="background-color: #FFFDCC" >
                                                  <div class="form-group">
                                                      <label for="" class="font-weight-bold">Restricción</label>
                                                  </div>
                                                </div>
                                              <div class="col-1 padding-col "style="background-color: #FFFDCC" >
                                                <div class="form-group">
                                                  <label for="" class="font-weight-bold">Acompañante</label>
                                                </div>
                                              </div>
                          </div>
                        </form>
@foreach ($personas as $persona)
<form id="formPerson{{$persona->id}}">
    @csrf
    <div class="row mb-0" style="background-color: #FFFDCC" id="preciosContainer">
    <div class="col-1 padding-col"style="background-color:white" >

    <input type="hidden" name="persona_id" id="persona_id" value= "{{$persona->id}}">


      <div class="form-group ">
        <label for="" class=" font-weight-bold" data-id="{{$persona->id}}" value="persona{{$persona->id}}" id="persona{{$persona->id}}" >{{$persona->nombre}}</label>
      </div>
    </div>
    <div class="col-1 padding-col" style="background-color: #CCFFFD">
      <div class="form-group">
        <input type="text" name="precio1" id="  {{$persona->id}}" class="form-control input-precios" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
      </div>
    </div>
    <div class="col-1 padding-col" style="background-color: #CCFFFD">
      <div class="form-group">
        <input type="text" name="precio2" id="p2PersonaId{{$persona->id}}" class="form-control input-precios" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
      </div>
    </div>
    <div class="col-1 padding-col" style="background-color: #CCFFFD">
      <div class="form-group">
        <input type="text" name="precio3" id="p3PersonaId{{$persona->id}}" class="form-control input-precios" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
      </div>
    </div>
    <div class="col-1 padding-col pl-4" style="background-color: #CCFFCC">
      <div class="form-group">
        <input type="text" name="doble" id="doblePersonaId{{$persona->id}}" class="form-control input-precios" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
      </div>
    </div>
    <div class="col-1 padding-col" style="background-color: #CCFFCC">
      <div class="form-group">
        <input type="text" name="doblebalanc" id="balanceDoblePersonaId{{$persona->id}}" class="form-control" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
      </div>
    </div>
    <div class="col-1 padding-col "style="background-color: #CCFFCC" >
      <div class="form-group">
        <input type="text" name="triple" id="triplePersonaId{{$persona->id}}" class="form-control input-precios" placeholder="" aria-describedby="helpId"oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
      </div>
    </div>
    <div class="col-1 padding-col  "style="background-color: #CCFFCC">
      <div class="form-group">
        <input type="text" name="triplebalanc" id="balanceTriplePersonaId{{$persona->id}}" class="form-control input-precios" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
      </div>
    </div>
    <div class="col-1 padding-col ml-4 " style="background-color: #FFFDCC">
      <div class="form-group">
        <input type="checkbox" value="" class="form-control pases-precios-check ml-3 check-clean input-precios" name="promocion" id="promoPersonaId{{$persona->id}}"  >
      </div>
    </div>
    <div class="col-1 padding-col " style="background-color: #FFFDCC">
      <div class="form-group">
        <input type="checkbox" value="" class="form-control ml-3 pases-precios-check check-clean input-precios" name="restriccion" id="restriccionPersonaId{{$persona->id}}"  onchange="habilitarAcompnante(this);" data-id="{{$persona->id}}">
      </div>
    </div>
    <div class="col-1 padding-col " style="background-color: #FFFDCC">
      <div class="form-group">
        <input type="checkbox"  value="" class="form-control ml-3 pases-precios-check check-clean input-precios" name="acompanante" id="acompanantePersonaId{{$persona->id}}" disabled>
    </div>
</form>

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






