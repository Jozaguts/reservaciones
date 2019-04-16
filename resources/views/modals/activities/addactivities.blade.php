 <!-- The Modal -->
 <div class="modal fade" id="addActivities">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Actividades</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" onclick="showPanel(this);" role="tab" aria-controls="home" aria-selected="true">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="PreciosYPases-tab" data-toggle="tab" href="#PreciosYPases"  onclick="showPanel(this);" role="tab" aria-controls="PreciosYPases" aria-selected="false">Precios y Pases</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact"  onclick="showPanel(this);" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show " id="general" role="tabpanel" aria-labelledby="home-tab">General
                    <form action="{{url('/actividades')}}" method="post" id="AddActividadesForm">
                      <meta name="csrf-token" content="{{ csrf_token() }}" id="_token">
                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col-2">
                                      <div class="form-group">
                                        <label for="">Clave</label>
                                        <input type="text" name="clave" id="clave" class="form-control general" placeholder="" aria-describedby="helpId" maxlength="5" required style="text-transform:uppercase">
                                       
                                      </div>
                                    </div>
                                    <div class="col-6">
                                     <div class="form-group">
                                       <label for="">Nombre</label>
                                       <input type="text" name="nombre" id="nombre" class="form-control general" placeholder="" aria-describedby="helpId" required>
                                      
                                     </div>
                                 </div>
                                 <div class="col-4">
                                 <div class="form-group">
                                   <label for="">Tipo de Actividad</label>
                                   <select class="form-control " name="tipoactividad" id="tipoActividad" required>
                                     @foreach ($tipoactividades as $tipoactividad)
                                         
                                     
                                   <option value="{{$tipoactividad->nombre}}">{{$tipoactividad->nombre}}</option>
                                     @endforeach
                                   </select>
                                 </div>
                               </div>
                                </div>
                                <div class="row">
                                  <div class="col-2 ml-5">
                                    <div class="form-group ">
                                      <label for="ocupacion" class="label-ocupacion">Ocupacion Fija</label>
                                        <input type="checkbox" class="form-control ml-3 general" name="fijo" id="fijo" value="checkedValue" >
                                       
                                    
                                    </div>  
                                  </div>
                                  <div class="col-1 ml-5">
                                     <div class="form-group ml-4">
                                      <label for="renta">Renta</label>
                                         <input type="checkbox" class="form-control general" name="renta" id="renta" value="checkedValue" >
                                     
                                       
                                     </div>
                                   </div>
                                   <div class="col-2">
                                     
                                     <div class="form-group">
                                       <label for="nimincluidos">Min. Incluidos</label>
                                       <input type="number" class="form-control renta__input general" name="nimincluidos" id="minIncluidos" aria-describedby="helpId" placeholder="" disabled>
                                      
                                     </div>
                                   </div>
                                   <div class="col-2">
                                       <div class="form-group">
                                         <label for="minincremento">Min. Incremento</label>
                                         <input type="number" class="form-control renta__input general" name="minincremento" id="minIncremento" aria-describedby="helpId" placeholder="" disabled>
                                        </div>
                                     </div>
                                     <div class="col-2">
                                         <div class="form-group">
                                           <label for="">$ Incremento</label>
                                           <input type="number" class="form-control renta__input general" name="incremento" id="incremento" aria-describedby="helpId" placeholder="$" disabled step="0.01">
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
                                         <input type="number" class="form-control general" name="maxcortesias" id="maxCortesias" aria-describedby="helpId" placeholder="">
                                
                                       </div>
                                      </div>
                                  </div>
                                  <div class="col-3">
                                    <div class="form-group">
                                      <label for=""> Acepta anticipo</label>
                                  
                                          
                                
                                      <select class="form-control" name="anticipo" id="anticipo" required>
                                          @foreach ($anticipos as $anticipo)
                                      <option value="{{$anticipo->id}}">{{$anticipo->nombre}}</option>
                                        {{-- motrar el nombre de tabla anticipo y guardar actividades anticipos_id --}}
                                        @endforeach
                                      </select>
                                    </div>
                                 <div class="row-modal mt-5">
                                    <button type="submit" class="btn btn-success ">Guardar</button>
                                 </div>
                                  </div>
                                
                                   </div>
                                </div>
                            </div>
                         </form>

                    </div>
                  </div>
                    <div class="tab-pane fade" id="PreciosYPases" role="tabpanel" aria-labelledby="PreciosYPases-tab">
                        <form action="{{url('/actividades')}}" method="post" id="AddPreciosYPasesForm">
                          <meta name="csrf-token" content="{{ csrf_token() }}" id="_token">
                          <div class="container">
                            <div class="row">
                              <div class="col-3 offset-2">
                                <div class="form-group">
                                  <label for="">Balance general</label>
                                  <input type="text" name="balanceg" id="balanceG" class="form-control" placeholder="" aria-describedby="helpId" required>
                                 
                                </div>
                              </div>
                              <div class="col-3 offset-2 mb-5">
                                  <div class="form-group">
                                    <label for="">Precio General</label>
                                    <input type="text" name="preciog" id="precioG" class="form-control" placeholder="" aria-describedby="helpId" required>
                                   
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-6"><label for="" class="float-right">En Ocupación</label></div>
                              <div class="col-4"><label for=""  class="float-right">Acepta</label></div>
                            </div>
                            <div class="row bg-warning ">
                                <div class="col-1 bg-primary">
                                    <div class="form-group">
                                        <label for="" class="">Nombre</label>
                                      
                                    </div>
                                  </div>
                                  <div class="col-1 bg-primary">
                                      <div class="form-group">
                                          <label for="" class="">Precio 1</label>
                                        
                                      </div>
                                    </div>

                                    <div class="col-1 bg-primary">
                                        <div class="form-group">
                                            <label for="" class="">Precio 2</label>
                                          
                                        </div>
                                      </div>
                                      <div class="col-1 bg-primary">
                                          <div class="form-group">
                                              <label for="" class="">Precio 3</label>
                                            
                                          </div>
                                        </div>
                                        <div class="col-1 bg-success pl-4">
                                            <div class="form-group">
                                                <label for="" class="">Doble</label>
                                              
                                            </div>
                                          </div>
                                          <div class="col-1 bg-success ">
                                              <div class="form-group">
                                                  <label for="" class="">Balance</label>
                                                
                                              </div>
                                            </div>
                                            <div class="col-1 bg-success ">
                                                <div class="form-group">
                                                    <label for="" class="">Triple</label>
                                                  
                                                </div>
                                              </div>
                                              <div class="col-1 bg-success ">
                                                  <div class="form-group">
                                                      <label for="" class="">Balance</label>
                                                    
                                                  </div>
                                                </div>
                                                <div class="col-1 bg-warning ml-3">
                                                    <div class="form-group">
                                                        <label for="" class="">Promo</label>
                                                       
                                                    </div>
                                                  </div>
                                                  <div class="col-1 bg-warning ">
                                                      <div class="form-group">
                                                          <label for="" class="">Restricción</label>
                                                         
                                                      </div>
                                                    </div>
                                                    <div class="col-1 bg-warning">
                                                        <div class="form-group">
                                                            <label for="" class="">Acompañante</label>
                                                           
                                                        </div>
                                                      </div>
                              </div>
                            @foreach ($personas as $persona)
                                
                          
                            <div class="row bg-warning">
                              <div class="col-1 bg-primary " >
                                  <div class="form-group ">
                                  <label for="" class=" font-weight-bold" >{{$persona->nombre}}</label>
                              </div>
                            </div>
                              <div class="col-1 bg-primary">
                                <div class="form-group">
                                
                                  <input type="text" name="precio1" id="precio1" class="form-control" placeholder="" aria-describedby="helpId">
                                </div>
                              </div>
                              <div class="col-1 bg-primary">
                                  <div class="form-group">
                                   
                                    <input type="text" name="precio2" id="precio2" class="form-control" placeholder="" aria-describedby="helpId">
                                  </div>
                                </div>
                                <div class="col-1 bg-primary">
                                    <div class="form-group">
                                       
                                      <input type="text" name="precio3" id="precio3" class="form-control" placeholder="" aria-describedby="helpId">
                                    </div>
                                  </div>
                                  
                                  <div class="col-1 bg-success pl-4">
                                      <div class="form-group">
                                         
                                        <input type="text" name="doble" id="doble" class="form-control" placeholder="" aria-describedby="helpId">
                                      </div>
                                    </div>
                                    <div class="col-1 bg-success ">
                                        <div class="form-group">
                                          
                                          <input type="text" name="banlancedoble" id="balancedoble" class="form-control" placeholder="" aria-describedby="helpId">
                                        </div>
                                      </div>
                                      <div class="col-1 bg-success ">
                                          <div class="form-group">
                                             
                                            <input type="text" name="triple" id="triple" class="form-control" placeholder="" aria-describedby="helpId">
                                          </div>
                                        </div>
                                        <div class="col-1 bg-success ">
                                            <div class="form-group">
                                               
                                              <input type="text" name="balancetriple" id="balancetriple" class="form-control" placeholder="" aria-describedby="helpId">
                                            </div>
                                          </div>
                                          <div class="col-1 bg-warning ml-3">
                                              <div class="form-group">
                                                 {{-- coment --}}

                                                  <input type="checkbox" class="form-control ml-3" name="promo" id="promo" value="checkedValue" >
                                              </div>
                                            </div>
                                            <div class="col-1 bg-warning ml-3">
                                                <div class="form-group">
                                                   
                                                    <input type="checkbox" class="form-control ml-3" name="restriccion" id="restriccion" value="checkedValue" >
                                                </div>
                                              </div>
                                              <div class="col-1 bg-warning ml-3">
                                                  <div class="form-group">
                                                      
                                                      <input type="checkbox" class="form-control ml-3" name="acompanante" id="acompanante" value="checkedValue" >
                                                  </div>
                                                </div>
                                              
                            </div>
                            @endforeach
                          </div>
                          </form>
                    </div>
             
                
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"> ada</div>
                  </div>
                 
             
            </div> 
            
         
            
           
        
        
          </div>
        </div>
      </div>