
$(document).ready(function () {

  // LISTENERS
  // addEventListener para el boton  del +combo y mostrar el modal para agregar un combo
 $(document).on('click', '.show-btn', function () {
  $(this).siblings('div').toggleClass('d-none')

  });


  $(document).on('click','.btn-agregar', function(e){
    let id = e.target.parentElement.children[1].value;
    obtenerActividad(id)  
  })

  // FUNCIONES
      // obtenerActividad() devuelve un array con la info de la activiad y la info de sus horarios
  function obtenerActividad(id){
    let infoactividad;
  
    fetch(`/info-actividad/${id}`)
    .then((response) => {
      return response.json();
    }).then((responseJson)=>{
      infoactividad = responseJson;
      cargarActividad(infoactividad)
    }).catch((err) => {
      console.log(err);
    })
  return infoactividad;
  }
    // funcion convierte la hora de un input time en entero para poder sumar o restar y asi hacer los multiples options 
    // del select en el mini crud
    function timeStringToFloat(time) {
      var hoursMinutes = time.split(/[.:]/);
      var hours = parseInt(hoursMinutes[0], 10);
      var minutes = hoursMinutes[1] ? parseInt(hoursMinutes[1], 10) : 0;
      return parseInt( hours + minutes / 60);
    }

    //cargarActiviad() pinta en pantalla la activiad
    let activiadesInsertadas =[];
  function cargarActividad(actividad){
      let horarios = actividad.infoactiviadhorario;
          
      if(!activiadesInsertadas.includes(actividad.infoactivad[0].clave)){
          for(let i=0; i<actividad.infoactivad.length; i++) {
              let idActividad = actividad.infoactivad[i].id;
              let duracion = actividad.infoactivad[i].duracion;
                  $('#bodyTable').append(`
                <tr class="actividad-id">
                <input type="hidden" name="idActividad${idActividad}" value="${idActividad}">
                <td scope="row">${actividad.infoactivad[i].clave}</td>
                <td>${actividad.infoactivad[i].nombre}</td>
                <td class="precioFix">${actividad.infoactivad[i].precio}</td>
                <td class="balanceFix">${actividad.infoactivad[i].balance}</td>
                <td colspan="5"><div class="form-group">
                    <label for=""></label>
                    <select class="form-control select-info" name="select${actividad.infoactivad[i].id}" id="${actividad.infoactivad[i].id}">
                  
                    
                    </select>
                    <a href="#!" class="btn btn-danger ml-3 btn-eliminar" data-index="${i}" name="">-</a>
                  </div> 
                </td>
              </tr>
                  `)
                  // esta funcion recive como parametros el id del select y los horarios
            
                  insertaOPtions(horarios,idActividad, duracion);
                  activiadesInsertadas.push(actividad.infoactivad[i].clave)
                  cambiaAMoneda("balanceFix")
                  cambiaAMoneda("precioFix")
                  $('#alerta').html('')
              }
          }else{
            $('#alerta').addClass('text-danger ml-5')
            $('#alerta').text('Solo Puedes Agregar una Vez Cada Actividad')
            let a = document.createElement('a');
            a.innerText= 'X';
            a.setAttribute('href','#')
            a.classList.add('close','ml-3')
            $('#alerta').append(a);     
          }



 
    
  }
      
  // funcion para insertear opciones en cada select
  function insertaOPtions(infoactiviadeshorarios, idselect, duracion) {
   
    let select = document.querySelector(`select[name=select${idselect}]`)
    for(let i = 0; i<infoactiviadeshorarios.length; i++) {
        let resultado ,hiniHorario,hfinHorario;
    
        if(infoactiviadeshorarios[i].libre==1) {    
            hiniHorario  = timeStringToFloat(infoactiviadeshorarios[i].hini)
            hfinHorario =timeStringToFloat(infoactiviadeshorarios[i].hfin)
            resultado = hfinHorario - hiniHorario;
        }else if (infoactiviadeshorarios[i].libre==0){
      
          if(infoactiviadeshorarios[i].actividades_id == idselect) {
            let option = document.createElement("option")
            option.innerHTML =infoactiviadeshorarios[i].horario
            select.appendChild(option)
          select.nextElementSibling.setAttribute('data-horarioid', infoactiviadeshorarios[i].id)
          }
        }
          if(infoactiviadeshorarios[i].actividades_id == idselect) {    
            for (let j = 0; j < resultado; j++) {
              let hf = `${hiniHorario+j+ (duracion/60)}:00`;
              let paste = hf.padStart(5,"0") +" | " + infoactiviadeshorarios[i].horario.substring(18, infoactiviadeshorarios[i].horario.length);
              
              let option = document.createElement("option")
              let hi = `${hiniHorario+j}:00`.padStart(5,"0");
              option.innerHTML =`${hi} | ${paste}`;
              option.setAttribute('data-hora',hiniHorario+j)
              select.appendChild(option)
              select.nextElementSibling.setAttribute('data-horarioid', infoactiviadeshorarios[i].id)
            }
        
        }else{ 
          $('#myTab').text('no se puuede')
        }
    
    }
    
   }
  

// elimniar fila en el mini crud

    document.addEventListener('submit',function(e){
      e.preventDefault();
    })

document.addEventListener('click',function(e){
  
  if(e.target.classList.contains('btn-eliminar')) {
    let parent = e.target.parentNode.parentNode.parentNode;
    let index = e.target.getAttribute('data-index');  

    if(confirm("Eliminiar Actividad") == true){
      parent.remove();
      delete activiadesInsertadas[index]
    
      activiadesInsertadas.length -= 1
    }    
  }

  if(e.target.classList.contains('btn-guardar')) {
    let arrayDataSet =[];
    let mismodia = $('#mismodia').prop('checked')
    let dataform = $('#combosForm').serializeArray();
    // let dataPreciosYpases =$('#AddPreciosYPasesForm').serializeArray();

    // let datadataPreciosYpases={};

   

    let data = {};
    $(dataform).each(function(index, obj){
      data[obj.name] = obj.value;
     
    });
    data.mismodia = mismodia;
    // trs fila que contiene info de actividad y horarios
    let trs = document.querySelectorAll('.actividad-id');

    trs.forEach(function(tr,index){
  
      let dataSet={
        hini: "",
        hfin: "",
        actividades_id: "",
        horario_id: "",
        usuarios_id: $('#idUsuario').val(),
        active: 1,
        remove: 0};
      let fd = $(tr).find('select').val()
      let  hini =fd.substring(0, 5)
      let  hfin =fd.substring(8, 13)
      let idAct = $(tr)[0].children[0].value;
      dataSet.hini = hini
      dataSet.hfin = hfin
      let horarioId = $(tr).find('a').data('horarioid')
      dataSet.horario_id =horarioId
      dataSet.actividades_id = idAct; 
      arrayDataSet.push(dataSet)
    })
    data.dataSet=arrayDataSet;
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
       
    // $(dataPreciosYpases ).each(function(index, obj){
    //   datadataPreciosYpases[obj.name] = obj.value;
    // });
  
    // data.preciosYpases =datadataPreciosYpases
    data.datosPersonas =datosPersonas
    data.precio = precio;
    data.balance =balance;
  
   
    let horarioId = $('.btn-eliminar').data('horarioid')

// Comienza la el ajax para guardar combos
    fetch('/combos',{
      method: 'POST', // or 'PUT'
      body: JSON.stringify(data), 
      headers:{
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
    .then(function(response){
      return response.json();
    })
      .then(function(responseJson){
        if(responseJson['message'] != 'Combo Guardado'){
          // data.errors.forEach(()=>{})
          
          $('#errorsIntoModal').html(responseJson.errors[0]);
            $('#message-errorIntoModal').fadeIn();
            setTimeout(() => {
              $('#message-errorIntoModal').fadeOut();
            }, 3000);
            // setTimeout("location.reload(true);",3000)
            
        }else{
          $('#successIntoModal').html(responseJson['message']);
            $('#message-successIntoModal').fadeIn();
            setTimeout(() => {
              $('#message-successIntoModal').fadeOut();
            }, 3000);
            // setTimeout("location.reload(true);",3000)
        }
     
      })
  } /* termina boton guardar */
    

})

// editar combo 

$(document).on('click','.btn-editar', function(e){
  const ID = e.target.getAttribute('data-id');
  var token = $("input[name='_token']").val();
 
  let info;
  fetch(`combos/${ID}/edit`,{
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json",
      "X-Requested-With": "XMLHttpRequest",
      "X-CSRF-Token": $('input[name="_token"]').val()
    },
  })
  .then((response) => {
    return response.json();
  }).then((responseJson)=>{

    // empieazo a rellenar el modal 
    info = responseJson;
    

    $('#clave').val(info.infoCombo[0].clave);
    $('#nombre').val(info.infoCombo[0].nombre);
    $('#tipoactividades_id').val(info.infoCombo[0].tipoactividades_id);
    $('#maxCortesias').val( info.infoCombo[0].maxcortesias)
    $('#maxCupones').val(info.infoCombo[0].maxcupones)
    $('#anticipoId').val(info.infoCombo[0].anticipo_id)
    info.infoCombo[0].mismo_dia == '1'? $('#mismodia').attr('checked', true):$('#mismodia').attr('checked', false);

    // pestaña 2 
    $('#balanceG').val(info.infoCombo[0].balance);
    $('#precioG').val(info.infoCombo[0].precio);

     let precios = info.activiadadPrecios
     
    // personas
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



    //  minicrud empieza
     let comboActividades = info.horarios;
      
     comboActividades.forEach(function(comboActividad, index){
      
      $('#bodyTable').append(`
      <tr class="actividad-id">
      <input type="hidden" name="idActividad${comboActividad.id}" value="${comboActividad.id}">
      <td scope="row">${comboActividad.clave}</td>
      <td>${comboActividad.nombre}</td>
      <td class="precioFix">${comboActividad.precio}</td>
      <td class="balanceFix">${comboActividad.balance}</td>
      <td colspan="5"><div class="form-group">
          <label for=""></label>
       
           <select class="form-control select-info" name="selectEdit${comboActividad.id}" id="${comboActividad.id}">
                  
                    
          </select>
          <a href="#!" class="btn btn-danger ml-3 btn-eliminar" data-index="${index}" name="">-</a>
        </div> 
      </td>
    </tr>`
      )
      insertaOPtionsEdit(comboActividades,comboActividad.id,comboActividad.duracion)
 //  <div id ="selectContainer${comboActividad.id}"></div>
    })
   
  function insertaOPtionsEdit(infoDeHorariosDeUnaActividadCombo, IdSelectArrellenar, duracionActividad) {
   
    let select = document.querySelector(`select[name=selectEdit${IdSelectArrellenar}]`)
   
    for(let i = 0; i<infoDeHorariosDeUnaActividadCombo.length; i++) {
      console.log(infoDeHorariosDeUnaActividadCombo.length)
        let resultado ,hiniHorario,hfinHorario;
  
        if(infoDeHorariosDeUnaActividadCombo[i].libre==1) {    
       
            hiniHorario  = timeStringToFloat(infoDeHorariosDeUnaActividadCombo[i].hini)
            hfinHorario =timeStringToFloat(infoDeHorariosDeUnaActividadCombo[i].hfin)
            resultado = hfinHorario - hiniHorario;
         
        }else if (infoDeHorariosDeUnaActividadCombo[i].libre==0){
        
          if(infoDeHorariosDeUnaActividadCombo[i].id == IdSelectArrellenar) {
            let option = document.createElement("option")
            option.innerHTML =infoDeHorariosDeUnaActividadCombo[i].horario
            
            select.appendChild(option)
           
          select.nextElementSibling.setAttribute('data-horarioid', infoDeHorariosDeUnaActividadCombo[i].id)
          }
        }
          if(infoDeHorariosDeUnaActividadCombo[i].id == IdSelectArrellenar) {    
            for (let j = 0; j < resultado; j++) {
              let hf = `${hiniHorario+j+ (duracionActividad/60)}:00`;
              let paste = hf.padStart(5,"0") +" | " + infoDeHorariosDeUnaActividadCombo[i].horario.substring(18, infoDeHorariosDeUnaActividadCombo[i].horario.length);
              
              let option = document.createElement("option")
              let hi = `${hiniHorario+j}:00`.padStart(5,"0");
              option.innerHTML =`${hi} | ${paste}`;
              option.setAttribute('data-hora',hiniHorario+j)
              select.appendChild(option)
              select.nextElementSibling.setAttribute('data-horarioid', infoDeHorariosDeUnaActividadCombo[i].id)
            }
        
        }else{ 
          $('#myTab').text('no se puuede')
        }
    
    }
    
   }

    // let horariosCombos = info.horarios;
   
    // let lenghtHorarios = horariosCombos.length; /* Cantidad de horarios == cuantas actividades tiene el combo */
    //  for (let i = 0; i < lenghtHorarios; i++) {
    //    let selectHorarios =document.createElement('select');
    //    selectHorarios.classList.add('form-control');
    //    if(horariosCombos[i].libre==1){
    //     let hini=horariosCombos[i].hini.slice(0,2,), hfin = horariosCombos[i].hfin.slice(0,2); 
    //     hini == "00"? hini="12":hini
    //     hfin == "00"? hfin="12":hfin
    //     let length = hfin - hini; /* longitud de iteraciones para las opciones de los selects "Horas en los selects"    */

        
    //    // esta zona es solo para crear las opciones de los selects, los selects de cada horario
    //    for (let j = 0; j <=length; j++) {
  
    //     // if(horariosCombos[i].libre == 1){ /* si no es horario libre se procede una una manera */
       
    //         hini.replace('0',"");  /* obtengo la hora de inicio y le retiro el 0 para hacer la suma de horas */
    //         hfin.replace('0',""); 
            
    //         let numerodelahoraHini = Number(hini)+j; /* hora inicial */
            
    //         let horaInicial ="";
    //         numerodelahoraHini < 10 ?horaInicial = String("0"+numerodelahoraHini):horaInicial=String(numerodelahoraHini)
            
    //         let minutosHini = horariosCombos[i].horario.substring(3,5); /* despues de la hora obtengo los minutos y la linea separadora */
    //         let numerodelahoraHfin = Number(hini)+j+1; /* obtengo la hora inicial y le sumo 1 hora  */
    //         let horaFinal="";
    //         numerodelahoraHfin <10 ? horaFinal= String("0"+ numerodelahoraHfin): horaFinal = String( numerodelahoraHfin);
             
    //         let diasActividad = horariosCombos[i].horario.substring(16,horariosCombos[i].horario.length)
            
    //         let option = document.createElement('option');
    //         option.innerText = `${horaInicial}:${minutosHini} | ${horaFinal}:${minutosHini} | ${diasActividad}`;

          
    //       selectHorarios.appendChild(option)
    //       // 
    //     // } 
    
    //    }
    //    } else if(horariosCombos[i].libre == 0){
    //     console.log('entro');
    //      // hini.replace('0',"");  /* obtengo la hora de inicio y le retiro el 0 para hacer la suma de horas */
    //      // hfin.replace('0',""); 
         
    //      // let numerodelahoraHini = Number(hini)+j; /* hora inicial */
   
    //      // let horaInicial ="";
       
    //   }
     
       
 
    //     document.getElementById('selectContainer').appendChild(selectHorarios)
 
    //  }
  }).catch((err) => {
    console.log(err);
  })
  
  $('#combos').modal('show')
  
})




});
  // VALIDACIONES ####
  
  let generalInputs = document.querySelectorAll('.general');
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
          $('#combos').modal('hide');
          $(this).find('form').trigger('reset');
          setTimeout("location.reload(true);",1000)
        }else{
      
        }
       
       }else{
        $('#combos').modal('hide');
       }
       let allCheckbox = document.querySelectorAll('[class~=check-clean]')
      
       allCheckbox.forEach(function(check){
       check.removeAttribute("unchecked");
       check.removeAttribute("checked");
       })
       
      }


      function cambiaAMoneda(clase){
        let balanceFix = document.querySelectorAll(`.${clase}`)
       
        balanceFix.forEach(function(balance){
         let setter =  Math.round(Number(balance.textContent.replace('MX$', "")));
        
       
         balance.innerText = `${setter.toLocaleString('en-IN', { style: 'currency', currency: 'MXN' })}`;
         
         ;
        })
      }

      // habilitar acompañate 
      habilitarAcompnante = (e)=>{
        let id = e.getAttribute('data-id');
        let checkAcompanante = document.querySelector(`#acompanantePersonaId${id}`)
        
        if(e.checked){
        
        checkAcompanante.disabled = false;
        }else{
        checkAcompanante.disabled = true;
        }
        }