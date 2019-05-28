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
// entrega.disabled = false;
// entrega.checked=false;
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
// duracion.disabled = true;
// entrega.disabled = true;
enableddHOrarioMultiple();
salidas.disabled = true;
llegadas.disabled = true;
checkDiario.disabled =true;
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
// addHorarioContanier.addEventListener('click',(e)=>{
 
//   e.preventDefault();

  contador++;
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
    <div class="col-4">
    <label class="lead titulo-horario-multiple" data-identificadores="${contador}" id="titulo">Horario ${contador}</label>
    </div>
  </div>
  <div class="row">
                            
                            <div class="col-6">
                              <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Hora de Inicio:</label>
                                        <input type="time" name="horainicio${contador}" id="horainicio${contador}" class="form-control horario-multiple" placeholder="" aria-describedby="helpId" data-horarioid="${contador}">
                                      </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Hora de Finalización:</label>
                                        <input type="time" name="horafin${contador}" id="horafin${contador}" class="form-control horario-multiple" placeholder="" aria-describedby="helpId" data-horarioid="${contador}">
                                      </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="row mt-3">
                                  <div class="col-3 ml-1 ">
                                      <div class="form-group float-left">
                                          <label class="form-check-label lbcheck">
                                            <input class="  sizecheck general horario-multiple" type="checkbox" name="checkdiario${contador}" id="checkdiario${contador}" value="1" onchange="diarioEntrega(this);" data-id="${contador}">Diario
                                          </label>
                                        </div>
                                  </div>
                                  <div class="col-8 ">
                                                <div class="container">
                                                    <div class="row">
                                                      <div class="">
                                                          <label class="form-check-label font-weight-bolder  ">L
                                                            </label>
                                                            <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="dial${contador}" id="dial${contador}" value="1" checked data-horarioid="${contador}"> 
                                                      </div>
                                                      <div class="ml-3">
                                                          <label class="form-check-label font-weight-bolder  ">M
                                                            </label>
                                                            <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diam${contador}" id="diam${contador}" value="1" checked data-horarioid="${contador}"> 
                                                      </div>
                                                      <div class="ml-3">
                                                          <label class="form-check-label font-weight-bolder  ">X
                                                            </label>
                                                            <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diax${contador}" id="diax${contador}" value="1" checked data-horarioid="${contador}"> 
                                                      </div>
                                                      <div class="ml-3">
                                                          <label class="form-check-label font-weight-bolder  ">J
                                                            </label>
                                                            <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diaj${contador}" id="diaj${contador}" value="1" checked data-horarioid="${contador}"> 
                                                      </div>
                                                      <div class="ml-3">
                                                          <label class="form-check-label font-weight-bolder  ">V
                                                            </label>
                                                            <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diav${contador}" id="diav${contador}" value="1"checked data-horarioid="${contador}"> 
                                                      </div>
                                                      <div class="ml-3" >
                                                          <label class="form-check-label font-weight-bolder  ">S
                                                            </label>
                                                            <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="dias${contador}" id="dias${contador}" value="1" checked data-horarioid="${contador}"> 
                                                      </div>
                                                      <div class="ml-3">
                                                          <label class="form-check-label font-weight-bolder  ">D
                                                            </label>
                                                            <input class="  diarioEntrega${contador} sizecheck horario-multiple__dia" type="checkbox" name="diad${contador}" id="diad${contador}" value="1" checked data-horarioid="${contador}"> 
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
                                <div class="col-6">  <h2 class="lead">Llegadas </h2></div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                              <div class="col-6" >
                                  <div class="row">
                                      <div class="col-4">
                                          <div class="form-group">
                                            <label for="" data-punto="1";>Punto 1</label>
                                            <select class="form-control horario-multiple select-multiple__salidas" name="salidas${contador}" id="salidas${contador}" data-horarioid="${contador}">
                                          
                                              </select>
                                          </div>
                                        </div>
                                        <div class="col-4">
                                          <div class="form-group">
                                            <label for="">Hora</label>
                                            <input type="time" class="form-control horario-multiple hora-salida" name="salidahora${contador}" id="salidahora${contador}" data-horarioid="${contador}" aria-describedby="helpId" placeholder="">
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
                                              <select class="form-control horario-multiple select-multiple__llegadas" name="llegadas${contador}" id="llegadas${contador}"data-horarioid="${contador}">
                                              </select>
                                            </div>
                                          </div>
                                          <div class="col-4">
                                            <div class="form-group">
                                              <label for="">Hora</label>
                                              <input type="time" class="form-control horario-multiple hora-llegada" name="llegadahora${contador}" id="llegada${contador}" data-horarioid="${contador}" aria-describedby="helpId" placeholder="">
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
      <select class="form-control horario-multiple select-multiple__salidas" name="salidas${contador}" id="salidas${contador}" data-horarioid="${contador}">
                                          
      </select>
    </div>
  </div>
  <div class="col-4">
    <div class="form-group">
      <label for="">Hora</label>
      <input type="time" class="form-control hora-salida" name="" id="" data-horarioid="${contador}" aria-describedby="helpId" placeholder="">
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

let selectsSalidasLegadas = document.querySelectorAll('[id^="salidas"]')

   selectsSalidasLegadas = Array.from(selectsSalidasLegadas)


 
  
  for (let i = 1; i < salidasyllegadas.length; i++) {
    let option = document.createElement('option');
    option.value = salidasyllegadas[i].id
    option.innerHTML =salidasyllegadas[i].direccion;
    
    
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
      <select class="form-control horario-multiple select-multiple__llegadas" name="llegadas${contador}" id="llegadas${contador}" data-horarioid="${contador}"
      >
      </select>
    </div>
  </div>
  <div class="col-4">
    <div class="form-group">
      <label for="">Hora</label>
      <input type="time" class="form-control hora-llegada" name="" id=""  data-horarioid="${contador}" aria-describedby="helpId" placeholder="">
    </div>
    
  </div>
  <div class="col-4 d-inline mt-4 pt-1">
      <a href="#!" class="btn btn-secondary d-inline" id="secondarybtnHora1" onclick="addpuntoLLEGADAS(this);"> +</a>
      <a href="#!" class="btn btn-danger d-inline horario-multiple" id="primarybtnHora${contador}" onclick="removepuntoLLEGADAS(this);">-</a>
    </div>
    
  </div>  
`;

parent.appendChild(row);
intNumPunto++;
countRecolecionLLEGADAS++;

  let selectsSalidasLegadas__llegadas = document.querySelectorAll('[id^="llegadas"]')
  
   selectsSalidasLegadas__llegadas = Array.from(selectsSalidasLegadas__llegadas)

 
  

   
  for (let i = 1; i < salidasyllegadas.length; i++) {
    let option = document.createElement('option');
    option.value = salidasyllegadas[i].id
    option.innerHTML =salidasyllegadas[i].direccion;
    
    
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

        let libre;
      
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
        const identificadores = document.querySelectorAll('#titulo');
        let vueltas =diasMultiplesSeleccionados.length;
        


        // ## obtengo solo las salidas Seleccionas ID ##
        // salidas.forEach(function(salida,index){
        //   if(index>0){
        //     let salidaS = salida.options[salida.selectedIndex].value;
        //     let integerSalida = parseInt(salidaS)
        //     salidasSeleccionadas.push(integerSalida)
          
        //   }
        // })
        
        // ## obtengo salo las llegas selecciondas ID ##

        // llegadas.forEach(function(llegada,index){
        //   if(index>0){
        //     let llegadaS = llegada.options[llegada.selectedIndex].value;
        //     let integerLlegada = parseInt(llegadaS)
        //     llegadasSelecciondas.push(integerLlegada)
          
        //   }
      
          
        // })
    
     
        
     
 
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
             return dia.checked?1:0
          })
          return diasFiltrados;
        }
      }
      /* Termina el filtrado de dias*/

      //#### se genera un array con los dias ya separados por hoarios
      let ArrayDeDIas =[];
      for (let i = 0; i < identificadores.length; i++) {
        let dias = new FiltroDias(i+1,diasMultiplesSeleccionados)
        ArrayDeDIas.push(dias)
      }
  
     
   
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

      console.log( `Puntos de llegada ${arrayPuntosLlegada}, horas de llegada${arrayHorasLlegada}`)
      console.log(`Puntos de salida${arrayPuntosSalida}, horas de salida${arrayHorasSalida}`)


  


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
        

        // console.log(`clave = ${clave}nombre = ${nombre}active = ${active}remove = ${remove} tipoUnidadId = ${tipoUnidadId}tipoUnidadId = ${tipoUnidadId} tipoactividadesid = ${tipoactividadesid}duracion = ${duracion} minutoincrementa = ${minutoincrementa}
        // montoincremento = ${montoincremento}maxcortesias = ${maxcortesias} maxcupones = ${maxcupones} anticipoid = ${anticipoid} idusuario = ${idusuario} fijo = ${checkFijo} renta = ${checkRenta}  datos Persona = ${datosPersonas}, balance = ${balance}, Precio = ${precio} Libre = ${libre} dias Seleccionandos = ${diasSeleccionados}` )
        let route = 'actividades'
        
        $.ajax({
        url:route,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:'POST',
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
            arrayPuntosSalida:arrayPuntosSalida

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
              // setTimeout("location.reload(true);",1000)
          }
        }
        
        
        })
        
        })



    
   



// AJAX ##########################################################################




// Editar ajax
function editarActividad(e){
   

  const id =  e.parentElement.parentElement.getAttribute('data-id')
  const route =`actividades/${id}/edit`;

  $.get(route, function(data){
    
    $('#clave').val(data.pestana1.actividades[0].clave)
    $('#nombre').val(data.pestana1.actividades[0].nombre)
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
    balanceG.value = data.pestana2.balances[0].balance;
    let precioG = document.getElementById('precioG')
    precioG.value = data.pestana2.balances[0].precio;
    
    let precios = data.pestana2.precios;
    let templete = document.createElement('div');
    let rowPrecios = document.getElementById('preciosContainer')
    rowPrecios.innerHTML="";
    precios.forEach(function(precio){
      console.log(precio)
     
      rowPrecios.innerHTML +=`
              <div class="col-1 padding-col"style="background-color:white" >
                <div class="form-group ">
              <label for="" class=" font-weight-bold" data-id=" ${precio.id}" value="persona${precio.id}" id="persona${precio.id}" >${precio.penombre}</label>
              </div>
              </div>
              <div class="col-1 padding-col" style="background-color: #CCFFFD">
              <div class="form-group">
              <input type="text" name="p1PersonaId${precio.id}" id="p1PersonaId${precio.id}" class="form-control" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" / value="${precio.precio1}">
              </div>
              </div>
              <div class="col-1 padding-col" style="background-color: #CCFFFD">
              <div class="form-group">
              <input type="text" name="p2PersonaId${precio.id}"" id="p2PersonaId${precio.id}" class="form-control" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" / value="${precio.precio2}">
              </div>
              </div>
              <div class="col-1 padding-col" style="background-color: #CCFFFD">
              <div class="form-group">
              <input type="text" name="p3PersonaId${precio.id}" id="p3PersonaId${precio.id}" class="form-control" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" /value="${precio.precio3}">
              </div>
              </div>
              <div class="col-1 padding-col pl-4" style="background-color: #CCFFCC">
              <div class="form-group">
              <input type="text" name="doblePersonaId${precio.id}" id="doblePersonaId${precio.id}" class="form-control" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  value="${precio.doble}"  "/>
              </div>
              </div>
              <div class="col-1 padding-col" style="background-color: #CCFFCC">
              <div class="form-group">
              <input type="text" name="balanceDoblePersonaId${precio.id}" id="balanceDoblePersonaId${precio.id}" class="form-control" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" / value="${precio.doblebalanc}">
              </div>
              </div>
              <div class="col-1 padding-col "style="background-color: #CCFFCC" >
              <div class="form-group">
              <input type="text" name="triplePersonaId${precio.id}" id="triplePersonaId${precio.id}" class="form-control" placeholder="" aria-describedby="helpId"oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="${precio.triple}"/>
              </div>
              </div>
              <div class="col-1 padding-col  "style="background-color: #CCFFCC">
              <div class="form-group">
              <input type="text" name="balanceTriplePersonaId${precio.id}" id="balanceTriplePersonaId${precio.id}" class="form-control" placeholder="" aria-describedby="helpId" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="${precio.triplebalanc}"/>
              </div>
              </div>
              <div class="col-1 padding-col ml-4 " style="background-color: #FFFDCC">
              <div class="form-group">
              <input type="checkbox" class="form-control pases-precios-check ml-3" name="promoPersonaId${precio.id}" id="promoPersonaId${precio.id}" ${precio.promocion==1?checked=true:checked =false} >
              </div>
              </div>
              <div class="col-1 padding-col " style="background-color: #FFFDCC">
              <div class="form-group">                                                   
              <input type="checkbox" class="form-control ml-3 pases-precios-check" name="restriccionPersonaId${precio.id}" id="restriccionPersonaId${precio.id}" value="1" onchange="habilitarAcompnante(this);" data-id="${precio.id}" value="${precio.restriccion}">
              </div>
              </div>
              <div class="col-1 padding-col " style="background-color: #FFFDCC">
              <div class="form-group">
                
                <input type="checkbox" class="form-control ml-3 pases-precios-check" name="acompanantePersonaId${precio.id}" id="acompanantePersonaId${precio.id}" value="1" disabled>
              </div>
              </div>
            `;
           
    })
                     
    // precios
    console.log(precios)

  });
 

}