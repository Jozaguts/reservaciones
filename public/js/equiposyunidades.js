
showContent = function (e){
  e.nextSibling.nextSibling.classList.contains('d-none')?e.nextSibling.nextSibling.classList.toggle('show')&&e.nextSibling.nextSibling.classList.remove('d-none'):e.nextSibling.nextSibling.classList.add('d-none')
}


//btns unidad equipo
let btnShowAddEU = document.getElementById('btnShowAddEU')
let modalAddEU = document.getElementById('modalAddEU')

let btnAddEU = document.getElementById('btnAddEU') 

// Show modal add Equipo o Unidad

btnShowAddEU.addEventListener('click',()=>{
    
    let toggleStatus = 0;
    if(toggleStatus==0){
        
        if(modalAddEU.classList.contains('d-none')){
    
            modalAddEU.classList.remove('d-none')
            modalAddEU.classList.add('showModal')
            toggleStatus=1;
            
        }
    }else{
       
        if(toggleStatus=1){
            if(!modalAddEU.classList.contains('d-none')){
                modalAddEU.classList.add('d-none')
                toggleStatus=0;
            }
        }
    }
     
    })


// close modal add equipo y unidades 
let closeModal = document.getElementById('closeModal');

closeModal.addEventListener('click',(e)=>{
    if(e.target == closeModal){
        if(modalAddEU.classList.contains('showModal')){
            modalAddEU.classList.remove('showModal')
            modalAddEU.classList.add('d-none')
        }
    }
})


// form add equipo y unidades
let eUForm = document.getElementById('eUForm')

// action to submit 
eUForm.addEventListener('submit',(e)=>{
        e.preventDefault();
        // alert('fuciona')
        let datos = new FormData(eUForm) 
        let clave = datos.get('clave')
        let descripcion = datos.get('descripcion')
        let capacidad = datos.get('capacidad')
        let color = datos.get('color')
        let placa = datos.get('placa')
        let token = $("input[name=_token]").val();
        let idusuario = datos.get('idusuario')
     
        let idtipounidad = datos.get('idtipounidad');
        let todosLosDias =0, totalDias=0, Lunes,Martes,Miercoles,Jueves,Viernes,Sabado,Domingo;
            iTD = $('#inicioTodosLosDias').val(),
            fTD =  $('#finTodosLosDias').val(),
            ilunes= $('#inicioL').val(),
            imartes= $('#inicioM').val(),
            imiercoles= $('#inicioX').val(),
            ijueves= $('#inicioJ').val(),
            iviernes= $('#inicioV').val(),
            isabado= $('#inicioS').val(),
            idomingo= $('#inicioD').val(),
            flunes= $('#finL').val(),
            fmartes= $('#finM').val(),
            fmiercoles= $('#finX').val(),
            fjueves= $('#finJ').val(),
            fviernes= $('#finV').val(),
            fsabado= $('#finS').val(), 
            fdomingo= $('#finD').val()
           
       
        if($('#todosLosDias').is(':checked')){
          todosLosDias = todosLosDias+1;
          }else{
            todosLosDias = todosLosDias; 
            if($('#L').is(':checked')){
              totalDias = totalDias+1;
               Lunes = 'L';
            }else{
              totalDias = totalDias;
              Lunes= '';
            }
            if($('#M').is(':checked')){
              totalDias = totalDias+1;
               Martes = 'M';
            }else{
              totalDias = totalDias;
              Martes='';
            }
            if($('#X').is(':checked')){
              totalDias = totalDias+1;
               Miercoles = 'X';
            }else{
              totalDias = totalDias;
              Miercoles='';
            }
            if($('#J').is(':checked')){
              totalDias = totalDias +1;
               Jueves = 'J';
            }else{
              totalDias = totalDias;
              Jueves='';
            }
            if($('#V').is(':checked')){
              totalDias = totalDias+1;
               Viernes = 'V';
            }else{
              totalDias = totalDias;
              Viernes='';
            }
            if($('#S').is(':checked')){
              totalDias = totalDias+1;
               Sabado = 'S';
            }else{
              totalDias = totalDias;
              Sabado = '';
            }
            if($('#D').is(':checked')){
              totalDias = totalDias+1;
               Domingo = 'D';
            }else{
              totalDias = totalDias;
              Domingo ='';
            }
          }
                
        
  
      
        let active;
          if($('#active').is(':checked')){
            active = 0;
          }else{
            active = 1;
          }
          let remove;
          if($('#remove').is(':checked')){
            remove = 0;
          }else{
            remove = 1;
          }
        
        
        let route = 'unidades'
   
        $.ajax({
          url:route,
          headers:{'X-CSRF-TOKEN':token},
          type:'POST',
          dataType: 'json',
          data: {clave: clave, descripcion: descripcion, capacidad: capacidad, color: color, idusuario: idusuario, active: active, remove: remove, placa: placa, idtipounidad: idtipounidad, todosLosDias: todosLosDias, iTD: iTD, fTD:fTD, ilunes:ilunes, imartes: imartes, imiercoles: imiercoles, ijueves: ijueves, iviernes: iviernes, isabado: isabado, idomingo: idomingo, flunes:flunes, fmartes:fmartes,fmiercoles: fmiercoles, fjueves:fjueves, fviernes:fviernes, fsabado:fsabado, fdomingo:fdomingo, Lunes:Lunes, Martes:  Martes, Miercoles: Miercoles, Jueves: Jueves, Viernes: Viernes, Sabado: Sabado,Domingo: Domingo, totalDias:totalDias},
          success:function(data)
          {

            if(data.success == 'false')
              {
                  // $('#registerModal').fadeOut();
              data.error.forEach(function(error){
                $('#errorsIntoModal').html(error);
                $('#message-errorIntoModal').fadeIn();
              });
                } 
                else{
                  $('#successIntoModal').html(data.correcto);
                  $('#message-successIntoModal').fadeIn();
                  setTimeout(() => {
                    $('#modalAddEU').fadeOut();
                  }, 3000);
                  // setTimeout("location.reload(true);",3000)
              } 
  
        },

        
        })
        
        })



// Show edit modal equipo y unidades 
let modalEditEquipoUnidad = document.getElementById('modalEditEquipoUnidad')

function showEditModal(id){

  let route = "unidades/"+id+"/edit";

  $.get(route, function(data){
    $('#editClave').val(data.unidad.clave);
    $('#editDescripcion').val(data.unidad.descripcion);
    $('#editCapacidad').val(data.unidad.capacidad);
    $('#editColor').val(data.unidad.color);
    $('#editRemove').val(data.unidad.remove);
    $('#editPlaca').val(data.unidad.placa)
    $('#editId').val(data.unidad.id)
    $('#editIdUsuario').val();
    $('#editActive').val(data.unidad.active);
    $('#editIdTipoUnidad').val(data.unidad.idtipounidad);
    

// ***********************set values into input:time*******************************
// ##Laravel## 
// get two querys from two diferents tables  
    // get all schedules
    let schedules = data.unidadHorario;

    // get all the input where I'm going to insert the schedules
    let inputEditSchedules = document.querySelectorAll(' input[id*="inputTimeInicioedit"]')
    let inputEditSchedulesFin = document.querySelectorAll(' input[id*="inputTimeFinedit"]')
    // with two foreach
    // the first one is the input and then the one of the schedule
    // I verify if within the classlist of each input it has a class in specifies,
    //  if it is certain I assign the values to that input
    inputEditSchedules.forEach(input => { //open first 
      schedules.forEach(schedule => { //open second
        if(input.classList.contains(schedule.dia) ){ //check have specifies class if its true  
          input.value = schedule.hini //set value into input
        }
      });
    });



    inputEditSchedulesFin.forEach(input => { //open first 
      schedules.forEach(schedule => { //open second
        if(input.classList.contains(schedule.dia) ){ //check have specifies class if its true  
          input.value = schedule.hfin //set value into input
        }
      });
    });
   
      

   
    
    if(data.active==0){
      $("#editActive").prop("checked", true);
    }else{
      $("#editActive").prop("checked", false);
    } 
   
  });
    if(modalEditEquipoUnidad.classList.contains("d-none")){
        modalEditEquipoUnidad.classList.remove("d-none")
        modalEditEquipoUnidad.classList.toggle("showModal");
    }
   
}
/////////close modal edit////////////////////////
const closeModalEdit = document.getElementById("closeModalEdit");

closeModalEdit.addEventListener('click',()=>{
  if(modalEditEquipoUnidad.classList.contains('showModal')){
    modalEditEquipoUnidad.classList.remove('showModal');
    modalEditEquipoUnidad.classList.add('d-none');
    }
})

////////////////////////////////////////// boton actualizar//////////////////////////////////////////////////
//btn actualizar

$('#btnEdit').click(function(){

  let clave = $('#editClave').val();
  let descripcion = $('#editDescripcion').val();
  let capacidad = $('#editCapacidad').val();
  let color = $('#editColor').val(); 
  let idtipounidad = $('#editIdTipoUnidad').val();
  let idusuario = $('#editIdUsuario').val();
  let remove = $('#editRemove').val();
  let id = $('#editId').val();
  let placa = $('#editPlaca').val()
 
  let editIL = $('#inputTimeInicioeditL').val()
  let editIM = $('#inputTimeInicioeditM').val()
  let editIX= $('#inputTimeInicioeditX').val()
  let editIJ= $('#inputTimeInicioeditJ').val()
  let editIV= $('#inputTimeInicioeditV').val()
  let editIS= $('#inputTimeInicioeditS').val()
  let editID= $('#inputTimeInicioeditD').val()
  let editFL= $('#inputTimeFineditL').val()
  let editFM= $('#inputTimeFineditM').val()
  let editFX= $('#inputTimeFineditX').val()
  let editFJ= $('#inputTimeFineditJ').val()
  let editFV= $('#inputTimeFineditV').val()
  let editFS= $('#inputTimeFineditS').val()
  let editFD= $('#inputTimeFineditD').val()
  let editTodosLosDias =0, editTotalDias=0;  
  let Lunes,Martes,Miercoles,Jueves,Viernes,Sabado,Domingo;


  // let InputsTimes = document.querySelectorAll('input[id*=inputTime]');

      

  //       for (let index = 0; index < InputsTimes.length; index++) {
          
  //         const inputsArray = InputsTimes[index].value
  //         let r= [...inputsArray]
    
        
  //     }

  if($('#editTodosLosDias').is(':checked')){
    editTodosLosDias = editTodosLosDias+7;
    }else{
      // editTodosLosDias = editTodosLosDias; 
      if($('#editL').is(':checked')){
        editTotalDias = editTotalDias+1;
         Lunes = 'L';
      }else{
        editTotalDias = editTotalDias;
        Lunes= '';
      }
      if($('#editM').is(':checked')){
        editTotalDias = editTotalDias+1;
         Martes = 'M';
      }else{
        editTotalDias = editTotalDias;
        Martes='';
      }
      if($('#editX').is(':checked')){
        editTotalDias = editTotalDias+1;
         Miercoles = 'X';
      }else{
        editTotalDias = editTotalDias;
        Miercoles='';
      }
      if($('#editJ').is(':checked')){
        editTotalDias = editTotalDias +1;
         Jueves = 'J';
      }else{
        editTotalDias = editTotalDias;
        Jueves='';
      }
      if($('#editV').is(':checked')){
        editTotalDias = editTotalDias+1;
         Viernes = 'V';
      }else{
        editTotalDias = editTotalDias;
        Viernes='';
      }
      if($('#editS').is(':checked')){
        editTotalDias = editTotalDias+1;
         Sabado = 'S';
      }else{
        editTotalDias = editTotalDias;
        Sabado = '';
      }
      if($('#editD').is(':checked')){
        editTotalDias = editTotalDias+1;
         Domingo = 'D';
      }else{
        editTotalDias = editTotalDias;
        Domingo ='';
      }
    }
          
    
    let dias =  [
                ['L', editIL,editFL],
               [ 'M', editIM,editFM],
               [ 'X', editIX,editFX],
               [ 'J', editIJ,editFJ],
               [ 'V',editIV,editFV ],
               [ 'S', editIS,editFS],
               [ 'D',editID,editFD]
              ];
    
  // let horarioId = ;







  let active;
  if($('#editActive').is(':checked')){
    active = 0;
  }else{
    active = 1;
  }
  let route =`unidades/${id}`
  // let token = $('#token').val();

  $.ajax({
    url: route,
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    type: 'PUT',
    dataType: 'json',
    data: {clave: clave, descripcion: descripcion, capacidad: capacidad, color: color, idtipounidad: idtipounidad, idusuario: idusuario, remove: remove, active: active, placa: placa, id: id, editIL: editIL, editIM: editIM, editIX: editIX, editIJ: editIJ, editIV: editIV, editIS: editIS, editID: editID, editFL: editFL, editFM: editFM, editFX: editFX, editFJ: editFJ, editFV: editFV, editFS: editFS, editFD: editFD, Lunes:Lunes, Martes:  Martes, Miercoles: Miercoles, Jueves: Jueves, Viernes: Viernes, Sabado: Sabado,Domingo: Domingo,editTodosLosDias: editTodosLosDias, editTotalDias:editTotalDias, dias: dias },

    success: function (data) {
  
      if(data.success == 'true')
      {

        $('#modalEditEquipoUnidad').fadeOut();
        $('#success').html(data.correcto);
        $('#message-success').fadeIn();
        // setTimeout(() => {
        //   $('#message-success').fadeOut();
        // }, 3000);
        // setTimeout("location.reload(true);",3000)
        
      }
    },
    error:function(data)
    {
      if(data.status==422){
      
      }
    }
  })
})
//color para el tr si esta desactivado
// change color an element  by status "active" or "disabled"
let elements = document.querySelectorAll('[data-active="0"]');
elements .forEach(element => {
   element.classList.add('tr-bg');
});


// Eliminar unidad
$(document).ready(function() {
  
  $('.btn-delete').click(function(){

    
     var row = $(this).parents('tr');
     var id = row.data('id');
     var form = $('#form-delete');
     var url = form.attr('action').replace(':UNIDAD_ID', id);
     var data = form.serialize();
   
     var name = row.data('clave');


     let alert = confirm('¿Desea eiliminara a: ' + name);

     if(alert == true){
      row.fadeOut();

      $.post(url,data, function(result){
           
        if(result.success == 'true')
        {

          // $('#modalEditEquipoUnidad').fadeOut();
          $('#success').html(result.correcto);
          $('#message-success').fadeIn();
          setTimeout(() => {
            $('#message-success').fadeOut();
          }, 3000);
          setTimeout("location.reload(true);",3000)
          
        }else{
          $('#modalEditEquipoUnidad').fadeOut();
          $('#success').html(result.error);
          $('#message-success').fadeIn();
          setTimeout(() => {
            $('#message-success').fadeOut();
          }, 3000);
          setTimeout("location.reload(true);",3000)
        }


      });
     }

     
  });
});

// seleccionar todos los checkbox y desactivar todos inputs
let todosLosDias = document.getElementById('todosLosDias')
let inputsTime = document.querySelectorAll(' input[class*="input-time"]')   

todosLosDias.addEventListener('change',e=>{
  if(e.target.checked){
    checkboxs = document.querySelectorAll('input[class=day]')
    checkboxs.forEach((check)=>{
      check.checked = true;
    })
    inputsTime.forEach((input)=>{
      input.disabled = true;
    })

}else{
   if(e.target.checked == false){
     checkboxs = document.querySelectorAll('input[class=day]')
     checkboxs.forEach((check)=>{
       check.checked = false;
     })
    //  inputsTime.forEach((input)=>{
    //    input.disabled = false;
    //  })
 }
 }
})

//habilitar input time

habilitarInput = (e)=>{
  let inputInicio = document.querySelectorAll(`input[id=inicio${e.id}]`)
  let inputFin = document.querySelectorAll(`input[id=fin${e.id}]`)
  
  if(inputFin[0].disabled == true ||inputInicio[0].disabled == true ){
    inputFin[0].disabled = false;
    inputInicio[0].disabled = false;
  }else{
    if(inputFin[0].disabled == false ||inputInicio[0].disabled == false){
      inputFin[0].disabled = true;
      inputInicio[0].disabled = true;
    }
  }
  
  }

  
  habilitarEditInput = (e)=>{
   
    let inputEditInicio = document.querySelectorAll(`input[id=inputTimeInicio${e.id}]`)
    let inputEditFin = document.querySelectorAll(`input[id=inputTimeFin${e.id}]`)
 
    
    if(inputEditFin[0].disabled == true ||inputEditInicio[0].disabled == true ){
      inputEditFin[0].disabled = false;
      inputEditInicio[0].disabled = false;
    }else{
      if(inputEditFin[0].disabled == false ||inputEditInicio[0].disabled == false){
        inputEditFin[0].disabled = true;
        inputEditInicio[0].disabled = true;
      }
    }
    
    }
    const editTodosLosDias = document.getElementById('editTodosLosDias');

    editTodosLosDias.addEventListener('change',e=>{
      if(e.target.checked){
        checkboxs = document.querySelectorAll('input[class=day]')
        checkboxs.forEach((check)=>{
          check.checked = true;
        })
        inputsTime.forEach((input)=>{
          input.disabled = true;
        })
    
    }else{
       if(e.target.checked == false){
         checkboxs = document.querySelectorAll('input[class=day]')
         checkboxs.forEach((check)=>{
           check.checked = false;
         })
        //  inputsTime.forEach((input)=>{
        //    input.disabled = false;
        //  })
     }
     }
    })