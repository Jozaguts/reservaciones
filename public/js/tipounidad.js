window.addEventListener('click', function(e){   
    if (document.getElementById('btnUserName').contains(e.target)){
  
      let toggleStatus = 1;
      function toggleMenu (){
        if(toggleStatus==1){
      
          btnLogOut.classList.remove("d-none");
          btnLogOut.classList.add("show");
          toggleStatus = 0;
        }else if(toggleStatus==0){
          btnLogOut.classList.remove("show");
          btnLogOut.classList.add("d-none");
          toggleStatus=1;
        }
      }
      toggleMenu();
      // Clicked in box
    } else{
      if( btnLogOut.classList.contains("show")){
        btnLogOut.classList.remove("show");
        btnLogOut.classList.toggle("d-none");
      } 
    }
  });
//mostrar modal agragar unidad

let btnAddTipoEU = document.getElementById('btnAddTipoEU');
let tipoEUModal = document.getElementById('tipoEUModal');
btnAddTipoEU.addEventListener('click',()=>{
let toggleStatus = 0;
if(toggleStatus==0){
    
    if(tipoEUModal.classList.contains('d-none')){

        tipoEUModal.classList.remove('d-none')
        tipoEUModal.classList.add('showModal')
        toggleStatus=1;
        
    }
}else{
   
    if(toggleStatus=1){
        if(!tipoEUModal.classList.contains('d-none')){
            tipoEUModal.classList.add('d-none')
            toggleStatus=0;
        }
    }
}
 
})

//cerrar modal agregar unidad
let closeModal = document.getElementById('closeModal');

closeModal.addEventListener('click',(e)=>{
    if(e.target == closeModal){
        if(tipoEUModal.classList.contains('showModal')){
            tipoEUModal.classList.remove('showModal')
            tipoEUModal.classList.add('d-none')
        }
    }
})

//////////////////////////////////////// ajax ////////////////////////////////////////////////////

<<<<<<< HEAD
=======
///////////////////////////////////////agreager producto///////////////////////////////////////////////////////////////////////////////////

>>>>>>> jozaguts
let tipoEUForm = document.getElementById('tipoEUForm');

tipoEUForm.addEventListener('submit',(e)=>{
e.preventDefault();
let datos = new FormData(tipoEUForm) 
let nombre = datos.get('nombre')
let combustible = datos.get('combustible')
let medio = datos.get('medio')
let token = $("input[name=_token]").val();
let idusuario = datos.get('idusuario')
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


let route = 'tipounidades'

$.ajax({
  url:route,
  headers:{'X-CSRF-TOKEN':token},
  type:'POST',
  dataType: 'json',
  data: {nombre: nombre, combustible: combustible, medio: medio, idusuario: idusuario, active: active, remove: remove},
  success:function(data)
  {
    if(data.success == 'true')
    {
      $('#tipoEUModal').fadeOut();
      $('#success').html(data.correcto);
      $('#message-success').fadeIn();
      setTimeout(() => {
        $('#message-success').fadeOut();
      }, 3000);
<<<<<<< HEAD
      console.log(data.correcto);
=======
      reload();
>>>>>>> jozaguts
    }  
},
  error:function(data){
    $('#tipoEUModal').fadeOut();
    $('#error').html(data.error);
      $('#message-error').fadeIn();
      setTimeout(() => {
        $('#message-error').fadeOut();
      }, 3000);

    console.log(data.error);
  }

})

<<<<<<< HEAD
})
=======
})


/////////////reload

function reload() {
  location.reload(true);
}


///////////////////////////////////////mostrar modal edit equipo unidad////////////////////////////////////////////////

let tipoEUEditModal = document.getElementById('tipoEUEditModal')
function showEditModal(id){

  let route = "tipounidades/"+id+"/edit";

  $.get(route, function(data){
    $('#editNombre').val(data.nombre);
    $('#editCombustible').val(data.combustible);
    $('#editMedio').val(data.medio);
    $('#editId').val(data.id);
    $('#editRemove').val(data.remove);
    $('#editIdUsuario').val();
   
    
  

    $('#editActive').val(data.active);
    
    if(data.active==0){
      $("#editActive").prop("checked", true);
    }else{
      $("#editActive").prop("checked", false);
    } 
   
  });
    if(tipoEUEditModal.classList.contains("d-none")){
        tipoEUEditModal.classList.remove("d-none")
        tipoEUEditModal.classList.toggle("showModal");
    }
   
}


////////////////////////////////////////// boton actualizar//////////////////////////////////////////////////
//btn actualizar

$('#btnEdit').click(function(){

  let nombre = $('#editNombre').val();
  let id = $('#editId').val();
  let combustible = $('#editCombustible').val();
  let medio = $('#editMedio').val(); 
  let idUsuario = $('#editIdUsuario').val();
  let remove = $('#editRemove').val();
  let active;
  if($('#editActive').is(':checked')){
    active = 0;
  }else{
    active = 1;
  }
  let route =`tipounidades/${id}`
  // let token = $('#token').val();

  $.ajax({
    url: route,
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    type: 'PUT',
    dataType: 'json',
    data: {nombre: nombre, combustible: combustible, medio: medio, active: active, id: id, idusuario: idUsuario, remove: remove },

    success: function (data) {
  
      if(data.success == 'true')
      {

        $('#tipoEUEditModal').fadeOut();
        $('#success').html(data.correcto);
        $('#message-success').fadeIn();
        setTimeout(() => {
          $('#message-success').fadeOut();
        }, 3000);
        setTimeout("location.reload(true);",3000)
        
      }
    },
    error:function(data)
    {
      if(data.status==422){
      
      }
    }
  })
})


/////////close modal edit////////////////////////
const closeModalEdit = document.getElementById("closeModalEdit");

closeModalEdit.addEventListener('click',()=>{
  if(tipoEUEditModal.classList.contains('showModal')){
    tipoEUEditModal.classList.remove('showModal');
    tipoEUEditModal.classList.add('d-none');
    }
})




///////////////////////////////////////////////////////



///////////////////////////////delete Unidad equipo////////////////////////////////
//delete user
$(document).ready(function() {
  
  $('.btn-delete').click(function(){

    
     var row = $(this).parents('tr');
     var id = row.data('id');
     var form = $('#form-delete');
     var url = form.attr('action').replace(':TIPO_ID', id);
     var data = form.serialize();
     var name = row.data('name');
     console.log(url);

     let alert = confirm('¿Desea eiliminara a: ' + name);

     if(alert == true){
      row.fadeOut();

      $.post(url,data, function(result){
           alert(result);
      });
     }

     
  });
});

 //color para el tr si esta desactivado
 let elements = document.querySelectorAll('[data-active="0"]');
 elements .forEach(element => {
    element.classList.add('tr-bg');
});
>>>>>>> jozaguts
