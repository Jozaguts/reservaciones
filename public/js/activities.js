

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

// btnHora = document.getElementById('btnHora')

// btnHora.addEventListener('submit',(e)=>{
// e.preventDefault();
// })




// add horarios container

const addHorarioContanier = document.getElementById('addHorarioContanier')
const rowContanier = document.getElementById('rowContanier')
let contador=2;
function addHoraioContainer(){
  // addHorarioContanier.addEventListener('click',(e)=>{
   
  //   e.preventDefault();
  
    let container= document.createElement('div')
    container.classList = "contanier";
    container.innerHTML= `<div class="h-divider">
    </div>
    <div class="row">
      <div class="col-12 mb-3"> Horario ${contador}</div>
      <div class="col-6">
        <div class="row">
          <div class="col-4">
              <div class="form-group">
                  <label for="">Hora de Inicio:</label>
                  <input type="time" name="horainicio${contador}" id="horainicio ${contador}" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
          </div>
          <div class="col-4">
              <div class="form-group">
                  <label for="">Hora de Finalización:</label>
                  <input type="time" name="horafin${contador}" id="horafin${contador}" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="row mt-3">
            <div class="col-3 ml-1 ">
                <div class="form-group float-left">
                    <label class="form-check-label lbcheck">
                      <input class="form-check-input sizecheck general " type="checkbox" name="entrega${contador}" id="entrega${contador}" value="1" onchange="diarioEntrega(this);" data-id="22" checked>Diario
                    </label>
                  </div>
            </div>
            <div class="col-8 ">
                          <div class="container">
                              <div class="row">
                                <div class="">
                                    <label class="form-check-label font-weight-bolder mr-3 pr-2 pt-1">L
                                      </label>
                                      <input class="form-check-input diarioEntrega22 sizecheck" type="checkbox" name="dial${contador}" id="dial${contador}" value="1" checked> 
                                </div>
                                <div class="ml-3">
                                    <label class="form-check-label font-weight-bolder mr-3 pr-2 pt-1">M
                                      </label>
                                      <input class="form-check-input diarioEntrega22 sizecheck" type="checkbox" name="diam${contador}" id="diam${contador}" value="1" checked> 
                                </div>
                                <div class="ml-3">
                                    <label class="form-check-label font-weight-bolder mr-3 pr-2 pt-1">X
                                      </label>
                                      <input class="form-check-input diarioEntrega22 sizecheck" type="checkbox" name="diax${contador}" id="diax${contador}" value="1" checked> 
                                </div>
                                <div class="ml-3">
                                    <label class="form-check-label font-weight-bolder mr-3 pr-2 pt-1">J
                                      </label>
                                      <input class="form-check-input diarioEntrega22 sizecheck" type="checkbox" name="diaj${contador}" id="diaj${contador}" value="1" checked> 
                                </div>
                                <div class="ml-3">
                                    <label class="form-check-label font-weight-bolder mr-3 pr-2 pt-1">V
                                      </label>
                                      <input class="form-check-input diarioEntrega22 sizecheck" type="checkbox" name="diav${contador}" id="diav${contador}" value="1"checked> 
                                </div>
                                <div class="ml-3" >
                                    <label class="form-check-label font-weight-bolder mr-3 pr-2 pt-1">S
                                      </label>
                                      <input class="form-check-input diarioEntrega22 sizecheck" type="checkbox" name="dias${contador}" id="dias${contador}" value="1" checked> 
                                </div>
                                <div class="ml-3">
                                    <label class="form-check-label font-weight-bolder mr-3 pr-2 pt-1">D
                                      </label>
                                      <input class="form-check-input diarioEntrega22 sizecheck" type="checkbox" name="diad${contador}" id="diad${contador}" value="1" checked> 
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
          <div class="col-6">  <h2 class="lead">Recolecciones</h2></div>
          <div class="col-6">  <h2 class="lead">Entregas</h2></div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-6" >
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                      <label for="" data-punto="${contador}">Punto ${contador}</label>
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
                      <a href="#!" class="btn btn-secondary d-inline" id="primarybtnHora${contador}" onclick="addpunto(this);">+</a>
                    </div>
            </div>
            </div>
            <div class="col-6">
                <div class="row">
                  <div class="col-4">
                      <div class="form-group">
                        <label for="" data-punto="${contador}">Punto ${contador}</label>
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
                        <a href="#!" class="btn btn-secondary d-inline" id="secondarybtnHora${contador}" onclick="addpunto(this);">+</a>
                      </div>
                    </div>
                </div>
    </div>

  
    `;
    rowContanier.appendChild(container);

    contador++;
   
  
//   })
}



let countRecolecion=2;
function addpunto(e){

  let parent = e.parentElement.parentElement;
  let numPunto = parent.children[0].children[0].children[0].getAttribute('data-punto');
  let intNumPunto = parseInt(numPunto)+1;
  console.log(parent.children[0].children[0].children[0].getAttribute('data-punto'));

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
      </div>
      
    </div>  
  `;

parent.appendChild(row);
intNumPunto++;
countRecolecion++;
}


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