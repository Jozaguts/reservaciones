
// btn moto content
let motoContent = document.getElementById('motoContent')
let btnMoto = document.getElementById('btnMoto')

btnMoto.addEventListener('click',()=>{
    motoContent.classList.contains('d-none')?motoContent.classList.toggle('show')&&motoContent.classList.remove('d-none'):motoContent.classList.add('d-none')

})

// btn bus content
let busContent = document.getElementById('busContent')
let btnBus = document.getElementById('btnBus')
btnBus.addEventListener('click',()=>{
    busContent.classList.contains('d-none')?busContent.classList.toggle('show')&&busContent.classList.remove('d-none'):busContent.classList.add('d-none')
})


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
        console.log(datos.get('idusuario'));
        let clave = datos.get('clave')
        let descripcion = datos.get('descripcion')
        let capacidad = datos.get('capacidad')
        let color = datos.get('color')
        let placa = datos.get('placa')
        let token = $("input[name=_token]").val();
        let idusuario = datos.get('idusuario')
        let idtipounidad;
        switch (clave) {
            case "mot":
                idtipounidad=1;
                break;
            case "bus":
                idtipounidad=2;
            default:
                break;
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
          data: {clave: clave, descripcion: descripcion, capacidad: capacidad, color: color, idusuario: idusuario, active: active, remove: remove, placa: placa, idtipounidad: idtipounidad},
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
              setTimeout("location.reload(true);",3000)
            }  
        },
          error:function(data){
            $('#tipoEUModal').fadeOut();
            $('#error').html(data.error);
              $('#message-error').fadeIn();
              setTimeout(() => {
                $('#message-error').fadeOut();
              }, 3000);
        
            // console.log(data.error);
          }
        
        })
        
        })



// Show edit modal equipo y unidades 
let modalEditEquipoUnidad = document.getElementById('modalEditEquipoUnidad')

function showEditModal(id){

  let route = "unidades/"+id+"/edit";

  $.get(route, function(data){
    $('#editClave').val(data.clave);
    $('#editDescripcion').val(data.descripcion);
    $('#editCapacidad').val(data.capacidad);
    $('#editColor').val(data.color);
    $('#editRemove').val(data.remove);
    $('#editIdUsuario').val();
   
    
  

    $('#editActive').val(data.active);
    
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
