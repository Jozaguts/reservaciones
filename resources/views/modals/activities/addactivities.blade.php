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
                              <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                            </li>
                          </ul>
                          <div class="tab-content" id="myTabContent">
                              {{-- contenido --}}
                            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                                <form action="" method="post">

                                   <div class="container mt-5">
                                       <div class="row">
                                           <div class="col-2">
                                             <div class="form-group">
                                               <label for="">Clave</label>
                                               <input type="text" name="clave" id="clave" class="form-control" placeholder="" aria-describedby="helpId" maxlength="5">
                                              
                                             </div>
                                           </div>
                                           <div class="col-6">
                                            <div class="form-group">
                                              <label for="">Nombre</label>
                                              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" aria-describedby="helpId">
                                             
                                            </div>
                                        </div>
                                        <div class="col-4">
                                        <div class="form-group">
                                          <label for="">Tipo de Actividad</label>
                                          <select class="form-control" name="tipoactividad" id="tipoActividad">
                                            @foreach ($tipoactividades as $tipoactividad)
                                                
                                            
                                          <option value="{{$tipoactividad->nombre}}">{{$tipoactividad->nombre}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                       </div>
                                       <div class="row">
                                         <div class="col-2">
                                           <div class="form-check">
                                             <label class="form-check-label">
                                               <input type="checkbox" class="form-check-input" name="fijo" id="fijo" value="checkedValue" checked>
                                               Ocupación Fija
                                             </label>
                                           </div>
                                         </div>
                                         <div class="col-2">
                                            <div class="form-check">
                                              <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="renta" id="renta" value="checkedValue" checked>
                                                Renta
                                              </label>
                                            </div>
                                          </div>
                                          <div class="col-3">
                                            <div class="form-group">
                                              <label for="nimincluidos">Min. Incluidos</label>
                                              <input type="number" class="form-control" name="nimincluidos" id="minIncluidos" aria-describedby="helpId" placeholder="">
                                             
                                            </div>
                                          </div>
                                          <div class="col-3">
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
                                         <div class="col-1">
                                           <div class="form-check">
                                             <label class="form-check-label">
                                               <input type="checkbox" class="form-check-input" name="combo" id="combo" value="checkedValue" checked>
                                               Combo
                                             </label>
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
                                         <div class="col-1 mt-5">
                                           <div class="input-group">
                                             <span class="input-group-btn">
                                               <button class="btn btn-secondary" type="button" aria-label="">+</button>
                                             </span>
                     
                                           </div>
                                         </div>
                                         <div class="col-3 ml-5">
                                           <div class="row-modal">
                                           <div class="form-group">
                                             <label for="">Max Cortesias</label>
                                             <input type="number" class="form-control" name="maxcortesias" id="maxCortesias" aria-describedby="helpId" placeholder="">
                                    
                                           </div>
                                          </div>
                                          <div class="row-modal">
                                              <div class="form-group">
                                                <label for="">Max Cupones</label>
                                                <input type="number" class="form-control" name="maxcortesias" id="maxCortesias" aria-describedby="helpId" placeholder="">
                                       
                                              </div>
                                             </div>
                                         </div>
                                        
                                          </div>
                                       </div>
                                   </div>
                                </form>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>

                            </div>
                            {{-- fin del contenido --}}
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                          </div>
             
            </div>
            
            <!-- Modal footer -->
            
            
          </div>
        </div>
      </div>