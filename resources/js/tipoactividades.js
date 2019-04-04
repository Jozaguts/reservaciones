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

  //mostrar modal agregar Actividad

let btnAddTipoActividad = document.getElementById('btnAddTipoActividad');
let modalAddTipoActidades = document.getElementById('modalAddTipoActidades');
btnAddTipoActividad.addEventListener('click',()=>{
let toggleStatus = 0;
if(toggleStatus==0){
    
    if(modalAddTipoActidades.classList.contains('d-none')){

        modalAddTipoActidades.classList.remove('d-none')
        modalAddTipoActidades.classList.add('showModal')
        toggleStatus=1;
        
    }
}else{
   
    if(toggleStatus=1){
        if(!modalAddTipoActidades.classList.contains('d-none')){
            modalAddTipoActidades.classList.add('d-none')
            toggleStatus=0;
        }
    }
}
 
})

let closeModal = document.getElementById('closeModal');

closeModal.addEventListener('click',(e)=>{
    if(e.target == closeModal){   //closeModal is a icon element like <X>
        if(modalAddTipoActidades.classList.contains('showModal')){
            modalAddTipoActidades.classList.remove('showModal')
            modalAddTipoActidades.classList.add('d-none')
        }
    }
})


let AddTipoActividadesForm = document.getElementById('AddTipoActividadesForm');

AddTipoActividadesForm.addEventListener('submit',(e)=>{
e.preventDefault();
let datos = new FormData(AddTipoActividadesForm) 
let clave = datos.get('clave')
let tipounidad = datos.get('tipounidad')
let nombre = datos.get('nombre')
let color = datos.get('color')
let token = $("input[name=_token]").val();
let usuarios_id = datos.get('idusuario')
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


let route = 'tipoactividades'

$.ajax({
  url:route,
  headers:{'X-CSRF-TOKEN':token},
  type:'POST',
  dataType: 'json',
  data: {clave: clave, nombre: nombre, color: color, usuarios_id: usuarios_id, active: active, remove: remove,tipounidad_id: tipounidad},
  success: function (data) {
  
    console.log(data);
    if(data.error == 'true'){
      $('#errorsIntoModal').html(data.errors);
        $('#message-errorIntoModal').fadeIn();
        setTimeout(() => {
          $('#message-error').fadeOut();
        }, 3000);
        // setTimeout("location.reload(true);",3000)
        
    }else{
      $('#successIntoModal').html(data.ok);
        $('#message-successIntoModal').fadeIn();
        setTimeout(() => {
          $('#message-successIntoModal').fadeOut();
        }, 3000);
        setTimeout("location.reload(true);",3000)
    }
  }
  

})

})

// Show edit modal activities
let tipoActividadEditModal = document.getElementById('TAEditModal')
let bginput = document.getElementById('editColor')
let colorIcon = document.getElementById('colorIcon');

function showEditModal(id){

  let route = "tipoactividades/"+id+"/edit";

  $.get(route, function(data){
    $('#editClave').val(data.clave);
    $('#editNombre').val(data.nombre);
    bginput.setAttribute("value", data.color);
    colorIcon.style.backgroundColor = data.color;
    $('#editColor').val(data.color);
    $('#editRemove').val(data.remove);
    $('#editId').val(data.id)
    $('#editTipoUnidad').val(data.tipounidad_id)

    
    
    $('#editIdUsuario').val();
    $('#editActive').val(data.active);   
    
    if(data.active==0){
      $("#editActive").prop("checked", true);
    }else{
      $("#editActive").prop("checked", false);
    } 
   
  });

    if(tipoActividadEditModal.classList.contains("d-none")){
        tipoActividadEditModal.classList.remove("d-none")
        tipoActividadEditModal.classList.toggle("showModal");
    }
   
}

const closeModalEdit = document.getElementById("closeModalEdit");

closeModalEdit.addEventListener('click',()=>{
  if(tipoActividadEditModal.classList.contains('showModal')){
    tipoActividadEditModal.classList.remove('showModal');
    tipoActividadEditModal.classList.add('d-none');
    }
})



//boton actualizar

$('#btnEdit').click(function(){

  let nombre = $('#editNombre').val();
  let id = $('#editId').val();
  let color = $('#editColor').val();
  let clave = $('#editClave').val(); 
  let idUsuario = $('#editIdUsuario').val();
  let tipounidad_id = $('#editTipoUnidad').val();
  let editRemove = $('#editRemove').val();

  let remove = $('#editRemove').val();

  let active;
  if($('#editActive').is(':checked')){
    active = 0;
  }else{
    active = 1;
  }
  let route =`tipoactividades/${id}`
  

  $.ajax({
    url: route,
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    type: 'PUT',
    dataType: 'json',
    data: {nombre: nombre, color: color, clave:clave, active: active, id: id, usuarios_id: idUsuario, remove: remove, tipounidad_id: tipounidad_id },

    success: function (data) {
  
      console.log(data);
      if(data.error == 'true'){
        $('#error').html(data.errors);
          $('#message-error').fadeIn();
          setTimeout(() => {
            $('#message-error').fadeOut();
          }, 3000);
          // setTimeout("location.reload(true);",3000)
          
      }else{
        $('#success').html(data.ok);
          $('#message-success').fadeIn();
          setTimeout(() => {
            $('#message-success').fadeOut();
          }, 3000);
          setTimeout("location.reload(true);",3000)
      }
    }
  })
})


// Eliminar unidad
$(document).ready(function() {
  
  $('.btn-delete').click(function(){

    
     var row = $(this).parents('tr');
     var id = row.data('id');
     var form = $('#form-delete');
     var url = form.attr('action').replace(':TIPO_ID', id);
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