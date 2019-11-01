 <!-- The Modal -->
 <div class="modal fade" id="editActivities" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Editar Actividad</h4>
          <button type="button" class="close" onclick="checkEmpty()">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="editGeneral-tab" data-toggle="tab" href="#editGeneral" onclick="showPanel(this);" role="tab" aria-controls="home" aria-selected="true">General</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="EditPreciosYPases-tab" data-toggle="tab" href="#editPreciosYPases"  onclick="showPanel(this);" role="tab" aria-controls="editPreciosYPases" aria-selected="false">Editar Precios y Pases</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="editHorarios-tab" data-toggle="tab" href="#editHorarios"  onclick="showPanel(this);" role="tab" aria-controls="contact" aria-selected="false">Editar Horarios y Puntos de Salida y Llegadas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="editAdicionales=tab" data-toggle="tab" href="#editAdicionales"  onclick="showPanel(this);" role="tab" aria-controls="generales" aria-selected="false">Editar Datos Adicionales </a>
                  </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show " id="editgeneral" role="tabpanel" aria-labelledby="home-tab">

                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-sm-6 offset-md-2">
                                @include('components.alertsintomodals')                                    
                            </div>
                        </div>
                    </div>
                <form action="{{url('/actividades')}}" method="post" id="editActividadesForm">
                  <input type="hidden" name="idusuario" id="idUsuario"  value="{{Auth::user()->id}}">
                  <meta name="csrf-token" content="{{ csrf_token() }}" id="_token">
                        <div class="container mt-2">
                            <div class="row">
                                <div class="col-2">
                                  <div class="form-group">
                                    <label for="">Clave</label>
                                    <input type="text" name="editclave" id="editclave" class="form-control general" placeholder="" aria-describedby="helpId" maxlength="5" required style="text-transform:uppercase" autofocus>
                                  </div>
                                </div>
                                <div class="col-6">
                                 <div class="form-group">
                                   <label for="" >Nombre</label>
                                   <input type="text" name="editnombre" id="editnombre" class="form-control general" placeholder="" aria-describedby="helpId" required>                           
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
                                          <input class="  general pases-precios-check" type="checkbox"name="editfijo" id="editfijo" value="1"> Ocupacion Fija
                                        </label>
                                      </div>
                                      
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="duracion">Duración</label>
                                            <input type="number" class="form-control  general" name="editduracion" id="editduracion" aria-describedby="helpId" placeholder="" >                  
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
                                          <input class="  general pases-precios-check" type="checkbox"name="editrenta" id="editrenta" value="1"> Renta
                                        </label>
                                  </div>
                                  <div class="col-4">
                                      <div class="form-group">
                                          <label for="minutoincrementa">Min. Incremento</label>
                                          <input type="number" class="form-control renta__input general" name="editminutoincrementa" id="editminutoIncrementa" aria-describedby="helpId" placeholder="" disabled>
                                         </div>
                                  </div>
                                  <div class="col-4">
                                      <div class="form-group">
                                          <label for="">$ Incremento</label>
                                          <input type="number" class="form-control renta__input general" name="editmontoincremento" id="editmontoIncremento" aria-describedby="helpId" placeholder="$" disabled step="0.01">
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
                                  <input type="number" class="form-control general" name="editmaxcortesias" id="editmaxCortesias" aria-describedby="helpId" placeholder="">
                                </div>
                               </div>
                               <div class="row-modal">
                                   <div class="form-group  mr-5">
                                     <label for="">Max Cupones</label>
                                     <input type="number" class="form-control general" name="editmaxcupones" id="editmaxCupones" aria-describedby="helpId" placeholder="">
                                   </div>
                                  </div>
                              </div>
                              <div class="col-3">
                                <div class="form-group">
                                  <label for=""> Acepta anticipo</label>
                                  <select class="form-control" name="editanticipo_id" id="editanticipoId" required>
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
                    <form action="{{url('/actividades')}}" method="post" id="editPreciosYPasesForm">
                      {{-- <meta name="csrf-token" content="{{ csrf_token() }}" id="_token"> --}}
                      <div class="container">
                        <div class="row ">
                          <div class="col-3 offset-2">
                            <div class="form-group">
                              <label for="">Balance general</label>
                              <input type="text" name="editbalanceg" id="editbalanceG" class="form-control" placeholder="" aria-describedby="helpId" required  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                          </div>
                          <div class="col-3 offset-2 mb-2">
                              <div class="form-group">
                                <label for="">Precio General</label>
                                <input type="text" name="editpreciog" id="editprecioG" class="form-control" placeholder="" aria-describedby="helpId" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
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
                            
                      
                        <div class="row " style="background-color: #FFFDCC">
                          <div class="col-1 padding-col"style="background-color:white" >
                              <div class="form-group ">
                              <label for="" class=" font-weight-bold" data-id="{{$persona->id}}" value="editpersona{{$persona->id}}" id="editpersona{{$persona->id}}" >{{$persona->nombre}}</label>
                          </div>
                        </div>
                          <div class="col-1 padding-col" style="background-color: #CCFFFD">
                            <div class="form-group">
                              <input type="text" name="editp1PersonaId{{$persona->id}}" id="editp1PersonaId{{$persona->id}}" class="form-control" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                            </div>
                          </div>
                          <div class="col-1 padding-col" style="background-color: #CCFFFD">
                              <div class="form-group">
                                <input type="text" name="editp2PersonaId{{$persona->id}}" id="editp2PersonaId{{$persona->id}}" class="form-control" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                              </div>
                            </div>
                            <div class="col-1 padding-col" style="background-color: #CCFFFD">
                                <div class="form-group">
                                  <input type="text" name="editp3PersonaId{{$persona->id}}" id="editp3PersonaId{{$persona->id}}" class="form-control" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                </div>
                              </div>
                              <div class="col-1 padding-col pl-4" style="background-color: #CCFFCC">
                                  <div class="form-group">
                                    <input type="text" name="editdoblePersonaId{{$persona->id}}" id="editdoblePersonaId{{$persona->id}}" class="form-control" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                  </div>
                                </div>
                                <div class="col-1 padding-col" style="background-color: #CCFFCC">
                                    <div class="form-group">
                                      <input type="text" name="editbalanceDoblePersonaId{{$persona->id}}" id="editbalanceDoblePersonaId{{$persona->id}}" class="form-control" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                    </div>
                                  </div>
                                  <div class="col-1 padding-col "style="background-color: #CCFFCC" >
                                      <div class="form-group">
                                        <input type="text" name="edittriplePersonaId{{$persona->id}}" id="edittriplePersonaId{{$persona->id}}" class="form-control" placeholder="" aria-describedby="helpId"oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                      </div>
                                    </div>
                                    <div class="col-1 padding-col  "style="background-color: #CCFFCC">
                                        <div class="form-group">
                                          <input type="text" name="editbalanceTriplePersonaId{{$persona->id}}" id="editbalanceTriplePersonaId{{$persona->id}}" class="form-control" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                        </div>
                                      </div>
                                      <div class="col-1 padding-col ml-4 " style="background-color: #FFFDCC">
                                          <div class="form-group">
                                              <input type="checkbox" class="form-control pases-precios-check ml-3" name="editpromoPersonaId{{$persona->id}}" id="editpromoPersonaId{{$persona->id}}" value="1" >
                                          </div>
                                        </div>
                                        <div class="col-1 padding-col " style="background-color: #FFFDCC">
                                            <div class="form-group">                                                   
                                            <input type="checkbox" class="form-control ml-3 pases-precios-check" name="editrestriccionPersonaId{{$persona->id}}" id="editrestriccionPersonaId{{$persona->id}}" value="1" onchange="habilitarAcompnante(this);" data-id="{{$persona->id}}">
                                            </div>
                                          </div>
                                          <div class="col-1 padding-col " style="background-color: #FFFDCC">
                                              <div class="form-group">
                                                  
                                                  <input type="checkbox" class="form-control ml-3 pases-precios-check" name="editacompanantePersonaId{{$persona->id}}" id="editacompanantePersonaId{{$persona->id}}" value="1" disabled>
                                              </div>
                                            </div>                                              
                        </div>
                        @endforeach
                      </div>
                      </form>
                </div>             
            {{-- tercer pestaña --}}
                <div class="tab-pane fade" id="editHorarios" role="tabpanel" aria-labelledby="editHorarios-tab"> 
                  <div class="container">               
                <form action=""{{url('actividades')}} method="post" id="editHorariosYPuntos">
                <div class="container mt-2">
                  <div class="row">
                    <div class="col-6 mt-3">
                      <div class="row">
                        <div class="col-3">
                          <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class=" sizecheck" type="checkbox" name="editlibre" id="editlibre" value="1"  data-id="1" >Libre
                            </label>
                          </div>
                        </div>
                        <div class="col-6"> 
                            <div class="form-group float-left">
                                <label class="form-check-label lbcheck">
                                  <input class="  sizecheck general " type="checkbox" name="editdiario" id="editdiario" value="1" onchange="diarioEntrega(this);" data-id="0" disabled>Diario
                                </label>
                              </div>
                        </div>
                      </div>  
                    </div>
                    <div class="col-6">
                                <h2 class="lead">Salidas</h2>                         
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="form-group">
                                              <label for="" data-punto="1";>Punto 1</label>                                                 
                                            </div>
                                          </div>
                                          <div class="col-6">
                                              <select class="form-control" name="editsalidas" id="editsalidas" data-salida="true" disabled>
                                                  @foreach ($salidasLlegadas as $salidaLlegada)
                                              <option value="{{$salidaLlegada->id}}"> {{$salidaLlegada->nombre}}</option>
                                                  @endforeach
                                                </select>
                                          </div>
                                        
                                    </div>                             
                    </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                          <div class="row">
                            <div class="col-3">
                              <div class="">
                                <label class="form-check-label font-weight-bolder  ">Lunes
                                  </label>


                                  <input class="  diarioEntrega0 sizecheck  horario-fijo" type="checkbox" name="editlunes" id="editdial1" value="1" disabled> 

                            </div>
                          </div>
                            <div class="col-3">
                                <div class="">
                                    <label class="form-check-label font-weiFght-bolder  ">Martes
                                      </label>

                                      <input class="  diarioEntrega0 sizecheck horario-fijo" type="checkbox" name="editmartes" id="editdiam1" value="1" disabled> 

                                </div>
                            </div>
                            <div class="col-3">
                                <div class="">
                                <label class="form-check-label font-weight-bolder  ">Miercoles
                                  </label>

                                  <input class="  diarioEntrega0 sizecheck horario-fijo" type="checkbox" name="editmiercoles" id="editdiax1" value="1" disabled> 

                            </div>
                          </div>
                          </div>
                          <div class="row">
                            <div class="col-3">
                                <div class="">
                                    <label class="form-check-label font-weight-bolder  ">Jueves
                                      </label>

                                      <input class="  diarioEntrega0 sizecheck horario-fijo" type="checkbox" name="editjueves" id="editdiaj1" value="1" disabled> 

                                </div>
                            </div>
                            <div class="col-3">
                                <div class="">
                                    <label class="form-check-label font-weight-bolder  ">Viernes
                                      </label>

                                      <input class="  diarioEntrega0 sizecheck horario-fijo" type="checkbox" name="editviernes" id="editdiav1" value="1"disabled> 

                                </div>
                            </div>
                            <div class="col-3">
                                <div class="" >
                                    <label class="form-check-label font-weight-bolder  ">Sabado
                                      </label>

                                      <input class="  diarioEntrega0 sizecheck horario-fijo" type="checkbox" name="editsabado" id="editdias1" value="1" disabled> 

                                </div>
                            </div>
                            <div class="col-3">
                                <div class="">
                                    <label class="form-check-label font-weight-bolder  ">Domingo
                                      </label>

                                      <input class="  diarioEntrega0 sizecheck horario-fijo" type="checkbox" name="editdomingo" id="editdiad1" value="1" disabled> 

                                </div>
                            </div>
                          </div>                             
                        </div>
                        <div class="col-6">
                            <h2 class="lead">Llegadas</h2>
                         </div>                           
                    </div>
                    <div class="row">

                      <div class="col-6" >
                        
                        </div>
                    <div class="col-6" id="puntosContainer">
                      <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                              <label for="" data-punto="1"; >Punto 1</label>                                 
                            </div>
                          </div>
                          <div class="col-6">
                              <select class="form-control" name="editllegadas" id="editllegadas" data-salida="false" disabled>
                                  @foreach ($salidasLlegadas as $salidaLlegada)
                                  <option value="{{$salidaLlegada->id}}"> {{$salidaLlegada->nombre}}</option>                                       
                                      @endforeach
                                </select>
                          </div>                             
                          </div>
                      </div>
                    </div>
                    <div class="row position-sticky mt-3">
                        <div class="col-6">
                          <div class="row">
                           {{-- <div class="col-3">Horario</div> --}}
                           <div class="col-3">H. Inicio</div>
                           <div class="col-3">H. Fin</div>
                           <div class="col-2">Días</div>
                           
                          </div>
                        
                        </div>
                        <div class="col-6">
                           
                       </div>
                      </div>
                 <div class="container overflow">
                        <div class="row mt-3">
                          <div class="col-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore ducimus voluptatem eaque accusamus nostrum reiciendis itaque totam earum! Quisquam earum fugiat nobis amet, quia officia sapiente nemo? Ratione, eum sapiente!</p>
                          </div>
                   
                        </div>
                  
                     </div> 
                    <div class="row">
                        <div class="col-2">
                            <a href="#!" class="btn btn-primary horario-multiple" id="editHorarioContanier" onclick="addHoraioContainer();"><span>+ Horario</span></a>
                           </div>
                    </div>
                  </div>       
                      </div>
                      <div class="container-fluid" id="editrowContanier"></div>
                      </form>   
                      </div>
                      {{-- 4ta --}}
                      <div class="tab-pane fade" id="editAdicionales" role="tabpanel" aria-labelledby="generales-tab">
                          <form action=""{{url('actividades')}} method="post" id="editformAdicionales">
                      <div class="container mt-2">
                       <div class="row mt-5">
                        <div class="col-3">
                            <label for=""  class="form-label pull-right">Actividad de Alto Riesgo</label>
                        </div>
                        <div class="col-2 ">
                            <input type="checkbox" name="editriesgo" id="editriesgo" class="pull-left" value="1">
                        </div> 
                       </div>
                       <div class="row mt-5">
                        <div class="col-3">
                          <label for=""  class="form-label pull-right">Puntos Acumulables</label>
                      </div>
                      <div class="col-2 ">
                          
                        <input type="text" name="editpuntos" id="editpuntos" class="form-control pull-left" placeholder="" aria-describedby="helpId"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <small>Clientes</small>
                    </div>
                       </div>
                       <div class="row mt-5">
                        <div class="col-3">
                          <label for=""  class="form-label pull-right">Requisitos o Tips</label>
                      </div>
                      <div class="col-8 ">
                        <textarea name="editrequisito" id="editrequisito" cols="30" rows="4" class="form-control pull-left" aria-describedby="helpId"></textarea>
                      
                    </div>
                       </div>
                       <div class="row mt-5">
                          <div class="col-3">
                            <label for=""  class="form-label pull-right">Observaciones Especiales</label>
                        </div>
                        <div class="col-6 ">
                          <textarea name="editobservaciones" id="editobservaciones" cols="30" rows="4" class="form-control pull-left" aria-describedby="helpId"></textarea>
                        
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
        