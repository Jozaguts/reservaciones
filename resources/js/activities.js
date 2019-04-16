
// mostrar contenido de los boones
showContent = function (e){
    e.nextSibling.nextSibling.classList.contains('d-none')?e.nextSibling.nextSibling.classList.toggle('show')&&e.nextSibling.nextSibling.classList.remove('d-none'):e.nextSibling.nextSibling.classList.add('d-none')
  }
  
//cambiar a color a inactivos
  let elements = document.querySelectorAll('[data-active="0"]');
elements .forEach(element => {
   element.classList.add('tr-bg');
});


//show panel modal

let general = document.getElementById('general')
let profile = document.getElementById('profile')
let contact = document.getElementById('contact')

let panelsMOdal = document.querySelectorAll('.tab-pane')
showPanel =(element)=>{
  // let idButton = element.id

panelsMOdal.forEach((panel)=>{
  
`${panel.id}-tab` != element.id?panel.classList.remove('show'):null;
`${panel.id}-tab` != element.id?panel.classList.remove('active'):null;
})
}








// opupacion fija y renta checkbox e inputs

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







//add actividades 


let AddActividadesForm = document.getElementById('AddActividadesForm');

AddActividadesForm.addEventListener('submit',(e)=>{
e.preventDefault();

let datos = new FormData(AddActividadesForm) 
let clave = datos.get('clave')
let nombre = datos.get('nombre')
let tipoactividades_id = datos.get('tipoactividades_id')
let active=1, remove=0;
let tipounidades_id =0;

  let fijo;
  if($('#fijo').is(':checked')){
    fijo = 1;
  }else{
    fijo = 0;
  }
  let renta;
  if($('#renta').is(':checked')){
    renta = 1;
  }else{
    renta = 0;
  }

  let minutosincluidos = datos.get('minutosincluidos')
  let minutoincrementa = datos.get('minutoincrementa')
  let montoincremento = datos.get('montoincremento')
  let maxcortesias = datos.get('maxcortesias')
  let maxcupones = datos.get('maxcupones')
  let anticipo_id= datos.get('anticipo_id')
  let idusuario = datos.get('idusuario')
 

  // if($('#active').is(':checked')){
  //   active = 0;
  // }else{
  //   active = 1;
  // }
  // let remove;
  // if($('#remove').is(':checked')){
  //   remove = 0;
  // }else{
  //   remove = 1;
  // }

let route = 'actividades'

$.ajax({
  url:route,
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  type:'POST',
  dataType: 'json',
  data: {clave: clave, nombre: nombre, tipoactividades_id: tipoactividades_id,fijo:fijo,renta:renta,minutosincluidos:minutosincluidos,minutoincrementa:minutoincrementa,montoincremento:montoincremento,maxcortesias:maxcortesias,maxcupones:maxcupones,anticipo_id:anticipo_id,idusuario:idusuario, active:active, remove:remove,tipounidades_id:tipounidades_id},
  success: function (data) {
  
   console.log(data)
    if(data.error == 'true'){
      data.errors.forEach(()=>{})
      $('#errorsIntoModal').html(data.errors[0]);
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