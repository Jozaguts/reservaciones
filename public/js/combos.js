
$(document).ready(function () {


  
  let comboActividaes ={
    hini: "as",
    hfin: "",
    actividades_id: "",
    actividades_id_combo: "",
    horario_id: "",
    usuarios_id: ""
    }
  let {hini} =  comboActividaes; 
   console.log(hini)
    let cl= console.log;  
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


      //cargarActiviad() pinta en pantalla la activiad
      let activiadesInsertadas =[];
    function cargarActividad(actividad){
  let horarios = actividad.infoactiviadhorario;
     
     if(!activiadesInsertadas.includes(actividad.infoactivad[0].clave)){
 for(let i=0; i<actividad.infoactivad.length; i++) {
        let idActividad = actividad.infoactivad[i].id;
        $('#bodyTable').append(`
      <tr >
      <td scope="row">${actividad.infoactivad[i].clave}</td>
      <td>${actividad.infoactivad[i].nombre}</td>
      <td class="precioFix">${actividad.infoactivad[i].precio}</td>
      <td class="balanceFix">${actividad.infoactivad[i].balance}</td>
      <td colspan="5"><div class="form-group">
          <label for=""></label>
          <select class="form-control select-info" name="select${actividad.infoactivad[i].id}" id="${actividad.infoactivad[i].id}">
        
          
          </select>
          <a href="#!" class="btn btn-danger ml-3 btn-eliminar" >-</a>
        </div> 
      </td>
    </tr>
        `)
        // esta funcion recive como parametros el id del select y los horarios
        insertaOPtions(horarios,idActividad );
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
    function insertaOPtions(infoactiviadeshorarios, idselect) {
  
       let select = document.querySelector(`select[name=select${idselect}]`)
       for(let i = 0; i<infoactiviadeshorarios.length; i++) {
        
          if(infoactiviadeshorarios[i].actividades_id == idselect) {
         let option = document.createElement("option")
         option.innerHTML =infoactiviadeshorarios[i].horario;
         select.appendChild(option)
        }else{
          $('#myTab').text('no se puuede')
        }
       
       }
       
      }
    
 
  // ## Cerar alerta
  // let cerrarAlerta = e => console.log(e.parentElement);
  $('.close').on('click', function () {
    alert('fucnioas')
  });


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


