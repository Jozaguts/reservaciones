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
      console.log(data.correcto);
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