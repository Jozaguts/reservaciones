$(document).ready(function () {
    let cl= console.log;
    // LISTENERS
    // addEventListener para el boton  del +combo y mostrar el modal para agregar un combo
   $(document).on('click', '.show-btn', function () {
    $(this).siblings('div').toggleClass('d-none')

    });
    let respuesta;
    $(document).on('click','.btn-agregar', function(e){
      // e.preventDefault();
      let id = e.target.parentElement.children[1].value;
      let xhr = new XMLHttpRequest()
      xhr.open('GET',`/horario-multiple/${id}`,true)
      xhr.onreadystatechange = function (){

        if(this.readyState == 400 && this.status ==200){
          respuesta = JSON.parse(xhr.responseText);
        
        }else{
        
        }  
      }
      xhr.send();
    
    })


    // AGREGAR ACTIVIDAD 
    
   
 
});
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