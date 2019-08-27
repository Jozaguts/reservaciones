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
                  <div class="col-1">
                      <div class="form-group">
                        <label for="clave">Clave</label>
                        <input type="text" name="clave" id="clave" class="form-control" placeholder="CAM01" aria-describedby="helpId" disabled>
                      </div>
                  </div>
                  <div class="col-5">
                      <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="CAMIÓN KODIAK 01" aria-describedby="helpId" disabled>
                      </div>
                  </div>
                  <div class="col-4">
                      <div class="form-group">
                        <label for="tipo-de-unidad">Tipo de unidad</label>
                        <input type="text" name="tipo-de-unidad" id="tipo-de-unidad" class="form-control" placeholder="CAMION" aria-describedby="helpId" disabled>
                      </div>
                  </div>
                  <div class="col-1">
                      <div class="form-group">
                        <label for="capacida">Capacidad</label>
                        <input type="text" name="capacidad" id="capacidad" class="form-control" placeholder="10" aria-describedby="helpId" disabled>
                      </div>
                  </div>
                  <div class="col-1">
                      <div class="form-group">
                        <label for="placa">Placa</label>
                        <input type="text" name="placa" id="placa" class="form-control" placeholder="JFH22331" aria-describedby="helpId" disabled>
                      </div>
                  </div>
                  
              </div>
              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label for="actividad">Actividad</label>
                    <select class="form-control" name="actividad" id="actividad">
                      <option>MOTO 01 | PASEO EN MOTOS EL EDEN</option>
                      <option>PRE01 | PREDATOR</option>
                      <option>CAN01 | CANOPY EL EDEN</option>
                    </select>
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="horario">Horario</label>
                    <select class="form-control" name="horario" id="horario">
                      <option>8:00AM | 12:00PM | L,M,X,J,V,S,D</option>
                      <option>9:00AM | 1:00PM | S,D</option>
                      <option>2:00AM | 5:00PM | L,M,X,S,D</option>
                      <option>3:00AM | 6:00PM | L,M,X,J,V</option>
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
                            <option>14:00:00 | S | Jarretaderas</option>
                            <option>19:00:00 | Ll | Jarretaderas</option>
                            <option>09:00:00 | S | Oxxo Las Juntas</option>
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