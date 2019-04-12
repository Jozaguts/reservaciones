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
                      <a class="nav-link active" id="home_tab" data-toggle="tab" href="#general" role="tab" aria-controls="home" aria-selected="true">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="home_tab">General
                    <form action="{{url('/actividades')}}" method="post" id="AddActividadesForm">

                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col-2">
                                      <div class="form-group">
                                        <label for="">Clave</label>
                                        <input type="text" name="clave" id="clave" class="form-control" placeholder="" aria-describedby="helpId" maxlength="5" required>
                                       
                                      </div>
                                    </div>
                                    <div class="col-6">
                                     <div class="form-group">
                                       <label for="">Nombre</label>
                                       <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" aria-describedby="helpId" required>
                                      
                                     </div>
                                 </div>
                                 <div class="col-4">
                                 <div class="form-group">
                                   <label for="">Tipo de Actividad</label>
                                   <select class="form-control" name="tipoactividad" id="tipoActividad" required>
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
                                        <input type="checkbox" class="form-control ml-3" name="fijo" id="fijo" value="checkedValue" >
                                       
                                    
                                    </div>  
                                  </div>
                                  <div class="col-1 ml-5">
                                     <div class="form-group ml-5">
                                      <label for="renta">Renta</label>
                                         <input type="checkbox" class="form-control" name="renta" id="renta" value="checkedValue" >
                                     
                                       
                                     </div>
                                   </div>
                                   <div class="col-3">
                                     
                                     <div class="form-group">
                                       <label for="nimincluidos">Min. Incluidos</label>
                                       <input type="number" class="form-control" name="nimincluidos" id="minIncluidos" aria-describedby="helpId" placeholder="">
                                      
                                     </div>
                                   </div>
                                   <div class="col-2">
                                       <div class="form-group">
                                         <label for="nimincremento">Min. Incremento</label>
                                         <input type="number" class="form-control" name="nimincremento" id="minIncremento" aria-describedby="helpId" placeholder="">
                                        </div>
                                     </div>
                                     <div class="col-2">
                                         <div class="form-group">
                                           <label for="">$ Incremento</label>
                                           <input type="number" class="form-control" name="nimincremento" id="minIncremento" aria-describedby="helpId" placeholder="">
                                          </div>
                                       </div>

                                </div>
                                <div class="row">
                                  <div class="col-1 mt-4">
                                    <div class="form-group ml-4">
                                      <label for="combo">Combo</label>
                                        <input type="checkbox" class="form-control" name="combo" id="combo" value="checkedValue" >
                                       
                                    
                                    </div> 
                                  </div>
                                  <div class="col-2">
                                    <div class="row-modal">
                                      <div class="form-group">
                                        <label for=""> </label>
                                        <select class="form-control" name="" id="">
                                          <option></option>
                                          <option></option>
                                          <option></option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="row-modal">
                                       <div class="form-group">
                                         <label for=""> </label>
                                         <select class="form-control" name="" id="">
                                           <option></option>
                                           <option></option>
                                           <option></option>
                                         </select>
                                       </div>
                                     </div>
                                  </div>
                                  <div class="col-1 mt-5 ml-0">
                                    <div class="input-group mt-5 ml-0">
                                      <span class="input-group-btn">
                                        <button class="btn btn-secondary" type="button" aria-label="">+</button>
                                      </span>
              
                                    </div>
                                  </div>
                                  <div class="col-3 ml-5 mr-5">
                                    <div class="row-modal">
                                    <div class="form-group">
                                      <label for="">Max Cortesias</label>
                                      <input type="number" class="form-control" name="maxcortesias" id="maxCortesias" aria-describedby="helpId" placeholder="">
                             
                                    </div>
                                   </div>
                                   <div class="row-modal">
                                       <div class="form-group  mr-5">
                                         <label for="">Max Cupones</label>
                                         <input type="number" class="form-control" name="maxcortesias" id="maxCortesias" aria-describedby="helpId" placeholder="">
                                
                                       </div>
                                      </div>
                                  </div>
                                  <div class="col-3 ml-5">
                                    <div class="form-group">
                                      <label for=""> Acepta anticipo</label>
                                      <select class="form-control" name="anticipo" id="anticipo" required>
                                        <option></option>
                                        <option></option>
                                        <option></option>
                                      </select>
                                    </div>
                                 <div class="row-modal">
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                 </div>
                                  </div>
                                
                                   </div>
                                </div>
                            </div>
                         </form>

                    </div>
                    
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">.dsdsdsds.</div>
             
                
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"> </div>
                  </div>
                 
             
            </div> //
            
         
            
           
        
        
          </div>
        </div>
      </div>