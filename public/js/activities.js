

// mostrar contenido de los boones
showContent = function (e){
    e.nextSibling.nextSibling.classList.contains('d-none')?e.nextSibling.nextSibling.classList.toggle('show')&&e.nextSibling.nextSibling.classList.remove('d-none'):e.nextSibling.nextSibling.classList.add('d-none')
  }
  
//cambiar a color a inactivos
  let elements = document.querySelectorAll('[data-active="0"]');
elements .forEach(element => {
   element.classList.add('tr-bg');
});


//show panel modal

let general = document.getElementById('general')
let profile = document.getElementById('profile')
let contact = document.getElementById('contact')

let panelsMOdal = document.querySelectorAll('.tab-pane')
showPanel =(element)=>{
  // checkEmpty()

panelsMOdal.forEach((panel)=>{
  
`${panel.id}-tab` != element.id?panel.classList.remove('show'):null;
`${panel.id}-tab` != element.id?panel.classList.remove('active'):null;
})
}

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




// opupacion fija y renta checkbox e inputs

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






//add actividades 


let AddActividadesForm = document.getElementById('AddActividadesForm');
let AddPreciosYPasesForm = document.getElementById('AddPreciosYPasesForm')

AddActividadesForm.addEventListener('submit',(e)=>{
e.preventDefault();

let datos = new FormData(AddActividadesForm) 
let datos2 = new FormData(AddPreciosYPasesForm)

let clave = datos.get('clave')
let nombre = datos.get('nombre')
let tipoactividades_id = datos.get('tipoactividades_id')
let active=1, remove=0;
let tipounidades_id =0;
let balance = datos2.get('balanceg')
let precio = datos2.get('preciog')

//datos del segundo form PRECIOS ACTIVIDAD-PRECIOS

const personas = document.querySelectorAll('[id^=persona]')


let datosPersonas = [];

personas.forEach(function(persona){ 
  persona={
    precio1: `${datos2.get('p1PersonaId'+persona.getAttribute('data-id'))}`,
    precio2:`${datos2.get('p2PersonaId'+persona.getAttribute('data-id'))}`,
    precio3:`${datos2.get('p3PersonaId'+persona.getAttribute('data-id'))}`,
    doble:`${datos2.get('doblePersonaId'+persona.getAttribute('data-id'))}`,
    doblebalanc: `${datos2.get('balanceDoblePersonaId'+persona.getAttribute('data-id'))} `,
    triple:`${datos2.get('triplePersonaId'+persona.getAttribute('data-id'))} `,
    triplebalanc: `${datos2.get('balanceTriplePersonaId'+persona.getAttribute('data-id'))} `,
    promocion: `${datos2.get('promoPersonaId'+persona.getAttribute('data-id'))} `,
    restriccion: `${datos2.get('restriccionPersonaId'+persona.getAttribute('data-id'))} `,
    acompanante: `${datos2.get('acompanantePersonaId'+persona.getAttribute('data-id'))} `,
    remove: 0,
    active: 1,
    persona_id: persona.getAttribute('data-id')
  }
  
datosPersonas.push(persona)

})
console.log(datosPersonas)


// 'persona_id',
// 'usuarios_id',
// 'pases_id',
// 'actividades_id'


  let fijo;
  if($('#fijo').is(':checked')){
    fijo = 1;
  }else{
    fijo = 0;
  }
  let renta;
  if($('#renta').is(':checked')){
    renta = 1;
  }else{
    renta = 0;
  }

  let minutosincluidos = datos.get('minutosincluidos')
  let minutoincrementa = datos.get('minutoincrementa')
  let montoincremento = datos.get('montoincremento')
  let maxcortesias = datos.get('maxcortesias')
  let maxcupones = datos.get('maxcupones')
  let anticipo_id= datos.get('anticipo_id')
  let idusuario = datos.get('idusuario')
 

  // if($('#active').is(':checked')){
  //   active = 0;
  // }else{
  //   active = 1;
  // }
  // let remove;
  // if($('#remove').is(':checked')){
  //   remove = 0;
  // }else{
  //   remove = 1;
  // }

let route = 'actividades'

$.ajax({
  url:route,
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  type:'POST',
  dataType: 'json',
  data: {clave: clave, nombre: nombre, tipoactividades_id: tipoactividades_id,fijo:fijo,renta:renta,minutosincluidos:minutosincluidos,minutoincrementa:minutoincrementa,montoincremento:montoincremento,maxcortesias:maxcortesias,maxcupones:maxcupones,anticipo_id:anticipo_id,idusuario:idusuario, active:active, remove:remove,tipounidades_id:tipounidades_id,balance:balance, precio:precio,datosPersonas:datosPersonas},
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

btnHora = document.getElementById('btnHora')

btnHora.addEventListener('submit',(e)=>{
e.preventDefault();
})




// add horarios container

const addHorarioContanier = document.getElementById('addHorarioContanier')
const rowContanier = document.getElementById('rowContanier')

addHorarioContanier.addEventListener('click',(e)=>{
  e.preventDefault();

  let container= document.createElement('div')
  container.innerHTML= `
   <div class="container mt-2">
                        <div class="col-2">
                            <h2 class="lead">Horario 1</h2>
                        </div>
                        <div class="row">
                          <div class="col-2 mt-3">
                            <div class="form-group">
                              <label for="">Hora de Inicio:</label>
                              <input type="time" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                          </div>
                         
                          <div class="col-2 mr-5 mt-3">
                            <div class="form-group">
                              <label for="">Hora de Finalización:</label>
                              <input type="time" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                          </div>
                          <div class="col-1 ml-5">
                              <div class="form-group ">
                                  <label for="entregas">Diario Entregas</label>
                                     <input type="checkbox" class="form-control general" name="entrega" id="entrega" value="checkedValue" >
                              </div>
                          </div>
                          <div class="col-5">
                            <div class="container-fluid">
                              <div class="row mt-5 ml-3">
                                <div class="">
                                    <label class="form-check-label font-weight-bolder mr-3 pr-2 pt-1">L
                                      </label>
                                      <input class="form-check-input" type="checkbox" name="" id="" value="checkedValue"> 
                                </div>
                                <div class="ml-3">
                                    <label class="form-check-label font-weight-bolder mr-3 pr-2 pt-1">M
                                      </label>
                                      <input class="form-check-input" type="checkbox" name="" id="" value="checkedValue"> 
                                </div>
                                <div class="ml-3">
                                    <label class="form-check-label font-weight-bolder mr-3 pr-2 pt-1">X
                                      </label>
                                      <input class="form-check-input" type="checkbox" name="" id="" value="checkedValue"> 
                                </div>
                                <div class="ml-3">
                                    <label class="form-check-label font-weight-bolder mr-3 pr-2 pt-1">J
                                      </label>
                                      <input class="form-check-input" type="checkbox" name="" id="" value="checkedValue"> 
                                </div>
                                <div class="ml-3">
                                    <label class="form-check-label font-weight-bolder mr-3 pr-2 pt-1">V
                                      </label>
                                      <input class="form-check-input" type="checkbox" name="" id="" value="checkedValue"> 
                                </div>
                                <div class="ml-3">
                                    <label class="form-check-label font-weight-bolder mr-3 pr-2 pt-1">S
                                      </label>
                                      <input class="form-check-input" type="checkbox" name="" id="" value="checkedValue"> 
                                </div>
                                <div class="ml-3">
                                    <label class="form-check-label font-weight-bolder mr-3 pr-2 pt-1">D
                                      </label>
                                      <input class="form-check-input" type="checkbox" name="" id="" value="checkedValue"> 
                                </div>
                              </div>
                            </div>
                              
                            </div>
                          </div>
                          <div class="row mt-3">
                              <div class="col-2">
                                 <h2 class="lead">Recolecciones</h2>
                              </div>
                             
                          </div>
                          <div class="row">
                              <div class="col-2">
                                <div class="form-group">
                                  <label for="">Punto 1</label>
                                  <select class="form-control" name="" id="">
                                    <option></option>
                                    <option></option>
                                    <option></option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-2">
                                <div class="form-group">
                                  <label for="">Hora</label>
                                  <input type="time" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                </div>
                                
                              </div>
                              <div class="col-1 d-inline mt-4 pt-1">
                                  <button type="submit" class="btn btn-secondary d-inline" id="btnHora">+</button>
                                </div>
  
  
                                <div class="col-2">
                                  <div class="form-group">
                                    <label for="">Punto 1</label>
                                    <select class="form-control" name="" id="">
                                      <option></option>
                                      <option></option>
                                      <option></option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-group">
                                    <label for="">Hora</label>
                                    <input type="time" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                                  </div>
                                  
                                </div>
                                <div class="col-1 d-inline mt-4 pt-1">
                                    <button type="submit" class="btn btn-secondary d-inline" id="btnHora">+</button>
                                  </div>
                            </div>
  
                          
                            
                        </div> 

  `;
  rowContanier.appendChild(container);
 

})

