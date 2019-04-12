
// mostrar contenido de los boones
showContent = function (e){
    e.nextSibling.nextSibling.classList.contains('d-none')?e.nextSibling.nextSibling.classList.toggle('show')&&e.nextSibling.nextSibling.classList.remove('d-none'):e.nextSibling.nextSibling.classList.add('d-none')
  }
  
//cambiar a color a inactivos
  let elements = document.querySelectorAll('[data-active="0"]');
elements .forEach(element => {
   element.classList.add('tr-bg');
});

const home_tab = document.getElementById('home_tab');
showTab =()=>{

}
home_tab.addEventListener('click',()=>{
  
}) 

//add actividades 


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