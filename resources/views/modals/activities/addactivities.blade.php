 <!-- The Modal -->
 <div class="modal fade" id="addActivities" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
                      <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Actividades</h4>
              <button type="button" class="close" onclick="checkEmpty()">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" onclick="showPanel(this);" role="tab" aria-controls="home" aria-selected="true">General</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="PreciosYPases-tab" data-toggle="tab" href="#PreciosYPases"  onclick="showPanel(this);" role="tab" aria-controls="PreciosYPases" aria-selected="false">Precios y Pases</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact"  onclick="showPanel(this);" role="tab" aria-controls="contact" aria-selected="false">Horarios y Puntos de Salida y Llegadas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="generales-tab" data-toggle="tab" href="#generales"  onclick="showPanel(this);" role="tab" aria-controls="generales" aria-selected="false">Observaciones Especiales </a>
                      </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show " id="general" role="tabpanel" aria-labelledby="home-tab">

                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-sm-6 offset-md-2">
                                    @include('components.alertsintomodals')                                    
                                </div>
                            </div>
                        </div>
                    <form action="{{url('/actividades')}}" method="post" id="AddActividadesForm">
                      <input type="hidden" name="idusuario" id="idUsuario"  value="{{Auth::user()->id}}">
                      <meta name="csrf-token" content="{{ csrf_token() }}" id="_token">
                            <div class="container mt-2">
                                <div class="row">
                                    <div class="col-2">
                                      <div class="form-group">
                                        <label for="">Clave</label>
                                        <input type="text" name="clave" id="clave" class="form-control general" placeholder="" aria-describedby="helpId" maxlength="5" required style="text-transform:uppercase" autofocus>
                                      </div>
                                    </div>
                                    <div class="col-6">
                                     <div class="form-group">
                                       <label for="" >Nombre</label>
                                       <input type="text" name="nombre" id="nombre" class="form-control general" placeholder="" aria-describedby="helpId" required maxlength="40">                           
                                     </div>
                                 </div>
                                 <div class="col-4">
                                 <div class="form-group">
                                   <label for="">Tipo de Actividad</label>
                                   <select class="form-control " name="tipoactividades_id" id="tipoactividades_id" required>
                                     @foreach ($tipoactividades as $tipoactividad)
                                   <option value="{{$tipoactividad->TipoUnidad->id}}" data-tipoactividad="{{$tipoactividad->id}}">{{$tipoactividad->nombre}}</option>
                                     @endforeach
                                   </select>
                                 </div>
                               </div>
                                </div>
                                <div class="row">
                                  <div class="col-5">
                                    <div class="container">
                                      <div class="row ">
                                        <div class="col-6 pt-4">

                                          <div class="form-check form-check-inline">
                                            <label class="form-check-label lbcheck" for="ocupacion">
                                              <input class="  general pases-precios-check" type="checkbox"name="fijo" id="fijo" value="1"> Ocupacion Fija
                                            </label>
                                          </div>
                                          
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="duracion">Duración</label>
                                                <input type="number" class="form-control  general" name="duracion" id="duracion" aria-describedby="helpId" placeholder="" >                  
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-7">
                                    <div class="container">
                                      <div class="row">
                                      <div class="col-4">
                                          <label class="form-group pt-4 pl-5 lbcheck" for="ocupacion">
                                              <input class="  general pases-precios-check " type="checkbox"name="renta" id="renta" value="1"> Renta
                                            </label>
                                      </div>
                                      <div class="col-4">
                                          <div class="form-group">
                                              <label for="minutoincrementa">Min. Incremento</label>
                                              <input type="number" class="form-control renta__input general" name="minutoincrementa" id="minutoIncrementa" aria-describedby="helpId" placeholder="" disabled>
                                             </div>
                                      </div>
                                      <div class="col-4">
                                          <div class="form-group">
                                              <label for="">$ Incremento</label>
                                              <input type="number" class="form-control renta__input general" name="montoincremento" id="montoIncremento" aria-describedby="helpId" placeholder="$" disabled step="0.01">
                                             </div>
                                      </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-4">

                                    <div class="form-group">
                                      <label for="">Incluido en Combos:</label>
                                      <textarea class="form-control" name="" id="" rows="3" style="min-height: 7.5rem !important;"></textarea>
                                    </div>
                                  </div>
                                  <div class="col-3 ml-5 mr-5">
                                    <div class="row-modal">
                                    <div class="form-group">
                                      <label for="">Max Cortesias</label>
                                      <input type="number" class="form-control general" name="maxcortesias" id="maxCortesias" aria-describedby="helpId" placeholder="">
                                    </div>
                                   </div>
                                   <div class="row-modal">
                                       <div class="form-group  mr-5">
                                         <label for="">Max Cupones</label>
                                         <input type="number" class="form-control general" name="maxcupones" id="maxCupones" aria-describedby="helpId" placeholder="">
                                       </div>
                                      </div>
                                  </div>
                                  <div class="col-3">
                                    <div class="form-group">
                                      <label for=""> Acepta anticipo</label>
                                      <select class="form-control" name="anticipo_id" id="anticipoId" required>
                                          @foreach ($anticipos as $anticipo)
                                      <option value="{{$anticipo->id}}">{{$anticipo->nombre}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                 <div class="row-modal mt-5">
                                    <button type="submit" class="btn btn-success ">Guardar</button>
                                 </div>
                                  </div>
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
                        <form action="{{url('/actividades')}}" method="post" id="AddPreciosYPasesForm">
                          {{-- <meta name="csrf-token" content="{{ csrf_token() }}" id="_token"> --}}
                          <div class="container">
                            <div class="row ">
                              <div class="col-3 offset-2">
                                <div class="form-group">
                                  <label for="">Balance general (MXN)</label>
                                  <input type="text" name="balanceg" id="balanceG" class="form-control" placeholder="" aria-describedby="helpId" required  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                              </div>
                              <div class="col-3 offset-2 mb-2">
                                  <div class="form-group">
                                    <label for="">Precio General (MXN)</label>
                                    <input type="text" name="preciog" id="precioG" class="form-control" placeholder="" aria-describedby="helpId" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-6"><label for="" class="float-right">En Ocupación</label></div>
                              <div class="col-4"><label for=""  class="float-right">Acepta</label></div>
                            </div>
                            <div class="row "style="background-color: #FFFDCC">
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
@foreach ($personas as $persona)

  <div class="row " style="background-color: #FFFDCC" id="preciosContainer">
    <div class="col-1 padding-col"style="background-color:white" >
      <div class="form-group ">
        <label for="" class=" font-weight-bold" data-id="{{$persona->id}}" value="persona{{$persona->id}}" id="persona{{$persona->id}}" >{{$persona->nombre}}</label>
      </div>
    </div>
    <div class="col-1 padding-col" style="background-color: #CCFFFD">
      <div class="form-group">
        <input type="text" name="p1PersonaId{{$persona->id}}" id="p1PersonaId{{$persona->id}}" class="form-control" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
      </div>
    </div>
    <div class="col-1 padding-col" style="background-color: #CCFFFD">
      <div class="form-group">
        <input type="text" name="p2PersonaId{{$persona->id}}" id="p2PersonaId{{$persona->id}}" class="form-control" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
      </div>
    </div>
    <div class="col-1 padding-col" style="background-color: #CCFFFD">
      <div class="form-group">
        <input type="text" name="p3PersonaId{{$persona->id}}" id="p3PersonaId{{$persona->id}}" class="form-control" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
      </div>
    </div>
    <div class="col-1 padding-col pl-4" style="background-color: #CCFFCC">
      <div class="form-group">
        <input type="text" name="doblePersonaId{{$persona->id}}" id="doblePersonaId{{$persona->id}}" class="form-control" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
      </div>
    </div>
    <div class="col-1 padding-col" style="background-color: #CCFFCC">
      <div class="form-group">
        <input type="text" name="balanceDoblePersonaId{{$persona->id}}" id="balanceDoblePersonaId{{$persona->id}}" class="form-control" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
      </div>
    </div>
    <div class="col-1 padding-col "style="background-color: #CCFFCC" >
      <div class="form-group">
        <input type="text" name="triplePersonaId{{$persona->id}}" id="triplePersonaId{{$persona->id}}" class="form-control" placeholder="" aria-describedby="helpId"oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
      </div>
    </div>
    <div class="col-1 padding-col  "style="background-color: #CCFFCC">
      <div class="form-group">
        <input type="text" name="balanceTriplePersonaId{{$persona->id}}" id="balanceTriplePersonaId{{$persona->id}}" class="form-control" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
      </div>
    </div>
    <div class="col-1 padding-col ml-4 " style="background-color: #FFFDCC">
      <div class="form-group">
        <input type="checkbox" class="form-control pases-precios-check ml-3 check-clean" name="promoPersonaId{{$persona->id}}" id="promoPersonaId{{$persona->id}}" value="1" >
      </div>
    </div>
    <div class="col-1 padding-col " style="background-color: #FFFDCC">
      <div class="form-group">                                                   
        <input type="checkbox" class="form-control ml-3 pases-precios-check check-clean" name="restriccionPersonaId{{$persona->id}}" id="restriccionPersonaId{{$persona->id}}" value="1" onchange="habilitarAcompnante(this);" data-id="{{$persona->id}}">
      </div>
    </div>
    <div class="col-1 padding-col " style="background-color: #FFFDCC">
      <div class="form-group">
        <input type="checkbox" class="form-control ml-3 pases-precios-check check-clean" name="acompanantePersonaId{{$persona->id}}" id="acompanantePersonaId{{$persona->id}}" value="1" disabled>
      </div>
    </div>                                              
  </div>
                            @endforeach
  </div>
                          </form>
                    </div>             
                {{-- tercer pestaña --}}
<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"> 
  <div class="container">               
    <form action=""{{url('actividades')}} method="post" id="addHorariosYPuntos">
      <div class="pestana3-seccion1">
        <div class="checks-column">
          <div class="content">
            <label class="form-check-label">H. Libre</label>
            <input type="hidden" value="" id="idHorarioLibre">
            <input class=" sizecheck" type="checkbox" name="libre" id="libre" value="1"  data-id="1" >
          </div>
          <div class="content">
            <label class="form-check-label font-weight-bolder">Lunes</label>
            <input class="  diarioEntrega0 check-horario-libre sizecheck  horario-fijo" type="checkbox" name="lunes" id="dial1" value="1" disabled> 
          </div>
          <div class="content">
            <label class="form-check-label font-weight-bolder">Viernes</label>
            <input class="  diarioEntrega0 check-horario-libre sizecheck horario-fijo" type="checkbox" name="viernes" id="diav1" value="1"disabled> 
          </div>
        </div>
        <div class="checks-column">
          <div class="content">
            <label class="form-check-label lbcheck">Diario</label>
            <input class="  sizecheck general " type="checkbox" name="diario" id="diario" value="1" onchange="diarioEntrega(this);" data-id="0" disabled>
          </div>
          <div class="content">
            <label class="form-check-label font-weight-bolder">Martes</label>
            <input class="  diarioEntrega0 check-horario-libre sizecheck horario-fijo" type="checkbox" name="martes" id="diam1" value="1" disabled> 
          </div>
          <div class="content">
            <label class="form-check-label font-weight-bolder">Sabado</label>
            <input class="  diarioEntrega0 check-horario-libre sizecheck horario-fijo" type="checkbox" name="sabado" id="dias1" value="1" disabled> 
          </div>
        </div>
        <div class="checks-column mt-3">  
          <div class="content mt-5">
            <label class="form-check-label font-weight-bolder">Miercoles</label>
            <input class="  diarioEntrega0 check-horario-libre sizecheck horario-fijo" type="checkbox" name="miercoles" id="diax1" value="1" disabled> 
          </div>
          <div class="content">
            <label class="form-check-label font-weight-bolder">Domingo</label>
            <input class="  diarioEntrega0 check-horario-libre sizecheck horario-fijo" type="checkbox" name="domingo" id="diad1" value="1" disabled> 
          </div>
        </div>
        <div class="checks-column mt-3">
          <div class="content mt-5">
              <label class="form-check-label font-weight-bolder">Jueves</label>
                <input class="  diarioEntrega0 check-horario-libre sizecheck horario-fijo" type="checkbox" name="jueves" id="diaj1" value="1" disabled> 
          </div>
        </div>
        <div class="checks-column">
            <small id="content-salidas-llegadas__message-error"></small>
          <div class="content-salidas-llegadas">
            
              <div class="content">
                  <h2 class="d-inline lead">Primer Salida</h2>
                <input type="time" name="hiniHorarioLibre" id="hiniHorarioLibre" class="form-control h-horario-multiple-input" disabled>
              </div>
              <div class="content">
                  <h2 class="d-inline lead">Ultima Salida</h2>
                <input type="time" name="hfinHorarioLibre" id="hfinHorarioLibre" class="form-control h-horario-multiple-input" disabled>
              </div>
          
            <div class="content">
                <h2 class="d-inline lead">Salida</h2>
                  <select class="d-inline form-control-salidas " name="salidas" id="salidas" data-salida="true" disabled>
                    @foreach ($salidasLlegadas as $salidaLlegada)
                      <option value="{{$salidaLlegada->id}}"> {{$salidaLlegada->nombre}}</option>
                    @endforeach
                  </select>
            </div>
            <div class="content">
                <h2 class="d-inline lead">Llegada</h2> 
                <select class="d-inline form-control-salidas" name="llegadas" id="llegadas" data-salida="false" disabled>
                    @foreach ($salidasLlegadas as $salidaLlegada)
                      <option value="{{$salidaLlegada->id}}"> {{$salidaLlegada->nombre}}</option>
                    @endforeach
                </select>
            </div>
          </div>
        </div>
      </div>
      <div class="row position-sticky mt-3">
        <div class="col-12">
          <div class="row">
            <div class="col-2 text-center">H. Inicio</div>
            <div class="col-2 text-center">H. Fin</div>
            <div class="col-4text-center offset-2 justify-content-center align-content-center align-items-center">Días</div>
          </div>
        </div> 
      </div>
      <div class="container overflow">
        <div class="row mt-3">
          <div class="col-12 " id="actividadesHorarioContainer"  style="padding:0;" ></div>
        </div>
        </div> 
      <div class="row">
        <div class="col-2 addHorarioContanier">
          
          <a href="#!" class="btn btn-primary horario-multiple" id="addHorarioContanier" onclick="addHoraioContainer();" disabled><span>+ Horario</span></a>
        </div>
        <small id="alerForHLibre"></small>
      </div>
    </form>
  </div>
        <div class="container-fluid" id="rowContanier"></div> 
</div> 
                          {{-- 4ta --}}
                          <div class="tab-pane fade" id="generales" role="tabpanel" aria-labelledby="generales-tab">
                              <form action=""{{url('actividades')}} method="post" id="formGenerales">
                                  <div class="container mt-2">
                                      <div class="row mt-5">
                                       <div class="col-3">
                                           <label for=""  class="form-label pull-right">Actividad de Alto Riesgo</label>
                                       </div>
                                       <div class="col-2 ">
                                           <input type="checkbox" name="riesgo" id="riesgo" class="pull-left" value="1">
                                       </div> 
                                      </div>
                                      <div class="row mt-5">
                                       <div class="col-3">
                                         <label for=""  class="form-label pull-right">Puntos Acumulables</label>
                                     </div>
                                     <div class="col-2 ">
                                         
                                       <input type="text" name="puntos" id="puntos" class="form-control pull-left" placeholder="" aria-describedby="helpId"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                       <small>Clientes</small>
                                   </div>
                                      </div>
                                      <div class="row mt-5">
                                       <div class="col-3">
                                         <label for=""  class="form-label pull-right">Requisitos o Tips</label>
                                     </div>
                                     <div class="col-8 ">
                                       <textarea name="requisito" id="requisito" cols="30" rows="4" class="form-control pull-left" aria-describedby="helpId"></textarea>
                                     
                                   </div>
                                      </div>
                                      <div class="row mt-5">
                                         <div class="col-3">
                                           <label for=""  class="form-label pull-right">Observaciones Espesiales</label>
                                       </div>
                                       <div class="col-6 ">
                                         <textarea name="observaciones" id="observaciones" cols="30" rows="4" class="form-control pull-left" aria-describedby="helpId"></textarea>
                                       
                                     </div>
                                        </div>
                                     </div> 
                          </form >
                          </div>
                          {{-- 4ta --}}
                      </div>
                    </div>  
                    </div>
                  </div>
                 
             
            </div> 
            
         
            
           
        
{{--         
          </div>
        </div>
      </div>
       --}}
