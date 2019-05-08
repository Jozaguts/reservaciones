//check restriciopn y acompañante

habilitarAcompnante = (e)=>{
    let id = e.getAttribute('data-id');
    let checkAcompanante = document.querySelector(`#acompanantePersonaId${id}`)
    
    if(e.checked){
    
    checkAcompanante.disabled = false;
    }else{
    checkAcompanante.disabled = true;
    }
    }
// habilitar acompañante
    let fijo = document.getElementById('fijo')
let renta = document.getElementById('renta')
let inputsREnta = document.querySelectorAll('input[class~=renta__input]')



renta.addEventListener('change',(e)=>{
  if(e.target.checked){
   
    inputsREnta.forEach((input)=>{
      input.disabled = false;
      input.required = true; 
    })
  }else{
  
    inputsREnta.forEach((input)=>{
      input.disabled = true;
      input.required = false; 
    })
  }
})

    //show panel modal

let panelsMOdal = document.querySelectorAll('.tab-pane')
showPanel =(element)=>{
// checkEmpty()

panelsMOdal.forEach((panel)=>{

`${panel.id}-tab` != element.id?panel.classList.remove('show'):null;
`${panel.id}-tab` != element.id?panel.classList.remove('active'):null;
})
}

// validar cambios en los modales antes de cerrar
const generalInputs = document.querySelectorAll('.general')
function checkEmpty(){

let contador =0;
generalInputs.forEach((input)=>{
  if(input.value.length>0){
    
    contador++;

   return contador;
  } 
  
  })
 if(contador>2){
  let confirmar = confirm('No has Guardado los Cambios, ¿Deseas Continuar?')
  if(confirmar==true){
    $('#addActivities').modal('hide');
    $(this).find('form').trigger('reset');
  }else{

  }
 
 }else{
  $('#addActivities').modal('hide');
 }
 
}

$('#addActivities').on('hide.bs.modal', function () {
  $(this).find('form').trigger('reset');

})

//Tercer pestaña CHECK LIBRE
const entrega = document.getElementById('entrega')
const salidas = document.getElementById('salidas')
const llegadas = document.getElementById('llegadas')
const checkDiario = document.getElementById('diario');

const checkLibre = document.getElementById('libre');
checkLibre.addEventListener('change',(e)=>{
if(checkLibre.checked){
// duracion.disabled = false;
entrega.disabled = false;
entrega.checked=false;
salidas.disabled = false;
llegadas.disabled = false;
checkDiario.disabled =false;
disabledHOrarioMultiple();
// checks horarios
const id = e.target.getAttribute('data-id')

const checkboks = document.querySelectorAll(`input[class*="diarioEntrega${id}"]`)
checkboks.forEach(function(checkbox){
  checkbox.checked = false;
  checkbox.disabled = false;
  })
}else{
// duracion.disabled = true;
entrega.disabled = true;
salidas.disabled = true;
llegadas.disabled = true;
checkDiario.disabled =true;
  // checks horarios
  const id = e.target.getAttribute('data-id')
 
  const checkboks = document.querySelectorAll(`input[class*="diarioEntrega${id}"]`)
  checkboks.forEach(function(checkbox){
    checkbox.checked = false;
    checkbox.disabled = true;
    enableddHOrarioMultiple();
    })

}
})
// FUNCIONES PARA EL CHECK LIBRE HABILITAR Y DESHABILITAR INPUTS ###############################

const itemsHorarioMultiples = document.querySelectorAll('.horario-multiple')
function disabledHOrarioMultiple(){

    itemsHorarioMultiples.forEach(function(item){
      item.disabled =true;
      if(item.nodeName == 'A'){
        item.classList.add('anchorElemet')
      }
    })
    }
    
    // enable horario multiple function
    
    const itemsHorarioMultiplesEnabled = document.querySelectorAll('.horario-multiple')
    
    
    function enableddHOrarioMultiple(){
    
    itemsHorarioMultiplesEnabled.forEach(function(item){
      item.disabled = false;
      if(item.nodeName == 'A'){
        item.classList.remove('anchorElemet')
      }
    })
    }
// FUNCIONES PARA EL CHECK LIBRE HABILITAR Y DESHABILITAR INPUTS ###############################

// FUNCIONES PARA EL CHECK DIARIO HABILITAR Y DESHABILITAR INPUTS ###############################
function diarioEntrega(e){
    let id = e.getAttribute('data-id')
    const checkboks = document.querySelectorAll(`input[class*="diarioEntrega${id}"]`)
    if(e.checked){
    checkboks.forEach(function(checkbox){
      checkbox.checked = true;
      checkbox.disabled = true;
      })
    }else{
    checkboks.forEach(function(checkbox){
      checkbox.checked = false;
      checkbox.disabled = false;
      })
    
    }
    }
    // FUNCIONES PARA EL CHECK DIARIO HABILITAR Y DESHABILITAR INPUTS ###############################


    // AGREGAR HORARIOS MULTIPLES ################################
    // add horarios container

const addHorarioContanier = document.getElementById('addHorarioContanier')
const rowContanier = document.getElementById('rowContanier')
let contador=2;
function addHoraioContainer(){
// addHorarioContanier.addEventListener('click',(e)=>{
 
//   e.preventDefault();

  let container= document.createElement('div')
  container.classList = "contanier";
  container.innerHTML= `
  <div class="container"> 
  <div class="h-divider">
  </div>
  <div class="row">
    <div class="col-12"> 
      <a href="#!" class="btn btn-danger float-right" onclick="cancelHorario(this)">X 
      </a>
    </div>
  </div>
  <div class="row">
                            
                            <div class="col-6">
                              <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Hora de Inicio:</label>
                                        <input type="time" name="horainicio" id="horainicio" class="form-control horario-multiple" placeholder="" aria-describedby="helpId">
                                      </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Hora de Finalización:</label>
                                        <input type="time" name="horafin" id="horafin" class="form-control horario-multiple" placeholder="" aria-describedby="helpId">
                                      </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="row mt-3">
                                  <div class="col-3 ml-1 ">
                                      <div class="form-group float-left">
                                          <label class="form-check-label lbcheck">
                                            <input class="  sizecheck general horario-multiple" type="checkbox" name="entrega" id="entrega" value="1" onchange="diarioEntrega(this);" data-id="999">Diario
                                          </label>
                                        </div>
                                  </div>
                                  <div class="col-8 ">
                                                <div class="container">
                                                    <div class="row">
                                                      <div class="">
                                                          <label class="form-check-label font-weight-bolder  ">L
                                                            </label>
                                                            <input class="  diarioEntrega999 sizecheck horario-multiple" type="checkbox" name="dial1" id="dial1" value="1" checked> 
                                                      </div>
                                                      <div class="ml-3">
                                                          <label class="form-check-label font-weight-bolder  ">M
                                                            </label>
                                                            <input class="  diarioEntrega999 sizecheck horario-multiple" type="checkbox" name="diam1" id="diam1" value="1" checked> 
                                                      </div>
                                                      <div class="ml-3">
                                                          <label class="form-check-label font-weight-bolder  ">X
                                                            </label>
                                                            <input class="  diarioEntrega999 sizecheck horario-multiple" type="checkbox" name="diax1" id="diax1" value="1" checked> 
                                                      </div>
                                                      <div class="ml-3">
                                                          <label class="form-check-label font-weight-bolder  ">J
                                                            </label>
                                                            <input class="  diarioEntrega999 sizecheck horario-multiple" type="checkbox" name="diaj1" id="diaj1" value="1" checked> 
                                                      </div>
                                                      <div class="ml-3">
                                                          <label class="form-check-label font-weight-bolder  ">V
                                                            </label>
                                                            <input class="  diarioEntrega999 sizecheck horario-multiple" type="checkbox" name="diav1" id="diav1" value="1"checked> 
                                                      </div>
                                                      <div class="ml-3" >
                                                          <label class="form-check-label font-weight-bolder  ">S
                                                            </label>
                                                            <input class="  diarioEntrega999 sizecheck horario-multiple" type="checkbox" name="dias1" id="dias1" value="1" checked> 
                                                      </div>
                                                      <div class="ml-3">
                                                          <label class="form-check-label font-weight-bolder  ">D
                                                            </label>
                                                            <input class="  diarioEntrega999 sizecheck horario-multiple" type="checkbox" name="diad1" id="diad1" value="1" checked> 
                                                      </div>
                                                    </div>
                                                  </div>
                                            </div>

                              </div>
                            </div>
                          </div>
                          <div class="row ">
                            <div class="col-12 ">
                              <div class="row">
                                <div class="col-6">  <h2 class="lead">Salidas</h2></div>
                                <div class="col-6">  <h2 class="lead">Llegadas</h2></div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                              <div class="col-6" >
                                  <div class="row">
                                      <div class="col-4">
                                          <div class="form-group">
                                            <label for="" data-punto="1";>Punto 1</label>
                                            <select class="form-control horario-multiple" name="" id="">
                                              <option></option>
                                              <option></option>
                                              <option></option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-4">
                                          <div class="form-group">
                                            <label for="">Hora</label>
                                            <input type="time" class="form-control horario-multiple" name="" id="" aria-describedby="helpId" placeholder="">
                                          </div>
                                          
                                        </div>
                                        <div class="col-4 d-inline mt-4 pt-1">
                                            <a href="#!" class="btn btn-secondary d-inline horario-multiple" id="primarybtnHora${contador}" onclick="addpunto(this);">+</a>
                                          </div>
                                  </div>
                                  </div>
                                  <div class="col-6">
                                      <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                              <label for="" data-punto="1";>Punto 1</label>
                                              <select class="form-control horario-multiple" name="" id="">
                                                <option></option>
                                                <option></option>
                                                <option></option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="col-4">
                                            <div class="form-group">
                                              <label for="">Hora</label>
                                              <input type="time" class="form-control horario-multiple" name="" id="" aria-describedby="helpId" placeholder="">
                                            </div>
                                            
                                          </div>
                                          <div class="col-4 d-inline mt-4 pt-1">
                                              <a href="#!" class="btn btn-secondary d-inline horario-multiple" id="secondarybtnHora${contador}" onclick="addpunto(this);">+</a>
                                            </div>
                                          </div>
                                      </div>
                          </div>
                          </div>

  `;
  rowContanier.appendChild(container);

  contador++;

}


// Borrar horario de HORARIOS MULTIPLES
// cancelar horario function
function cancelHorario(e){
    if(confirm('¿Eliminar Horario?')){
      e.parentElement.parentElement.parentElement.remove();
    }
  }


//   AGREGAR Y REMOVER PUNTO DE LLEGADA Y SALIDA EN HORARIOS MULTIPLES

let countRecolecion=2;
function addpunto(e){

let parent = e.parentElement.parentElement;
let numPunto = parent.children[0].children[0].children[0].getAttribute('data-punto');
let intNumPunto = parseInt(numPunto)+1;


let row = document.createElement('div');

row.classList ="container";
row.innerHTML=`

<div class="row">
<div class="col-4">
    <div class="form-group">
      <label for="" data-punto="${countRecolecion}">Punto ${countRecolecion}</label>
      <select class="form-control" name="" id="">
        <option></option>
        <option></option>
        <option></option>
      </select>
    </div>
  </div>
  <div class="col-4">
    <div class="form-group">
      <label for="">Hora</label>
      <input type="time" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
    </div>
    
  </div>
  <div class="col-4 d-inline mt-4 pt-1">
      <a href="#!" class="btn btn-secondary d-inline" id="secondarybtnHora1" onclick="addpunto(this);"> +</a>
      <a href="#!" class="btn btn-danger d-inline horario-multiple" id="primarybtnHora${contador}" onclick="removepunto(this);">-</a>
    </div>
    
  </div>  
`;

parent.appendChild(row);
intNumPunto++;
countRecolecion++;
}

// funcion remover punto
function removepunto(e){
e.parentElement.parentElement.remove();

}

// AJAX ##########################################################################

    // PESTAÑA 1 INICIO
    AddActividadesForm.addEventListener('submit',(e)=>{
        e.preventDefault();
        
        let datos = new FormData(AddActividadesForm) 
        let clave = datos.get('clave')
        let nombre = datos.get('nombre')
        let active=1;
        let remove=0;
        let tipoUnidadId = document.getElementById('tipoactividades_id').value; //tipo de unidad 
        let tipoactividadesid =1; //falta capturar el tipo de actividad
        // let tipoactividadesid = document.getElementById('tipoactividades_id'); //tipo de actividad       
        let duracion = datos.get('duracion')
        let minutoincrementa = datos.get('minutoincrementa')
        let montoincremento = datos.get('montoincremento')
        let maxcortesias = datos.get('maxcortesias')
        let maxcupones = datos.get('maxcupones')
        let anticipoid= datos.get('anticipo_id')
        let idusuario = datos.get('idusuario')
        
        console.log(`clave = ${clave}nombre = ${nombre}active = ${active}remove = ${remove} tipoUnidadId = ${tipoUnidadId}tipoUnidadId = ${tipoUnidadId} tipoactividadesid = ${tipoactividadesid}duracion = ${duracion} minutoincrementa = ${minutoincrementa}
        montoincremento = ${montoincremento}maxcortesias = ${maxcortesias} maxcupones = ${maxcupones} anticipoid = ${anticipoid} idusuario = ${idusuario}`)
        let route = 'actividades'
        
        $.ajax({
        url:route,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:'POST',
        dataType: 'json',
        data: {
            clave: clave,
            nombre: nombre,
            tipoactividades_id: tipoactividadesid,
            fijo:fijo,
            renta:renta,
            duracion:duracion,
            minutoincrementa:minutoincrementa,
            montoincremento:montoincremento,
            maxcortesias:maxcortesias,
            maxcupones:maxcupones,
            anticipo_id:anticipoid,
            idusuario:idusuario,
            active:active,
            remove:remove,
            tipounidades_id:tipoUnidadId
        },

        success: function (data) {
        
        
          if(data.error == 'true'){
            data.errors.forEach(()=>{})
            $('#errorsIntoModal').html(data.errors[0]);
              $('#message-errorIntoModal').fadeIn();
              setTimeout(() => {
                $('#message-errorIntoModal').fadeOut();
              }, 3000);
              // setTimeout("location.reload(true);",3000)
              
          }else{
            $('#successIntoModal').html(data.ok);
              $('#message-successIntoModal').fadeIn();
              setTimeout(() => {
                $('#message-successIntoModal').fadeOut();
              }, 3000);
              setTimeout("location.reload(true);",1000)
          }
        }
        
        
        })
        
        })



    
    // PESTAÑA 1 FIN




// AJAX ##########################################################################


