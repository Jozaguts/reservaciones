<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Asignaciones</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="asignaciones">
            <div class="container">
              <div class="row">
                  <div class="col-2">
                      <div class="form-group">
                        <label for="clave">Clave</label>
                        <input type="text" name="clave" id="clave" class="form-control" placeholder="" aria-describedby="helpId" disabled>
                      </div>
                  </div>
                  <div class="col-3">
                      <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" aria-describedby="helpId" disabled>
                      </div>
                  </div>
                  <div class="col-3">
                      <div class="form-group">
                        <label for="tipo-de-unidad">Tipo de unidad</label>
                        <input type="text" name="tipo_unidad" id="tipo_unidad" class="form-control" placeholder="" aria-describedby="helpId" disabled>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label for="capacida">Capacidad</label>
                        <input type="text" name="capacidad" id="capacidad" class="form-control" placeholder="" aria-describedby="helpId" disabled>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label for="placa">Placa</label>
                        <input type="text" name="placa" id="placa" class="form-control" placeholder="" aria-describedby="helpId" disabled>
                      </div>
                  </div>
                  
              </div>
              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label for="actividades">Actividad</label>
                    <select class="form-control" name="actividades" id="actividades">
                      <option selected="true" value="false">Seleccione una actividad</option>
                      
                    </select>
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="horario">Horario</label>
                    <select class="form-control" name="horario" id="horario">
                      
                  
                    </select>
                  </div>
                </div>
                <div class="col-4">
                  <div class="container">
                    <div class="row">
                      <div class="col-10">
                        <div class="form-group">
                          <label for="slu">Salida | Llegada | Ubicación</label>
                          <select class="form-control" name="slu" id="slu">
                           
                          </select>
                        </div>
                      </div>
                      <div class="col-2">
                        <div class="form-group pt-1">
                            <a name="seleccionar" id="seleccionar" class="btn btn-primary mt-4" href="#" role="button">+</a>
                        </div>
                       
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row"> {{-- tabla --}}
                <table class="table">
                  <thead>
                      <caption>Actividades Incluidas</caption>
                    <tr>
                      <th>Clave</th>
                      <th>Nombre</th>
                      <th>Horario</th>
                      <th>Salida</th>
                      <th>Ubicación</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td scope="row">CAN01</td>
                      <td>CANOPY EL EDEN</td>
                      <td>08:00:00</td>
                      <td>S</td>
                      <td>Jarretaderas</td>
                      <td><span class="btn btn-danger">-</span></td>
                    </tr>
                    <tr>
                        <td scope="row">PRE01</td>
                        <td>PREDATOR</td>
                        <td>10:00:00</td>
                        <td>Ll</td>
                        <td>Jarretaderas</td>
                        <td><span class="btn btn-danger">-</span></td>
                      </tr>
                  
                  </tbody>
                </table>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>