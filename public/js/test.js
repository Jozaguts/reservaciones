
let editar = false;
let horarioLibreEdita ="", salidaId="",llegadaId="";
let ACTIVIDADid;
let HID = [];



// mostrar contenido de los boones
showContent = function (e){
  e.nextSibling.nextSibling.classList.contains('d-none')?e.nextSibling.nextSibling.classList.toggle('show')&&e.nextSibling.nextSibling.classList.remove('d-none'):e.nextSibling.nextSibling.classList.add('d-none')
}


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
    // let fijo = document.getElementById('fijo')
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

let checkemptycontador =0;
generalInputs.forEach((input)=>{
  if(input.value.length>0){
    
    checkemptycontador++;

   return checkemptycontador;
  } 
  
  })
 if(checkemptycontador>2){
  let confirmar = confirm('No has Guardado los Cambios, ¿Deseas Continuar?')
  if(confirmar==true){
    $('#addActivities').modal('hide');
    $(this).find('form').trigger('reset');
    setTimeout("location.reload(true);",1000)
  }else{

  }
 
 }else{
  $('#addActivities').modal('hide');
 }
 let allCheckbox = document.querySelectorAll('[class~=check-clean]')

 allCheckbox.forEach(function(check){
 check.removeAttribute("unchecked");
 check.removeAttribute("checked");
 })
 
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
  let diarioEntrega0 = document.querySelectorAll('.diarioEntrega0');
  
  diarioEntrega0.forEach(function(check){
    check.disabled = false;
  })
// duracion.disabled = false;
// entrega.disabled = false;
// entrega.checked=false;
$('#hiniHorarioLibre').prop('disabled', false);
$('#hfinHorarioLibre').prop('disabled', false);
disabledHOrarioMultiple();
salidas.disabled = false;
llegadas.disabled = false;
checkDiario.disabled =false;

// checks horarios
const id = e.target.getAttribute('data-id')

const checkboks = document.querySelectorAll(`input[class*="diarioEntrega${id}"]`)
checkboks.forEach(function(checkbox){
  checkbox.checked = false;
  checkbox.disabled = false;
  })
}else{

  let diarioEntrega0 = document.querySelectorAll('.diarioEntrega0');
  diarioEntrega0.forEach(function(check){
    check.disabled = true;
  })
// duracion.disabled = true;
// entrega.disabled = true;
enableddHOrarioMultiple();
salidas.disabled = true;
llegadas.disabled = true;
checkDiario.disabled =true;
$('#hiniHorarioLibre').prop('disabled', true);
$('#hfinHorarioLibre').prop('disabled', true);
  // checks horarios
  const id = e.target.getAttribute('data-id')
 
  const checkboks = document.querySelectorAll(`input[class*="diarioEntrega${id}"]`)
  checkboks.forEach(function(checkbox){
    checkbox.checked = false;
    checkbox.disabled = true;
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
        $('#addHorarioContanier').addClass('btn-secondary');
      
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
        item.classList.remove('btn-secondary')
        $('#addHorarioContanier').addClass('btn-primary ');
       
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
let contador=0;

let salidasDOM;
const xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function(){
    if(this.readyState==4 && this.status == 200)
    salidasDOM = JSON.parse(xhr.responseText);
  }

xhr.open('GET','/salidasllegadas',false)
xhr.send();

let salidasyllegadas = salidasDOM.salidasLlegadas; 

function addHoraioContainer(){
  

  contador++;
  let container= document.createElement('div')
  container.classList = "contanier";
  container.innerHTML= `
  <div class="container horarios punto-container" data-puntoid="0" > 
  <input type="hidden" class="h-id" data-id="0"> 
 
  <div class="h-divider">
  </div>
  <div class="row">
    <div class="col-12"> 
      <a href="#!" class="btn btn-danger float-right bnt-eliminar" onclick="cancelHorario(this)">X 
      </a>
    </div>
    <div class="col-4">
    <label class="lead titulo-horario-multiple HID" data-identificadores="${contador}" id="horarioId${contador}" data-hid="0">Horario ${contador} </label>
    </div>
  </div>
  <div class="row">
                            
  <div class="col-6">
    <div class="row">
      <div class="col-4">
          <div class="form-group">
              <label for="">Hora de Inicio:</label>
              <input type="time" name="horainicio${contador}" id="horainicio${contador}" class="form-control horario-multiple listener-hora-ini" placeholder="" aria-describedby="helpId" data-id="0" data-horarioid="${contador}" required>
            </div>
      </div>
      <div class="col-4">
          <div class="form-group">
              <label for="">Hora de Finalización:</label>
              <input type="time" name="horafin${contador}" id="horafin${contador}" class="form-control horario-multiple listener-hora-fin" placeholder="" aria-describedby="helpId" data-id="0" data-horarioid="${contador}" required onchange="validarHoraFin(this)">
              <small class="text-danger" id="labelSmall${contador}" data-labelid="${contador}"></small>
            </div>
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="row mt-3">
        <div class="col-3 ml-1 ">
            <div class="form-group float-left">

            <div class="content">
            <label class="form-check-label lbcheck">Diario</label>
            <input class="  sizecheck general " type="checkbox" name="checkdiario${contador}" id="checkdiario${contador}" value="1" onchange="diarioEntrega(this);" data-id="${contador}" >
          </div>
              
              </div>
        </div>
    <div class="col-8 ">
      <div class="container">
          <div class="row">
            <div class="">
                <label class="form-check-label font-weight-bolder  ">L
                  </label>
                  <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="dial${contador}" id="dial${contador}" value="1" checked data-horarioid="${contador}" data-HID="0"> 
            </div>
            <div class="ml-3">
                <label class="form-check-label font-weight-bolder  ">M
                  </label>
                  <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diam${contador}" id="diam${contador}" value="1" checked data-horarioid="${contador}" data-HID="0"> 
            </div>
            <div class="ml-3">
                <label class="form-check-label font-weight-bolder  ">X
                  </label>
                  <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diax${contador}" id="diax${contador}" value="1" checked data-horarioid="${contador}" data-HID="0"> 
            </div>
            <div class="ml-3">
                <label class="form-check-label font-weight-bolder">J
                  </label>
                  <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diaj${contador}" id="diaj${contador}" value="1" checked data-horarioid="${contador}" data-HID="0"> 
            </div>
            <div class="ml-3">
                <label class="form-check-label font-weight-bolder " >V
                  </label>
                  <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diav${contador}" id="diav${contador}" value="1"checked data-horarioid="${contador}" data-HID="0"> 
            </div>
            <div class="ml-3" >
                <label class="form-check-label font-weight-bolder " >S
                  </label>
                  <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="dias${contador}" id="dias${contador}" value="1" checked data-horarioid="${contador}" data-HID="0"> 
            </div>
            <div class="ml-3">
                <label class="form-check-label font-weight-bolder">D
                  </label>
                  <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diad${contador}" id="diad${contador}" value="1" checked data-horarioid="${contador}"  data-HID="0"> 
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
        <div class="col-6">  <h2 class="lead">Salidas <span id="salidaError"></span></h2>  </div>
        <div class="col-6">  <h2 class="lead">Llegadas <span id="llegadaError"></span> </h2></div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-6" >
      <div class="row">
          <div class="col-4">
              <div class="form-group">
                <label for="" data-punto="1";>Punto 1</label>
                <select class="form-control horario-multiple select-multiple__salidas" name="salidas${contador}" id="salidas${contador}" data-id="0" data-horarioid="${contador}" onchange="validarPuntosSalida()" data-puntoid="0" data-identificadores="${contador}">
              
                  </select>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="">Hora</label>
                <input type="time" class="form-control horario-multiple hora-salida" name="salidahora${contador}" id="salidahora${contador}" data-id="0" data-horarioid="${contador}" aria-describedby="helpId" placeholder="" onchange=" ValidaHoraSalida(this);"  data-puntoid="0" data-identificadores="${contador}">
                <small class="text-danger" id="labelSmallSalida${contador}"></small>
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
            <select class="form-control horario-multiple select-multiple__llegadas" name="llegadas${contador}" id="llegadas${contador}" data-id="0" data-horarioid="${contador}" onchange="validarPuntosLlegada()"  data-puntoid="0" data-identificadores="${contador}">
            </select>
          </div>
        </div>
        <div class="col-4">
          <div class="form-group">
            <label for="">Hora</label>
            <input type="time" class="form-control horario-multiple hora-llegada" name="llegadahora${contador}" id="llegadahora${contador}" data-id="0" data-horarioid="${contador}" aria-describedby="helpId" placeholder="" onchange="ValidaHoraLlegada(this)"  data-puntoid="0" data-identificadores="${contador}">
            <small class="text-danger" id="labelSmall${contador}" data-labelid="${contador}"></small>
          </div>
          
        </div>
        <div class="col-4 d-inline mt-4 pt-1">
            <a href="#!" class="btn btn-secondary d-inline horario-multiple" id="secondarybtnHora${contador}" onclick="addpuntoLLEGADAS(this);">+</a>
          </div>
        </div>
    </div>
  </div>
  </div>

  `;
  rowContanier.innerHTML = "";
  rowContanier.appendChild(container);
  /*SELECT SALIDAS
  *
  *
  * la peticion xhr esta de forma sincrona por eso el retardo al abrir el nuevo horario se peude mejorar con fetch
  */
  let selectsSalidasLegadas = document.querySelectorAll('[id^="salidas"]')
  let selectsSalidasLegadas__llegadas = document.querySelectorAll('[id^="llegadas"]')
   selectsSalidasLegadas = Array.from(selectsSalidasLegadas)
   selectsSalidasLegadas__llegadas = Array.from(selectsSalidasLegadas__llegadas)

 
  
  for (let i = 0; i < salidasyllegadas.length; i++) {
    let option = document.createElement('option');
    option.value = salidasyllegadas[i].id
    option.innerHTML =salidasyllegadas[i].nombre;
    
    
    selectsSalidasLegadas.forEach(function(select){
      select.appendChild(option)
    })
  }
   
  for (let i = 0; i < salidasyllegadas.length; i++) {
    let option = document.createElement('option');
    option.value = salidasyllegadas[i].id
    option.innerHTML =salidasyllegadas[i].nombre;
    
    
    selectsSalidasLegadas__llegadas.forEach(function(select){
      select.appendChild(option)
    })
  }

}


// Borrar horario de HORARIOS MULTIPLES
// cancelar horario function
function cancelHorario(e){
    if(confirm('¿Eliminar Horario?')){
      e.parentElement.parentElement.parentElement.remove();
      contador--;
    }
  }


//   AGREGAR Y REMOVER PUNTO DE  SALIDA EN HORARIOS MULTIPLES

let countRecolecion=2;
function addpunto(e){
  
  let idpuntohorario = e.parentElement.parentElement.children[0].children[0].children[1].getAttribute('data-puntoid')

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
      <select class="form-control horario-multiple select-multiple__salidas" name="salidas${intNumPunto}" id="salidas${intNumPunto}" data-id="0" data-horarioid="${idpuntohorario}" onchange="validarPuntosSalida()" data-puntoid="0" data-identificadores="${intNumPunto}">
                                          
      </select>
    </div>
  </div>
  <div class="col-4">
    <div class="form-group">
      <label for="">Hora</label>
      <input type="time" class="form-control hora-salida" name="salidahora${intNumPunto}" id="salidahora${intNumPunto}" data-id="0" data-horarioid="${intNumPunto}" aria-describedby="helpId" placeholder="" data-puntoid="0" data-identificadores="${intNumPunto}">
    </div>
    
  </div>
  <div class="col-4 d-inline mt-4 pt-1">
      <a href="#!" class="btn btn-secondary d-inline" id="secondarybtnHora1" onclick="addpunto(this);"> +</a>
      <a href="#!" class="btn btn-danger d-inline horario-multiple" id="primarybtnHora${contador+1}" onclick="removepunto(this);" data-puntoid="0">-</a>
    </div>
    
  </div>  
`;

parent.appendChild(row);
intNumPunto++;
countRecolecion++;

let selectsSalidasLegadas = document.querySelectorAll('[id^="salidas"]')

   selectsSalidasLegadas = Array.from(selectsSalidasLegadas)
  for (let i = 0; i < salidasyllegadas.length; i++) {
    let option = document.createElement('option');
    option.value = salidasyllegadas[i].id
    option.innerHTML =salidasyllegadas[i].nombre;
    
    
    selectsSalidasLegadas.forEach(function(select){
      select.appendChild(option)
    })
  }
}

// funcion remover punto
function removepunto(e){
e.parentElement.parentElement.remove();
countRecolecion--;

}


//######################################################################################
//   AGREGAR Y REMOVER PUNTO DE  LLEGADAS EN HORARIOS MULTIPLES

let countRecolecionLLEGADAS=2;
function addpuntoLLEGADAS(e){

let parent = e.parentElement.parentElement;
let numPunto = parent.children[0].children[0].children[0].getAttribute('data-punto');
let intNumPunto = parseInt(numPunto)+1;

let row = document.createElement('div');

row.classList ="container";
row.innerHTML=`

<div class="row">
<div class="col-4">
    <div class="form-group">
      <label for="" data-punto="${countRecolecionLLEGADAS}">Punto ${countRecolecionLLEGADAS}</label>
      <select class="form-control horario-multiple select-multiple__llegadas" name="llegadas${intNumPunto}" id="llegadas${intNumPunto}" data-id="0"  data-horarioid="${intNumPunto}" onchange="validarPuntosLlegada()"
      data-puntoid="0" data-identificadores="${intNumPunto}">
      </select>
    </div>
  </div>
  <div class="col-4">
    <div class="form-group">
      <label for="">Hora</label>
      <input type="time" class="form-control hora-llegada" name="llegadahora${intNumPunto}" id="llegadahora${intNumPunto}"  data-horarioid="${intNumPunto}" aria-describedby="helpId" placeholder="" data-puntoid="0" data-identificadores="${contador}">
    </div>
    
  </div>
  <div class="col-4 d-inline mt-4 pt-1">
      <a href="#!" class="btn btn-secondary d-inline" id="secondarybtnHora1" onclick="addpuntoLLEGADAS(this);"> +</a>
      <a href="#!" class="btn btn-danger d-inline horario-multiple" id="primarybtnHora${intNumPunto}" onclick="removepuntoLLEGADAS(this);" >-</a>
    </div>
    
  </div>  
`;

parent.appendChild(row);
intNumPunto++;
countRecolecionLLEGADAS++;

  let selectsSalidasLegadas__llegadas = document.querySelectorAll('[id^="llegadas"]')
  
   selectsSalidasLegadas__llegadas = Array.from(selectsSalidasLegadas__llegadas)

 
  

   
  for (let i = 0; i < salidasyllegadas.length; i++) {
    let option = document.createElement('option');
    option.value = salidasyllegadas[i].id
    option.innerHTML =salidasyllegadas[i].nombre;
    
    
    selectsSalidasLegadas__llegadas.forEach(function(select){
      select.appendChild(option)
    })
  }


}

// funcion remover punto
function removepuntoLLEGADAS(e){
e.parentElement.parentElement.remove();
countRecolecionLLEGADAS--;

}
//######################################################################################

// AJAX ##########################################################################

    // #############################################################################################PESTAÑA 1 INICIO
let AddActividadesForm = document.getElementById('AddActividadesForm');
AddActividadesForm.addEventListener('submit',(e)=>{
    e.preventDefault();

    // ###### VALIDACIONES #####
     
      let hidNuevo = document.querySelectorAll('input[class*="h-id"]')
     
      hidNuevo.forEach(function(HIDnuevo){
        HID.push(Number(HIDnuevo.getAttribute('data-id')) )
      })
     let SetID = new Set(HID)
     let ArrayHID = Array.from(SetID)
    
      validarPuntosSalida();  
      validarPuntosLlegada();

      let inputHoraIni = document.querySelectorAll('.listener-hora-ini');
      let inputHoraFin = document.querySelectorAll('.listener-hora-fin');
      let validator = new  ValidarInputTime();
      validator.HoraInicio(inputHoraIni);
      validator.HoraFin(inputHoraFin)
      errores ();
      
      let puntosSalidaHmultiple = getPuntosSalidas();
      let puntosLlegadasHMultiple = getPuntosLlegadas();
  
     

      // #####
    let datos = new FormData(AddActividadesForm) 
    let clave = datos.get('clave')
    let nombre = datos.get('nombre')
    let active=1;
    let remove=0;
    let tipoUnidadId = document.getElementById('tipoactividades_id').value; //tipo de unidad
    let tipoactividadesid = document.querySelector(':checked').getAttribute('data-tipoactividad');        
    let duracion = datos.get('duracion')
    let minutoincrementa = datos.get('minutoincrementa')
    let montoincremento = datos.get('montoincremento')
    let maxcortesias = datos.get('maxcortesias')
    let maxcupones = datos.get('maxcupones')
    let anticipoid= datos.get('anticipo_id')
    let idusuario = datos.get('idusuario')
    let checkFijo = datos.get('fijo')
    let fijoValue;
    if(checkFijo==null){
      fijoValue=0;
    }else{
      fijoValue=1;
    }
    let checkRenta = datos.get('renta')
    let rentaValue;
    if(checkRenta==null){
      rentaValue=0;
    }else{
      rentaValue=1;
    }
      // ############################################################################################### PESTAÑA 1 FIN

    //  INICIO PESTAÑA 2 ############################################################################################
    let AddPreciosYPasesForm = document.getElementById('AddPreciosYPasesForm')
    let datos2 = new FormData(AddPreciosYPasesForm)
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
      //  FIN PESTAÑA 2 ############################################################################################

    // ########################################################################################### PESTAÑA 3 INICIO

    let libre,hfinHorarioLibre,hiniHorarioLibre
  
    if($('#libre').is(':checked')){
      libre = 1;
    }else{
      libre = 0;
    }
    let addHorariosYPuntos = document.getElementById('addHorariosYPuntos');
    let datos3 = new FormData(addHorariosYPuntos)
    const d3CheckLibre = datos3.get('libre');
    const diasSeleccionados = [];
      if(d3CheckLibre == 1 ){
        hiniHorarioLibre = $('#hiniHorarioLibre').val();
        hfinHorarioLibre = $('#hfinHorarioLibre').val();    
        let  diario;
    diario = document.getElementById('diario')
        if(diario.checked){
    let l={dia: "l", activado: "1"}, m={dia: "m", activado: "1"}, x={dia: "miercoles",activado: "1"},j={dia: "jueves",activado: "1"},v={dia: "viernes",activado: "1"},s={dia: "sabado",activado: "1"},d={dia: "domingo",activado: "1"}
    diasSeleccionados.push(l,m,x,j,v,s,d);
    }
    else{
    let id = diario.getAttribute('data-id')
    let diasDisponibles = document.querySelectorAll(`.diarioEntrega${id}`)
    diasDisponibles.forEach(function(diaDisponible){
      if(diaDisponible.checked){
        dia= {dia: `${diaDisponible.getAttribute('name')}`, activado: "1"}
        diasSeleccionados.push(dia)
      }else{
        dia= {dia: `${diaDisponible.getAttribute('name')}`, activado: "0"}
        diasSeleccionados.push(dia)
      }
    
    })
      
      }
      
    }
            if(diario.checked){
        let l={dia: "l", activado: "1"}, m={dia: "m", activado: "1"}, x={dia: "miercoles",activado: "1"},j={dia: "jueves",activado: "1"},v={dia: "viernes",activado: "1"},s={dia: "sabado",activado: "1"},d={dia: "domingo",activado: "1"}
        diasSeleccionados.push(l,m,x,j,v,s,d);
        }
        else{
        let id = diario.getAttribute('data-id')
        let diasDisponibles = document.querySelectorAll(`.diarioEntrega${id}`)
        diasDisponibles.forEach(function(diaDisponible){
          if(diaDisponible.checked){
            dia= {dia: `${diaDisponible.getAttribute('name')}`, activado: "1"}
            diasSeleccionados.push(dia)
          }else{
            dia= {dia: `${diaDisponible.getAttribute('name')}`, activado: "0"}
            diasSeleccionados.push(dia)
          }
        
        })
      
      }
      // duracion = datos3.get('duracion')
    const salidaFijo = document.getElementById('salidas').value;
    const llegadasFijo = document.getElementById('llegadas').value;
        // ########################################################################################### PESTAÑA 3 FIN


        //############################################################################################ HORARIO MULTIPLE INICIO

        const horasInicio = document.querySelectorAll('[id^="horainicio"]');
        const horasFin = document.querySelectorAll('[id^="horafin"]');
        // const salidas = document.querySelectorAll('[id^="salidas"]');
        const salidasSeleccionadas = [];
        // const llegadas = document.querySelectorAll('[id^="llegadas"]');
        const llegadasSelecciondas = [];
        const diasMultiplesSeleccionados = document.querySelectorAll('.horario-multiple__dia');
      
      
        const identificadores = document.querySelectorAll('[id^="horarioId"]');
        let vueltas =diasMultiplesSeleccionados.length;

        class Horarios{
          constructor(hini,hfin,dias,id){
        this.hini=hini;
        this.hfin=hfin;
        this.dias=dias;
        // this.salidas=salidas
        // this.llegadas=llegadas;
        this.identificadores=identificadores;
        }
      }
      /*  Se filtran los dias */
      class FiltroDias{
        constructor(id,dias){
          this.id=id;
          this.dias=dias;
          dias = Array.from(dias);
          let diasFiltrados = dias.filter(function(dia){
            
            return dia.getAttribute('data-horarioid') == id;
          }).map(function(dia){
        
           
             return dia.checked?1:0;
          })
          return diasFiltrados;
        }
      }
      class FiltrIDs{
        constructor(id,dias){
          this.id=id;
          this.dias=dias;
          dias = Array.from(dias);
          let diasFiltrados = dias.filter(function(dia){
            
            return dia.getAttribute('data-horarioid') == id;
          }).map(function(dia){
        
           
             return dia.getAttribute('data-HID');
          })
          return diasFiltrados;
        }
      }
      let ArrayDeIds =[];
      for (let i = 0; i < identificadores.length; i++) {
       
        let dias = new FiltrIDs(i+1,diasMultiplesSeleccionados)
       
        ArrayDeIds.push(dias)
    
      }


      
      /* Termina el filtrado de dias*/
      //#### se genera un array con los dias ya separados por hoarios
      let ArrayDeDIas =[];
      for (let i = 0; i < identificadores.length; i++) {
       
        let dias = new FiltroDias(i+1,diasMultiplesSeleccionados)
       
        ArrayDeDIas.push(dias)
    
      }
      ArrayDeDIas.push(ArrayDeIds)
      
    
     
      
      //####//aqui ya tengo todos los horarios separados FIN####
      // se filtran las horas de inicio de cada horario
      class HorasInicio {
        constructor(id,hini){
          this.hini= hini;
          this.id=id;

          hini=Array.from(hini);
          let arrayHorasInicio = hini.filter(function(hr){
            return hr.getAttribute('data-horarioid') ==id;
          }).map(function(hr){
            return hr.value;
          })
          return arrayHorasInicio
        }
      }
      
      let ArrayHini =[];
      for (let i = 0; i < identificadores.length; i++) {
        let hini = new HorasInicio(i+1,horasInicio)
        
        ArrayHini.push(hini)
      }
      // se filtran las horas de inicio de cada horario FIN####
      class HorasFin{
        constructor(id,hfin){
          this.hfin= hfin;
          this.id=id;

          hfin=Array.from(hfin);
          let arrayHorasFin = hfin.filter(function(hr){
            return hr.getAttribute('data-horarioid') ==id;
          }).map(function(hr){
            return hr.value;
          })
          return arrayHorasFin
        }
      }
      
      let ArrayHrFin =[];
      for (let i = 0; i < identificadores.length; i++) {
        let hfin = new HorasFin(i+1,horasFin)
        ArrayHrFin.push(hfin)
      }
      // ## puntos de salida ##
        const puntosSalida = document.querySelectorAll('.select-multiple__salidas');
     
      class PuntosSalida{
          constructor(id,puntos){
            this.puntos= puntos;
            this.id=id;
  
            puntos=Array.from(puntos);
            let arraypuntos = puntos.filter(function(punto){
              return punto.getAttribute('data-horarioid') ==id;
            }).map(function(punto){
              return punto.value;
            })
            return arraypuntos
          }
        }
        let arrayPuntosSalida =[];
      for (let i = 0; i < identificadores.length; i++) {
        let puntos = new PuntosSalida(i+1,puntosSalida)
     
        arrayPuntosSalida.push(puntos)
      }
     
       // ## puntos de salida ##
       const puntosllegadas = document.querySelectorAll('.select-multiple__llegadas');
       class PuntosLlegadas{
           constructor(id,puntos){
             this.puntos= puntos;
             this.id=id;
   
             puntos=Array.from(puntos);
             let arraypuntos = puntos.filter(function(punto){
               return punto.getAttribute('data-horarioid') ==id;
             }).map(function(punto){
               return punto.value;
             })
             return arraypuntos
           }
         }
         
         let arrayPuntosLlegada =[];
       for (let i = 0; i < identificadores.length; i++) {
         let puntos = new PuntosLlegadas(i+1,puntosllegadas)
         arrayPuntosLlegada.push(puntos)
       }
      
          //HORAS
        //  #### SALIDAS #####
        let horasSalidas = document.querySelectorAll('.hora-salida')
        let horasLlegada = document.querySelectorAll('.hora-llegada')

        class HorasLlegadas{
        constructor(id,horas){
          this.horas= horas;
          this.id=id;

          horas=Array.from(horas);
          let arrayHoras = horas.filter(function(hora){
            return hora.getAttribute('data-horarioid') == id;
          }).map(function(hora){
            return hora.value;
          })
          return arrayHoras
        }
      }
        let arrayHorasLlegada =[];
        for (let i = 0; i < identificadores.length; i++) {
          let llegada = new HorasLlegadas(i+1,horasLlegada)
          arrayHorasLlegada.push(llegada)
        }

        let arrayHorasSalida =[];
        for (let i = 0; i < identificadores.length; i++) {
        let salida = new HorasLlegadas(i+1,horasSalidas)
        arrayHorasSalida.push(salida)
       }
        //############################################################################################ HORARIO MULTIPLE FIN

        // PESTAÑA 4 INICIO
        const formGenerales = document.getElementById('formGenerales')
        const datos4 = new FormData(formGenerales)
        let riesgo = datos4.get('riesgo')
        if(riesgo==null){
          riesgo =0;
        }else if(riesgo.checked){
          riesgo =1;
        }
        let puntos = datos4.get('puntos')
        let requisito = datos4.get('requisito')
        let observaciones = datos4.get('observaciones')
        
          let route
        
          let metodo;
         
          if(editar == true ){
          route = `actividades/${ACTIVIDADid}`;
          metodo = "PUT";
          horarioLibreEdita = document.getElementById('salidas').getAttribute('data-horarioid')
          salidaId = document.getElementById('salidas').getAttribute('data-salidaId')
          llegadaId = document.getElementById('llegadas').getAttribute('data-llegadaId')
         
        

          }else{
            route = "actividades";
            metodo = 'POST'
          }
       
 
          
          // route = "actividades";
          let dat = prueba();
          if(error == true){
            $('#errorsIntoModal').html('Corriga los Campos De Horarios Multiples');
                    $('#message-errorIntoModal').fadeIn();
                    setTimeout(() => {
                      $('#message-errorIntoModal').fadeOut();
                    }, 3000);
          }else{
            $.ajax({
              url:route,
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              type:`${metodo}`,
              dataType: 'json',
              data: {
                  clave: clave,
                  nombre: nombre,
                  active:active,
                  remove:remove,
                  tipoactividades_id: tipoactividadesid,
                  tipounidades_id:tipoUnidadId,
                  fijo:fijoValue,
                  renta:rentaValue,
                  duracion:duracion,
                  minutoincrementa:minutoincrementa,
                  montoincremento:montoincremento,
                  maxcortesias:maxcortesias,
                  maxcupones:maxcupones,
                  anticipo_id:anticipoid,
                  idusuario:idusuario,
                  precio: precio,
                  balance:balance,
                  libre:libre,
                  datosPersonas:datosPersonas,
                  diasSeleccionados:diasSeleccionados,
                  salidas:salidaFijo,
                  llegadas:llegadasFijo,
                  riesgo:riesgo,
                  puntos:puntos,
                  requisito:requisito,
                  observaciones:observaciones,
                  ArrayDeDIas:ArrayDeDIas,
                  ArrayHrFin:ArrayHrFin,
                  ArrayHini:ArrayHini,
                  arrayHorasLlegada:arrayHorasLlegada,
                  arrayHorasSalida:arrayHorasSalida,
                  arrayPuntosLlegada:arrayPuntosLlegada,
                  arrayPuntosSalida:arrayPuntosSalida,
                  actividadid:ACTIVIDADid,
                  horariosId:ArrayHID,
                  puntosSalidaHmultiple:puntosSalidaHmultiple,
                  puntosLlegadasHMultiple:puntosLlegadasHMultiple,
                  datosarray: dat,
                  hiniHorarioLibre:hiniHorarioLibre,
                  hfinHorarioLibre:hfinHorarioLibre,
                  horarioLibreId:horarioLibreEdita,
                  salidaId:salidaId,
                  llegadaId:llegadaId
              },
      
              success: function (data) {
              
              
                if(data.error == 'true'){
                  // data.errors.forEach(()=>{})
                  
                  $('#errorsIntoModal').html(data.errors);
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
                    // setTimeout("location.reload(true);",3000)
                }
              }
              
              
              })
          }

             
          
         
        
        
        
  })



    
   



// AJAX ##########################################################################


let IDACTIVIDAD;

// Editar ajax
function editarActividad(e){
  
  let HORARIOID;
  editar = true;


  ACTIVIDADid = e.getAttribute('data-id')
   $('#clave').prop('disabled',true); 

  const id =  e.parentElement.parentElement.getAttribute('data-id')

  IDACTIVIDAD = id;
  const route =`actividades/${id}/edit`;

  $.get(route, function(data){

    $('#clave').val(data.pestana1.actividades[0].clave)
    $('#nombre').val(data.pestana1.actividades[0].nombre)
    data.pestana1.actividades[0].libre == 1 ?  $('#libre').prop('checked', true) :$('#libre').prop('checked', false)
   
    //
    let tipoActividad = document.getElementById('tipoactividades_id')
    tipoActividad.selectedIndex = data.pestana1.actividades[0].taid -1;
    let checkFijo = document.getElementById('fijo')
    if(data.pestana1.actividades[0].fijo ==1){
      checkFijo.checked = true;
    }
    let checkDuracion = document.getElementById('duracion')
    checkDuracion.value = data.pestana1.actividades[0].duracion;

    let checkRenta = document.getElementById('renta')
    if(data.pestana1.actividades[0].renta ==1){
      checkRenta.checked = true;
    }
    let minutoIncrementa = document.getElementById('minutoIncrementa')
    minutoIncrementa.value= data.pestana1.actividades[0].minutoincrementa;

    let montoIncremento = document.getElementById('montoIncremento')
    montoIncremento.value = data.pestana1.actividades[0].montoincremento
    let maxCortesias = document.getElementById('maxCortesias')
    maxCortesias.value = data.pestana1.actividades[0].maxcortesias;
    let maxCupones = document.getElementById('maxCupones')
    maxCupones.value = data.pestana1.actividades[0].maxcupones;
    let anticipoId = document.getElementById('anticipoId')
     anticipoId.selectedIndex =data.pestana1.actividades[0].anid -1;

  // PESTAÑA 2
    // balances
    let balanceG = document.getElementById('balanceG')
    
    balanceG.value = Math.round(Number(data.pestana2.balances[0].balance));
    let precioG = document.getElementById('precioG')
    precioG.value =  Math.round(Number(data.pestana2.balances[0].precio));
   
    // precios
    let precios = data.pestana2.precios;
 
    // PERSONA 1
    let personaPrecio1Id = document.getElementById(`persona${precios[0].peid}`).innerHTML =`${precios[0].penombre}`;
    let precio1P1 = document.getElementById(`p1PersonaId${precios[0].peid}`).value = `${precios[0].precio1}`;
    let precio2P1 = document.getElementById(`p2PersonaId${precios[0].peid}`).value =`${precios[0].precio2}`;
    let precio3P1 = document.getElementById(`p3PersonaId${precios[0].peid}`).value =`${precios[0].precio3}`;
    let dobleP1 = document.getElementById(`doblePersonaId${precios[0].peid}`).value =`${precios[0].doble}`;
    let balanceDobleP1 = document.getElementById(`balanceDoblePersonaId${precios[0].peid}`).value =`${precios[0].doblebalanc}`;
    let tripleP1 = document.getElementById(`triplePersonaId${precios[0].peid}`).value =`${precios[0].triple}`;
    let balanceTripleP1 =document.getElementById(`balanceTriplePersonaId${precios[0].peid}`).value =`${precios[0].triplebalanc}`;
    let promoP1 =document.getElementById(`promoPersonaId${precios[0].peid}`);
    `${precios[0].promocion}`==1?promoP1.setAttribute('checked','true'):promoP1.setAttribute('unchecked','true')
    let restriccionP1 =document.getElementById(`restriccionPersonaId${precios[0].peid}`);
    `${precios[0].restriccion}`==1?restriccionP1.setAttribute('checked','true'):restriccionP1.setAttribute('unchecked','true')
    let acompananteP1 =document.getElementById(`acompanantePersonaId${precios[0].peid}`);
    `${precios[0].acompanante}`==1?acompananteP1.setAttribute('checked','true'):acompananteP1.setAttribute('unchecked','true')
    // PERSONA 2
 

    let personaPrecio2Id = document.getElementById(`persona${precios[1].peid}`).innerHTML =`${precios[1].penombre}`;
    let precio1P2 = document.getElementById(`p1PersonaId${precios[1].peid}`).value =`${precios[1].precio1}`;
    let precio2P2 = document.getElementById(`p2PersonaId${precios[1].peid}`).value =`${precios[1].precio2}`;
    let precio3P2 = document.getElementById(`p3PersonaId${precios[1].peid}`).value =`${precios[1].precio3}`;
    let dobleP2 = document.getElementById(`doblePersonaId${precios[1].peid}`).value =`${precios[1].doble}`;
    let balanceDobleP2 = document.getElementById(`balanceDoblePersonaId${precios[1].peid}`).value =`${precios[1].doblebalanc}`;
    let tripleP2 = document.getElementById(`triplePersonaId${precios[1].peid}`).value =`${precios[1].triple}`;
    let balanceTripleP2 =document.getElementById(`balanceTriplePersonaId${precios[1].peid}`).value =`${precios[1].triplebalanc}`;
    let promoP2 =document.getElementById(`promoPersonaId${precios[1].peid}`);
    `${precios[1].promocion}`==1?promoP2.setAttribute('checked','true'):promoP2.setAttribute('unchecked','true')
    let restriccionP2 =document.getElementById(`restriccionPersonaId${precios[1].peid}`);
    `${precios[1].restriccion}`==1?restriccionP2.setAttribute('checked','true'):restriccionP2.setAttribute('unchecked','true')
    let acompananteP2 =document.getElementById(`acompanantePersonaId${precios[1].peid}`);
    `${precios[1].acompanante}`==1?acompananteP2.setAttribute('checked','true'):acompananteP2.setAttribute('unchecked','true')
     // PERSONA 3
     let personaPrecio3Id = document.getElementById(`persona${precios[2].peid}`).innerHTML =`${precios[2].penombre}`;
     let precio1P3 = document.getElementById(`p1PersonaId${precios[2].peid}`).value =`${precios[2].precio1}`;
     let precio2P3 = document.getElementById(`p2PersonaId${precios[2].peid}`).value =`${precios[2].precio2}`;
     let precio3P3 = document.getElementById(`p3PersonaId${precios[2].peid}`).value =`${precios[2].precio3}`;
     let dobleP3 = document.getElementById(`doblePersonaId${precios[2].peid}`).value =`${precios[2].doble}`;
     let balanceDobleP3 = document.getElementById(`balanceDoblePersonaId${precios[2].peid}`).value =`${precios[2].doblebalanc}`;
     let tripleP3 = document.getElementById(`triplePersonaId${precios[2].peid}`).value =`${precios[2].triple}`;
     let balanceTripleP3 =document.getElementById(`balanceTriplePersonaId${precios[2].peid}`).value =`${precios[2].triplebalanc}`;
     let promoP3 =document.getElementById(`promoPersonaId${precios[2].peid}`);
     `${precios[2].promocion}`==1?promoP3.setAttribute('checked','true'):promoP3.setAttribute('unchecked','true')
     let restriccionP3 =document.getElementById(`restriccionPersonaId${precios[2].peid}`);
     `${precios[2].restriccion}`==1?restriccionP3.setAttribute('checked','true'):restriccionP3.setAttribute('unchecked','true')
     let acompananteP3 =document.getElementById(`acompanantePersonaId${precios[2].peid}`);
     `${precios[2].acompanante}`==1?acompananteP3.setAttribute('checked','true'):acompananteP3.setAttribute('unchecked','true')

    // PESTANA 3
    let diasActividadesHorario = data.pestana3.actividadesHorario; 
    let salidasHLibre = data.pestana3.salidasHLibre; //obtengo las salidas Horario libre 
    let llegadasHLibre = data.pestana3.llegadasHLibre
    let salidasHMultiple = data.pestana3.salidasHMultiple //obtengo las salidas de HORAIO MULTIPLE
    // let llegadasHMultiple = data.pestana3.llegadasHMultiple
    let actividadesHorarioContainer = document.getElementById('actividadesHorarioContainer'); //conteneder mini crud

 

      let  inputsType = document.querySelectorAll('[type=text]')

        inputsType.forEach(function(input){
          if(input.value == "null"){
            input.value = '';
           
          }
   

      })

      // ########################HORARIO MULTIPLE
      
      
      let diasLibres = document.querySelectorAll('.check-horario-libre'); //obtengo todos los check que pertenecen a horarios libres
   
 
    // funcion que recibe como parametros los dias de la BD y los checks pintados en el DOM
      function llenarDiasHLibre (diasDB, DOMChecks){
        
        dias = []; //un array solo para guardar el valor de los dias porque la data me manda ID's y valores nulos
        //obtengo y guardo los dias

        diasDB.forEach(function(setDeDias){
          if(setDeDias.libre ==1){
            dias.push(setDeDias.l) 
            dias.push(setDeDias.m)
            dias.push(setDeDias.x)
            dias.push(setDeDias.j)
            dias.push(setDeDias.v)
            dias.push(setDeDias.s)
            dias.push(setDeDias.d)
          }
        })
       

        // para acceder a el atributo cheked paso de NodeList a Array los cheks del DOm
        DOMChecks = Array.from(DOMChecks)

        // un for para iterar los dias con los checks y si el valor es 1 en dias[] en DOMchecks tomo el mismo indice al check lo pongo en true
          for (let i = 0; i < dias.length; i++) {
            if(dias[i] == 1 ){
              DOMChecks[i].checked =true;
            }else{
              DOMChecks[i].checked =false;
            }
            
          }

      }
      // ejecuto la funcion: llenarDiasHLibre si SALIDAS HORARIO LIBRE TIENE VALORES.
    
    if(salidasHLibre.length != 0){
       actividadesHorarioContainer.innerHTML=""; //limpio el mini crud
       $('#libre').attr('data-actividadid', `${diasActividadesHorario[0].id}`);
       let id = $('#libre').data('actividadid');
     

      //  statusActividad(id)
      //  .then(data => data)
      //  .then(function(data){
        
      //  if( data.message =='Habilitada'){
      
      //   $('#libre').attr('checked',true);
      //   $('#libre').css('box-shadow', '0px 0px 0px 3px green');
      // }else{
      //   $('#libre').attr('checked',false);
    
      //   $('#libre').css('box-shadow', '0px 0px 0px 0px green');
      // }
      // })

     
     



     
      $('#addHorarioContanier').removeClass('btn-primary');
      $('#addHorarioContanier').addClass('btn-secondary anchorElemet');
    

    
    // traer el estado del campo LIBRE en actividades
    //  async function statusActividad(idActividad){
     
    //   const url = `status-actividad/${idActividad}`;
    //   const response = await fetch(url);
    //   const data = await response.json()

    //   return data

      
    //   }

  //  desactivar o activar el campo libre en actividades

      

   
   
        // $('#libre').css('box-shadow', '0px 0px 0px 3px green');
      

     

       let salidainput = document.getElementById('salidas')
   
        $(salidainput).val(salidasHLibre[0][0].slid)
       salidainput.setAttribute('data-horarioid',salidasHLibre[0][0]['actividadeshorario_id'])
       salidainput.setAttribute('data-salidaId',salidasHLibre[0][0]['id'])


      
       let llegadainput = document.getElementById('llegadas')
      $(llegadainput).val(llegadasHLibre[0][0].slid)
       llegadainput.setAttribute('data-llegadaId',llegadasHLibre[0][0]['id'])
     
       diasActividadesHorario.forEach(function(diaActividadHorario){
         if(diaActividadHorario.libre ==1){
          $('#hiniHorarioLibre').val(diaActividadHorario.hini)
          $('#hfinHorarioLibre').val(diaActividadHorario.hfin)
         }
       })
      
      llenarDiasHLibre(diasActividadesHorario, diasLibres);
    }
  


if(salidasHMultiple != 0){

      // FIN HORARIO MULTIPLE###################
   
    actividadesHorarioContainer.innerHTML="";
    diasActividadesHorario.forEach(function(horario){
      
     
      let bolcheckL;
      if(horario.l == 1){
        bolcheckL = 'checked';
      }else{
        bolcheckL='unchecked';
      }
      let bolcheckM;
      if(horario.m == 1){
        bolcheckM = 'checked';
      }else{
        bolcheckM='unchecked';
      }
      let bolcheckX;
      if(horario.x == 1){
        bolcheckX = 'checked';
      }else{
        bolcheckX='unchecked';
      }
      let bolcheckJ;
      if(horario.j == 1){
        bolcheckJ = 'checked';
      }else{
        bolcheckJ='unchecked';
      }
      let bolcheckV;
      if(horario.v == 1){
        bolcheckV = 'checked';
      }else{
        bolcheckV='unchecked';
      }
      let bolcheckS;
      if(horario.s == 1){
        bolcheckS = 'checked';
      }else{
        bolcheckS='unchecked';
      }
      let bolcheckD;
      if(horario.d == 1){
        bolcheckD = 'checked';
      }else{
        bolcheckD='unchecked';
      }

      let templete = document.createElement('div');
  
      templete.innerHTML=`
      <div class="col-12 p-0">
        <div class="container">
          <div class="row" >
                <div class="col-2">
                  <input type="time" value='${horario.hini}' class="m-1 dinamic-input-time text-center " disabled>
                </div>
                <div class="col-2">
                  <input type="time" value='${horario.hfin}' class="m-1 dinamic-input-time text-center" disabled>
                </div>
              <div class="col-3 offset-2 pt-3">
                <label class="form-check-label font-weight-bolder">L</label>
                <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="dial${contador}" id="dial${contador}" value="${horario.l}" ${bolcheckL} disabled> 
                <label class="form-check-label font-weight-bolder">M</label>
                <input class="diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diam${contador}" id="diam${contador}" value="1"  data-horarioid="${contador}" ${bolcheckM} disabled> 
                <label class="form-check-label font-weight-bolder  ">X</label>
                <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diax${contador}" id="diax${contador}" value="1"  data-horarioid="${contador}" ${bolcheckX} disabled> 
                <label class="form-check-label font-weight-bolder  ">J</label>
                <input class="diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diaj${contador}" id="diaj${contador}" value="1"  data-horarioid="${contador}" ${bolcheckJ} disabled> 
                <label class="form-check-label font-weight-bolder">V</label>
                <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diav${contador}" id="diav${contador}" value="1" data-horarioid="${contador}" ${bolcheckV} disabled> 
                <label class="form-check-label font-weight-bolder  ">S</label>
                <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="dias${contador}" id="dias${contador}" value="1"  data-horarioid="${contador}" ${bolcheckS} disabled> 
                <label class="form-check-label font-weight-bolder  ">D</label>
                <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diad${contador}" id="diad${contador}" value="1"  data-horarioid="${contador}" ${bolcheckD} disabled> 
              </div>
              <div class="col-2 pt-3"> 
                <button type="button" class="table-head table-head__btn btn-edit btn btn-primary"  onclick="MostrarHMultiple(this);" data-id=${horario.id}> <span class="font-weight-bolder">
                </button>
                <a href="#!" class="table-head table-head__btn btn btn-delete btn-danger"></a>
              </div>
          </div>
      </div>
    </div>`
    if(horario.libre == 0){
      actividadesHorarioContainer.appendChild(templete);
    }
     
  
    })
  }
 

  if( data.pestana4.ob[0].riesgo == 1){
   
    $('#riesgo').prop('checked',true)
  }else{
  
    $('#riesgo').prop('checked',false)
  }

  $('#puntos').val(data.pestana4.ob[0].puntos)
  $('#requisito').val(data.pestana4.ob[0].requisitos)
  $('#observaciones').val(data.pestana4.ob[0].observaciones)
  
  });



}
let horarioMultipleAJAX;
function MostrarHMultiple(horario){

let horarioID = horario.getAttribute('data-id')

let xhr = new XMLHttpRequest()

xhr.onreadystatechange = function(){
  if(this.readyState==4 && this.status == 200)
  horarioMultipleAJAX = JSON.parse(xhr.responseText);
}

xhr.open('GET',`/horario-multiple/${IDACTIVIDAD}`,false)
xhr.send();

let respuesta = horarioMultipleAJAX.pestana3;
let horarios = respuesta.actividadesHorario;
let salidasHMultiple = respuesta.salidasHMultiple;
let llegadasHMultiple = respuesta.llegadasHMultiple;

horarios.forEach(function(horario){/*  por cada horario registrado en la DB crea un  y se muestra un horario */

  if(horarioID == horario.id ){
   
  let bolcheckL;
  if(horario.l == 1){
    bolcheckL = 'checked';
  }else{
    bolcheckL='unchecked';
  }
  let bolcheckM;
  if(horario.m == 1){
    bolcheckM = 'checked';
  }else{
    bolcheckM='unchecked';
  }
  let bolcheckX;
  if(horario.x == 1){
    bolcheckX = 'checked';
  }else{
    bolcheckX='unchecked';
  }
  let bolcheckJ;
  if(horario.j == 1){
    bolcheckJ = 'checked';
  }else{
    bolcheckJ='unchecked';
  }
  let bolcheckV;
  if(horario.v == 1){
    bolcheckV = 'checked';
  }else{
    bolcheckV='unchecked';
  }
  let bolcheckS;
  if(horario.s == 1){
    bolcheckS = 'checked';
  }else{
    bolcheckS='unchecked';
  }
  let bolcheckD;
  if(horario.d == 1){
    bolcheckD = 'checked';
  }else{
    bolcheckD='unchecked';
  }
  contador++;
  
  let container= document.createElement('div')
  container.classList = "contanier";
  container.innerHTML= `
  
  <div class="container horarios"> 
  <input type="hidden" class="h-id" data-id="${horario.id}" id="horarioIdPunto${horario.id}" data-puntoId="${horario.id}"> 
  <span class="h-divider"> </span>
    <div class="row">
      <div class="col-12"> 
        <a href="#!" class="btn btn-danger float-right bnt-eliminar" onclick="cancelHorario(this)"  data-HID="${horario.id}">X</a>
      </div>
      <div class="col-4">
        <label class="lead titulo-horario-multiple" data-identificadores="${contador}" id="horarioId${contador}" data-HID="${horario.id}">Horario ${contador}  </label>
      </div>
    </div>
    <div class="row">                          
      <div class="col-6">
        <div class="row">
          <div class="col-4">
            <div class="form-group">
              <label for="">Hora de Inicio:</label>
              <input type="time" name="horainicio${contador}" id="horainicio${contador}" class="form-control horario-multiple listener-hora-ini" placeholder="" value=${horario.hini} aria-describedby="helpId" data-horarioid="${contador}" required>
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
              <label for="">Hora de Finalización:</label>
              <input type="time" name="horafin${contador}" id="horafin${contador}" class="form-control horario-multiple listener-hora-fin" placeholder="" aria-describedby="helpId" data-horarioid="${contador}" required value=${horario.hfin} onchange="validarHoraFin(this)" >
            
            </div>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="row mt-3">
          <div class="col-3 ml-1 ">
            <div class="form-group float-left">
              <label class="form-check-label lbcheck">
              <input class="  sizecheck general horario-multiple" type="checkbox" name="checkdiario${contador}" id="checkdiario${contador}" value="1" onchange="diarioEntrega(this);" data-id="${contador}">Diario</label>
            </div>
          </div>
        <div class="col-8 ">
          <div class="container">
            <div class="row">
              <div class="">
                <label class="form-check-label font-weight-bolder">L</label>
                <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="dial${contador}" id="dial${contador}" value="1" ${bolcheckL} data-horarioid="${contador}" data-HID=${horario.id}> 
              </div>
              <div class="ml-3">
                <label class="form-check-label font-weight-bolder">M</label>
                <input class="diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diam${contador}" id="diam${contador}"value="1" ${bolcheckM} data-horarioid="${contador}"  data-HID=${horario.id}> 
              </div>
              <div class="ml-3">
                <label class="form-check-label font-weight-bolder ">X</label>
                  <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diax${contador}" id="diax${contador}" value="1" ${bolcheckX} data-horarioid="${contador}" data-HID=${horario.id}>
              </div>
              <div class="ml-3">
                <label class="form-check-label font-weight-bolder">J</label>
                <input class="diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diaj${contador}" id="diaj${contador}" value="1" ${bolcheckJ} data-horarioid="${contador}" data-HID=${horario.id}> 
              </div>
              <div class="ml-3">
                <label class="form-check-label font-weight-bolder">V</label>
                <input class="diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diav${contador}" id="diav${contador}" value="1" ${bolcheckV} data-horarioid="${contador}" data-HID=${horario.id}> 
              </div>
              <div class="ml-3" >
                <label class="form-check-label font-weight-bolder">S</label>
                <input class="diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="dias${contador}" id="dias${contador}" value="1" ${bolcheckS} data-horarioid="${contador}" data-HID=${horario.id}> 
              </div>
              <div class="ml-3">
                <label class="form-check-label font-weight-bolder">D</label>
                <input class="diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diad${contador}" id="diad${contador}" value="1" ${bolcheckD} data-horarioid="${contador}" data-HID=${horario.id}> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row" id="row">
    <div class="col-12 ">
      <div class="row">
        <div class="col-6">  <h2 class="lead">Salidas</h2></div>
        <div class="col-6">  <h2 class="lead">Llegadas </h2></div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-6" id="agreageSalidasHmultiple">
    
    </div>
    <div class="col-6" id="agreageLlegadasHmultiple">
    
    </div>
  </div>
  `;
  rowContanier.innerHTML = "";
  rowContanier.appendChild(container);
  }
})
salidasHMultiple.forEach(function(salida){
  salida.forEach(function(sal){
   if(sal.actividadeshorario_id == horarioID ){
    agregarSalidasHorarioMultiple(sal);
    }
  })
})

llegadasHMultiple.forEach(function(llegada){
  llegada.forEach(function(lleg){
   if(lleg.actividadeshorario_id == horarioID ){

     agregarLlegadaHorarioMultiple(lleg)
    }
  })
})
function agregarSalidasHorarioMultiple(salida){
 
  let agreageSalidasHmultiple = document.getElementById('agreageSalidasHmultiple');
  agreageSalidasHmultiple.innerHTML ="";
  agreageSalidasHmultiple.innerHTML +=`
        <div class="row">
          <div class="col-4">
            <div class="form-group">
              <label for="" data-punto="1";>Punto 1</label>
              <select class="form-control horario-multiple select-multiple__salidas hsalidas" name="salidas${salida.id}" id="salidas${salida.id}" data-id="${salida.id}" data-horarioid="${salida.actividadeshorario_id}" onchange="validarPuntosSalida()" data-salidallegadahorario="${salida.id}"; data-puntoid="${salida.id}" data-identificadores="${contador}">
              
              </select>
            </div>
            
          </div>
          <div class="col-4">
            <div class="form-group">
              <label for="">Hora</label>
              <input type="time" class="form-control horario-multiple hora-salida" name="salidahora${salida.id}" id="salidahora${salida.id}" data-horarioid="${salida.id}" aria-describedby="helpId" placeholder="" value="${salida.hora}"onchange=" ValidaHoraSalida(this);" data-id="${salida.id}"  data-puntoid="${salida.actividadeshorario_id}" data-identificadores="${contador}">
            </div>
          </div>
            <div class="col-4 d-inline mt-4 pt-1">
              <a href="#!" class="btn btn-secondary d-inline horario-multiple" id="primarybtnHora${contador}" onclick="addpunto(this);">+</a>
            </div>
        </div> 
  `;
  rellenarSelect();
  let select = document.getElementById(`salidas${salida.id}`)
  DefaultSelect(select,salida)
 
}

// agregar llegas al horario multiple
function agregarLlegadaHorarioMultiple(llegada){
  let agreagarLlegadasHmultiple = document.getElementById('agreageLlegadasHmultiple');
  agreagarLlegadasHmultiple.innerHTML ="";
  agreagarLlegadasHmultiple.innerHTML +=`
        <div class="row">
          <div class="col-4">
            <div class="form-group">
              <label for="" data-punto="1";>Punto 1</label>
              <select class="form-control horario-multiple select-multiple__llegadas hsalidas" name="llegadas${llegada.id}" id="llegadas${llegada.id}" data-id="${llegada.id} "data-horarioid="${llegada.actividadeshorario_id}" onchange="validarPuntosLlegada()"  data-puntoid="${llegada.id}" data-identificadores="${contador}">
              
              </select>
            </div>
        
          </div>
          <div class="col-4">
            <div class="form-group">
              <label for="">Hora</label>
              <input type="time" class="form-control horario-multiple hora-llegada " name="llegadahora${llegada.id}" id="llegadahora${llegada.id}" data-id="${llegada.id}" data-horarioid="${llegada.id}" aria-describedby="helpId" placeholder="" value="${llegada.hora}" onchange="ValidaHoraLlegada(this)"  data-puntoid="${llegada.id}" data-identificadores="${contador}">
              <small class="text-danger" id="labelSmall${contador}" data-labelid="${contador}"></small>
            </div>
          </div>
            <div class="col-4 d-inline mt-4 pt-1">
              <a href="#!" class="btn btn-secondary d-inline horario-multiple" id="primarybtnHora${contador}" onclick="addpuntoLLEGADAS(this);">+</a>
            </div>
        </div> 
  `;
  rellenarSelectLlegadas()
  let select = document.getElementById(`llegadas${llegada.id}`)
  DefaultSelect(select,llegada)
}


  function rellenarSelect(){
    /* 
    *Tomo todos los select que tengan la clase .select-multiple__salidas
    */
    let selectHmultipleSalidas = document.querySelectorAll('.select-multiple__salidas');

/* por cada salida registrada el la BD creo un option y lo inserto dentro del select */
    for (let i = 0; i < salidasyllegadas.length; i++) {
      let option = document.createElement('option');
      option.value = salidasyllegadas[i].id
      option.innerHTML = salidasyllegadas[i].nombre;

      for(let j = 0; j <selectHmultipleSalidas.length; j++){
       if(selectHmultipleSalidas[j].getAttribute('value') != option.getAttribute('value')){
            selectHmultipleSalidas[j].appendChild(option)   
          }
      }
    }
  }
  function rellenarSelectLlegadas(){
    let selectHmultipleLlegadas = document.querySelectorAll('.select-multiple__llegadas');

    for (let i = 0; i < salidasyllegadas.length; i++) {
    
      let option = document.createElement('option');
      option.value = salidasyllegadas[i].id
      option.innerHTML =salidasyllegadas[i].nombre;

         for (let j = 0; j < selectHmultipleLlegadas.length; j++) {
          if(selectHmultipleLlegadas[j].getAttribute('value') != option.getAttribute('value')){
         
            selectHmultipleLlegadas[j].appendChild(option)   
          }
           
         }

    }
  }

 

  
  
    /*SELECT SALIDAS
    *
    *
    * la peticion xhr esta de forma sincrona por eso el retardo al abrir el nuevo horario se peude mejorar con fetch
    */
    let selectsSalidasLegadas = document.querySelectorAll('[id^="salidas"]')
    let selectsSalidasLegadas__llegadas = document.querySelectorAll('[id^="llegadas"]')
     selectsSalidasLegadas = Array.from(selectsSalidasLegadas)
     selectsSalidasLegadas__llegadas = Array.from(selectsSalidasLegadas__llegadas)
  
   
    
    // for (let i = 0; i < salidasyllegadas.length; i++) {
    //   let option = document.createElement('option');
    //   option.value = salidasyllegadas[i].id
    //   option.innerHTML =salidasyllegadas[i].nombre;
    //   selectsSalidasLegadas.forEach(function(select){
    //     select.appendChild(option)
    //   })
    // }
     
    // for (let i = 0; i < salidasyllegadas.length; i++) {
    //   let option = document.createElement('option');
    //   option.value = salidasyllegadas[i].id
    //   option.innerHTML =salidasyllegadas[i].nombre;
      
      
    //   selectsSalidasLegadas__llegadas.forEach(function(select){
    //     select.appendChild(option)
    //   })
    // }
  
  

// fin ajaxx HORARIO MULTIPLE

//PESTAÑA 4

}







function validarHoraFin(e){
  let horaFin = e.value;
  let horaInicio = e.parentElement.parentElement.parentElement.children[0].children[0].children[1].value;
  
  if(horaFin <= horaInicio){
    e.parentElement.children[2].innerText = "Hora Fin tiene que ser Mayor a Hora inicio."
     
    

  }else{
    e.parentElement.children[2].innerText = "";
    e.classList.add('btn-success');
  }
}
function ValidaHoraSalida(e){
let horaSalida = e.value;
let horaInicio = e.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.children[0].children[3].children[0].children[0].children[0].children[0].children[1].value;
if( horaSalida >= horaInicio){

  e.parentElement.children[2].innerText = "Hora de Salida Tiene que ser Menor a Hora Inicio."
   
  
  setInterval(() => {
    e.parentElement.children[2].style.display ="none";
  }, 3000);
 

}else {
  e.classList.add('btn-success');
  e.parentElement.children[2].innerText = "";
}
}
//validar si se toma hora de salida o de llegada
function ValidaHoraLlegada(e){
  let horallegada = e.value;
let horaFin = e.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.children[0].children[3].children[0].children[0].children[1].children[0].children[1].value

if( horallegada < horaFin){
  e.parentElement.children[2].innerText = "Hora de Llegada Tiene que ser Mayor a Hora Fin.";

}else{
  e.parentElement.children[2].innerText = "";
  e.classList.add('btn-success');
}
}


function DefaultSelect(select,salidas){
  select.value =salidas.slid;
} 

function validarPuntosSalida(){
let horarios = document.querySelectorAll('[id^="horarioId"]')
let salidas = document.querySelectorAll('[class~="select-multiple__salidas"]')
// por cada horario obtener sus salidas
let ArraysalidasPorHorario = [];
let salidasMismoHorario = [];

horarios.forEach(function(horario, index){
  // por cada horario genero un nuevo array 
  let Arhorario = [];

  for (let i = 0; i < salidas.length; i++) {
    
  // comparo si la salida tiene el mismo id de horario
    if(salidas[i].getAttribute('data-horarioid') == horario.getAttribute('data-identificadores') ){

      if(Arhorario.length>0){
        if(salidas[i].value == salidas[i-1].value){
          
        $('#salidaError').addClass('text-danger d-inline');
        $('#salidaError').text('No pueder Selecionar el Mismo Punto de Salida.');

         }else{
          $('#salidaError').text('');
         }
      }else{
        Arhorario.push(salidas[i])
      }
      
    }
    
  }
  // ya tengo las salidas separadas por horario 
  // ahora toca verificar que cada horario no se repita entre ellos


  

  ArraysalidasPorHorario.push(Arhorario)
 

})



}


function validarPuntosLlegada(){
  let horarios = document.querySelectorAll('[id^="horarioId"]')
  let llegadas = document.querySelectorAll('[class~="select-multiple__llegadas"]')
  // por cada horario obtener sus salidas
  let ArraysalidasPorHorario = [];
  let llegadasMismoHorario = [];
  
  horarios.forEach(function(horario, index){
    // por cada horario genero un nuevo array 
    let Arhorario = [];
  
    for (let i = 0; i < llegadas.length; i++) {
      
    // comparo si la salida tiene el mismo id de horario
      if(llegadas[i].getAttribute('data-horarioid') == horario.getAttribute('data-identificadores') ){
  
        if(Arhorario.length>0){
          if(llegadas[i].value == llegadas[i-1].value){
            
          $('#llegadaError').addClass('text-danger');
          $('#llegadaError').text('No pueder Selecionar el Mismo Punto de Llegada.');
  
    
           }else{
            $('#llegadaError').text('');
           }
        }else{
          Arhorario.push(llegadas[i])
        }
        
      }
      
    }
  
    ArraysalidasPorHorario.push(Arhorario)
  
  })
  
  } 

  
  class ValidarInputTime {
    constructor (){
    }
    HoraInicio(inputsHini){
      this.inputsHini =inputsHini;
      let contador=0;

     return inputsHini.forEach(function(input){
       if(input.value == ""){
         contador++;
       }
       if(contador>0){
           
         $('#errorsInputs').text('El Campo Hora de Inicio no Puede Estar Vacio');
         $('#message-errorIntoModal2').fadeIn();
       

         setTimeout(() => {
           $('#message-errorIntoModal2').fadeOut();
         }, 3000);
       }
        
     })
    }
    HoraFin(inputsHFin){
      this.inputsHFin =inputsHFin;
      let contador=0;

     return inputsHFin.forEach(function(input){
       if(input.value == ""){
         contador++;
       }
       if(contador>0){
           
         $('#errorsInputs').text('El Campo Hora Fin no Puede Estar Vacio');
         $('#message-errorIntoModal2').fadeIn();
        
         setTimeout(() => {
           $('#message-errorIntoModal2').fadeOut();
         }, 3000);
       }
        
     })
    }
  }

 let balanceFix = document.querySelectorAll('.balanceFix')


 balanceFix.forEach(function(balance){
 
  let setter =  Math.round(Number(balance.innerText));

  balance.innerText = `${setter.toLocaleString('en-IN', { style: 'currency', currency: 'MXN' })}`;
  
  ;
 })

 let precioFix =document.querySelectorAll('.precioFix')

 precioFix.forEach(function(precio){
  let fix = precio.innerText;
 let setter =  Math.round(Number(precio.innerText));
 let cantidad = setter.toLocaleString('en-IN', { style: 'currency', currency: 'MXN' }).substr(2, setter.length);
 let moneda =setter.toLocaleString('en-IN', { style: 'currency', currency: 'MXN' }).substr(0, 2);

 precio.innerText = `${cantidad} ${moneda}`;

})
function isActividad(e){
  let atributo = document.getElementById('editActividad').getAttribute('data-isedit');

  let x 
  if(atributo == 'true'){

    x = true;
  }else{
    x= false;
  }
  return x;
}
// desactivar actividad
function desactivarActividad (e){
  let actividad
  let route = `/editar-actividad/${e.getAttribute('data-id')}`;
  let desactivar = e.getAttribute('data-desactivar');
  let id = e.getAttribute('data-id');
  let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
  $.ajax({
    url:route,
    headers:{'X-CSRF-TOKEN':token},
    type:'PUT',
    dataType: 'json',
    data: {id: id,desactivar:desactivar},
    success:function(data)
    {
 
      if(data.status == 200){
        $('#message-success').fadeIn();
        $('#success').text(data.response);
        setTimeout(() => {  
          $('#message-success').fadeOut();
        }, 3000);
       
      }else{
        $('#message-error').fadeIn();
        $('#error').text('Error Al Procesar la Petición');
        setTimeout(() => {  
          $('#message-success').fadeOut();
        }, 3000);
      }   
  },
  })

}


// eliminar actividad
function eliminarActividad (e){
  let actividad
  let route = `/actividades/${e.getAttribute('data-id')}`;
  let eliminar = e.getAttribute('data-eliminar');
  let id = e.getAttribute('data-id');
  let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
  $.ajax({
    url:route,
    headers:{'X-CSRF-TOKEN':token},
    type:'DELETE',
    dataType: 'json',
    data: {id: id,eliminar:eliminar},
    success:function(data)
    {

      if(data.status == 200){
        $('#message-success').fadeIn();
        $('#success').text(data.response);
        setTimeout(() => {  
          $('#message-success').fadeOut();
        }, 3000);
       
      }else{
        $('#message-error').fadeIn();
        $('#error').text('Error Al Procesar la Petición');
        setTimeout(() => {  
          $('#message-success').fadeOut();
        }, 3000);
      }   
  },
  })

}

let error = false;
function  errores (){
  let contadorDErrores =0;
  let labelSmall =  document.querySelectorAll('[id^=labelSmall]')
  labelSmall.forEach(function(label){
    if(label.innerText != ""){
      contadorDErrores++;
    }if(contadorDErrores > 0){
      error = true;
    }else if(contadorDErrores == 0){
      error = false;
    }
  })
  
}


 //color para el tr si esta desactivado 
 let elements = document.querySelectorAll('[data-active="0"]');
 elements.forEach(element => {
    element.classList.add('tr-bg');
});
// o activado
let btnStatus = document.querySelectorAll('[data-btn-status="0"]');
btnStatus.forEach(btn => {
    btn.classList.add('btn-status');
});



// OBTENRE LOS  puntos de salida horairo multiples AL CREAR
function getPuntosSalidas(){
  let puntosHM =[];
  let horarioMultiple = document.querySelectorAll('[id^=horarioId]')
  let puntosSalida = document.querySelectorAll('[class~=select-multiple__salidas]')
  let data={}

  for (let i = 0; i < horarioMultiple.length; i++) {

    let ide =  horarioMultiple[i].getAttribute('data-identificadores')
    for (let i = 0; i < puntosSalida.length; i++) {
      
  
      if(ide == puntosSalida[i].getAttribute('data-identificadores')){
        data = { 
          'horario':ide,
          'puntoId': puntosSalida[i].getAttribute('data-puntoid'),  
          'puntoValue': puntosSalida[i].value,
          'puntoHora': puntosSalida[i].parentElement.parentElement.parentElement.children[1].children[0].children[1].value,
        }
        
        puntosHM.push(data)
      }

    }

  
    
  }

  return puntosHM;  

  
}
// OBTENER puntos de llegada horairo multiple AL CRERAR
function getPuntosLlegadas(){
  let puntosHM =[];
  let horarioMultiple = document.querySelectorAll('[id^=horarioId]')
  let puntosLlegadas = document.querySelectorAll('[class~=select-multiple__llegadas]')
  let data={}

  for (let i = 0; i < horarioMultiple.length; i++) {

    let ide =  horarioMultiple[i].getAttribute('data-identificadores')
    for (let i = 0; i < puntosLlegadas.length; i++) {

      if(ide == puntosLlegadas[i].getAttribute('data-identificadores')){
        data = { 
          'horario':ide,
          'puntoId': puntosLlegadas[i].getAttribute('data-puntoid'),  
          'puntoValue': puntosLlegadas[i].value,
          'puntoHora': puntosLlegadas[i].parentElement.parentElement.parentElement.children[1].children[0].children[1].value,
        }
        puntosHM.push(data)
      }

    }

  
    
  }

  return puntosHM;  

  
}

function prueba(){
  let horarios = document.querySelectorAll('.horarios');
  let h= [];
  for (let horario = 0; horario < horarios.length; horario++) {
      // dias
      let dias = horarios[horario].querySelectorAll('.horario-multiple__dia');
      let diaa = [];
      let l, m, x, j, v, s, d;
      for (let di = 0; di < dias.length; di++) {
          switch (dias[di].name.substring(3,4)) {
              case 'l':
                l= dias[di].checked==true ? 1:0 ;
                break;
              case 'm':
                m=dias[di].checked==true ? 1:0 ;
                break;
              case 'x':
                x=dias[di].checked==true ? 1:0;
                break;
              case 'j':
                j=dias[di].checked==true ? 1:0 ;
                break;
              case 'v':
                v=dias[di].checked==true ? 1:0 ;
                break;
              case 's':
                s=dias[di].checked==true ? 1:0 ;
                break;
              case 'd':
                d=dias[di].checked==true ? 1:0 ;
                break;                    
          }      
      }
      diaa ={
        l:l, m:m, x:x, j:j, v:v, s:s, d:d
      }

      // salidas
      let sa = horarios[horario].querySelectorAll('[id^=salidas');
      let sah = horarios[horario].querySelectorAll('[id^=salidahora');
      let salid =[];
      let ids;
      for (let s = 0; s < sa.length; s++) {
        let hora;           
        for (let h = 0; h < sah.length; h++) {
          let tmp1=sa[s].name.substring(7);               
          let tmp2= sah[h].name.substring(10);          
            if (sa[s].name.substring(7)===sah[h].name.substring(10)) {
                hora= sah[h].value;
                ids= sa[s].getAttribute('data-id');
                break;
            }          
        }
        let stemp ={
          idsal: ids,
          s: sa[s].value,
          hor: hora
        };  
        salid.push(stemp);          
      }      

      // llegadas
      let ll = horarios[horario].querySelectorAll('[id^=llegadas');
      let llh = horarios[horario].querySelectorAll('[id^=llegadahora');
      let llegad =[];
      let idl;
      for (let l = 0; l < ll.length; l++) {
        let horal;           
        for (let h = 0; h < llh.length; h++) {
          let tmp1=ll[l].name.substring(8);               
          let tmp2= llh[h].name.substring(11);          
            if (ll[l].name.substring(8)===llh[h].name.substring(11)) {
              horal= llh[h].value;
                ids= ll[l].getAttribute('data-id');
                break;
            }          
        }
        let ltemp ={
          id: ids,
          l: ll[l].value,
          hor: horal
        };  
        llegad.push(ltemp);          
      }
      
      let datos = {
        cont : horario,        
        id : horarios[horario].children[0].getAttribute('data-id'),
        hini : horarios[horario].querySelectorAll('[id^=horainicio')[0].value,
        hfin : horarios[horario].querySelectorAll('[id^=horafin')[0].value,
        dia : diaa,
        sal : salid,
        lle : llegad
      }
      let ho=[];
      ho.push(datos); 
      h.push(ho);        
  }

  // // horarios libres
  // let dd= document.querySelectorAll('.pestana3-seccion1')[0].querySelectorAll('[id^=dia');
  // let l, m, x, j, v, s, d;
  // for (let i = 0; i < dd.length; i++) {          
  //     switch (dd[i].id.substring(3,4)) {
  //       case 'l':
  //         l= dd[i].checked;
  //         break;
  //       case 'm':
  //         m=dd[i].checked;
  //         break;
  //       case 'x':
  //         x=dd[i].checked;
  //         break;
  //       case 'j':
  //         j=dd[i].checked;
  //         break;
  //       case 'v':
  //         v=dd[i].checked;
  //         break;
  //       case 's':
  //         s=dd[i].checked;
  //         break;
  //       case 'd':
  //         d=dd[i].checked;
  //         break;                    
  //   }  
  //   diasl ={
  //     l:l, m:m, x:x, j:j, v:v, s:s, d:d
  //   }              
  // }

  // let diasLib ={
  //   cont: -1,
  //   dias: diasl,
  //   lleg: document.querySelectorAll('.pestana3-seccion1')[0].querySelectorAll('[id^=llegadas')[0].value,
  //   sali: document.querySelectorAll('.pestana3-seccion1')[0].querySelectorAll('[id^=salidas')[0].value
  // };

  // let diasli =[];
  // diasli.push(diasLib);

  // h.push(diasli) 

  return h;
}


$('.addHorarioContanier').click(function (e) { 
  e.preventDefault();

  if(this.children[0].classList.contains('btn-secondary')){
    $('#alerForHLibre').addClass('text-danger fadeIn')
    $('#alerForHLibre').text('Deshabilita el Horario Libre')
    setTimeout(() => {
      $('#alerForHLibre').text(' ')
    }, 2000);
  }
  
});




// function activarActividad(){
//   let id = $('#libre').data('actividadid');
//     $.ajax({
//       type: "PUT",
//       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//       url: `deshabilitar-actividad/${id}`,
//       data: id,
//       dataType: "json",
//       success: function (response) {
//         if( response.message =='Activada Correctamente'){
//         
//           $('#libre').attr('checked',true);
//           $('#libre').css('box-shadow', '0px 0px 0px 3px green');
//         }else{
//           $('#libre').attr('checked',false);
//         
//           $('#libre').css('box-shadow', '0px 0px 0px 0px green');
//         }
//   
//       }
//     });
 
// }