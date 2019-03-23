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

AddTipoActividadesForm
let AddTipoActividadesForm = document.getElementById('AddTipoActividadesForm');

AddTipoActividadesForm.addEventListener('submit',(e)=>{
e.preventDefault();
let datos = new FormData(AddTipoActividadesForm) 
let clave = datos.get('clave')
let nombre = datos.get('nombre')
let color = datos.get('color')
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


let route = 'tipoactividades'

$.ajax({
  url:route,
  headers:{'X-CSRF-TOKEN':token},
  type:'POST',
  dataType: 'json',
  data: {clave: clave, nombre: nombre, color: color, idusuario: idusuario, active: active, remove: remove},
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
      reload();
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

})