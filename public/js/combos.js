
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
          option.innerHTML =infoactiviadeshorarios[i].horario;
          select.appendChild(option)
        select.nextElementSibling.setAttribute('data-horarioid', infoactiviadeshorarios[i].id)
        }
      }
        if(infoactiviadeshorarios[i].actividades_id == idselect) {

          for (let j = 0; j < resultado; j++) {
            let paste = infoactiviadeshorarios[i].horario.substring(10, infoactiviadeshorarios[i].horario.length);
            let option = document.createElement("option")
            option.innerHTML =`${hiniHorario+j}:00:00 |${paste}`;
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
    $(dataform ).each(function(index, obj){
      data[obj.name] = obj.value;
    });
    data.mismodia = mismodia;

    // trs fila que contiene info de actividad y horarios
    let trs = document.querySelectorAll('.actividad-id');

    trs.forEach(function(tr,index){
  
      let dataSet={hini: "",
        hfin: "",
        actividades_id: "",
        actividades_id_combo: "",
        horario_id: "",
        usuarios_id: "",
        active: "",
        remove: ""};
      let fd = $(tr).find('select').val()
      let  hini =fd.substring(0, 8)
      let  hfin =fd.substring(10, 19)
      dataSet.hini = hini
      // let idAct = $(tr)[0].children[0].value; 
      // let idAct = $(tr)[0].children[0].value;
      dataSet.hfin = hfin
      let horarioId = $(tr).find('a').data('horarioid')
      dataSet.horario_id =horarioId
      dataSet.actividades_id =data.idActividad
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
    console.log(data)
   
    let horarioId = $('.btn-eliminar').data('horarioid')

// Comienza la el ajax para guardar combos
    fetch('/combos',{
      method: 'POST', // or 'PUT'
      body: JSON.stringify(data), // data can be `string` or {object}!
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
        console.log(responseJson.errors[0])
      })
  }
    

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