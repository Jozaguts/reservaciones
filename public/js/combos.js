

$(document).ready(function () {

// mostrar paneles contenedores de actividades
  $(document).on('click', '.show-btn', function () {
    $(this).siblings('div').toggleClass('d-none')
  
    });
  
/* ATENTION
* The main select is setter by Modals/combos.blade 
*/
document.addEventListener('submit',function(e){
  e.preventDefault();
})

// ------------------------------------------------ functions list---------------------------
/*
* getInfoActivity()
* printActivity()
* changeValueCheck();
* printInfoCombo()
*/
// ------------------------------------------------end functions list---------------------------

/* ---------------------------getInfoActivity()----------------------
* Params: id
* type: string 
* Details: return info of spesific activity and option or options (HTML) its depends on type activity (LIBRE or MULTIPLE)
*/
const getInfoActivity = id =>{  
  // get info of specific activity
  $('#loading').removeClass('d-none')
  fetch(`/info-actividad/${id}`)
  .then((response) => {
    return response.json();
  })
  .then((responseJson)=>{
    printActivity(responseJson)
    $('#loading').addClass('d-none')
  })

 
  .catch((err) => {
    console.log(err);
  })
}
// ---------------------------end getInfoActivity()----------------------

/* -------------------------- printActivity-----------------------------
*params: info of activity
*type: string
*details: print in screen the information with a dinamic select
*/
let aggregateActivities =[];
function printActivity(infoActividad){

  const actividad = infoActividad[0][0];
  const selectOptions = infoActividad[1]; 
  if(!aggregateActivities.includes(actividad.id)){
    let currency =  new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'USD' }).format

    $('#bodyTable').append(` 
     
        <tr class="actividad-id">
          <td scope="row">${actividad.clave}</td>
          <td>${actividad.nombre}</td> 
          <td class="precioFix">${currency(actividad.precio)}</td>
          <td class="balanceFix">${currency( actividad.balance)}</td>
          <td colspan="5">
            <form class="form-actividad-combo" >
              <div class="form-group">
                <select class="form-control select-info" name="select";> 
                  ${selectOptions}
                </select>
                  <a href="#!" class="btn btn-danger ml-3 btn-eliminar" name="${actividad.id}" id="btn-eliminar">-</a>
                  <input type="hidden" name="actividad_combo_id" value="${actividad.id}">
              </div>
            </form>
        </tr>
     
  `);
  aggregateActivities.push(actividad.id);

  }else{
    swal("", "No Puedes Repetir Actividad", "info")
  }

  
}
// --------------------------end printActivity-----------------------------
 

// --------------------------changeValueCheck-----------------------------

$('#mismodia').on('change', function () {
  $('#mismodia').prop('checked') == true ?  $('#mismodia').val('1'): $('#mismodia').val('0'); 
});
// --------------------------end changeValueCheck-----------------------------


// --------------------------printInfoCombo--------------------------------

function printInfoCombo(infoCombo, infoPrecios) {

  $('#clave').val(infoCombo.clave)
  $('#nombre').val(infoCombo.nombre)
  $('#maxCortesias').val(infoCombo.maxcortesias)
  $('#maxCupones').val(infoCombo.maxcupones)
  $('#balanceG').val(infoCombo.balance)
  $('#precioG').val(infoCombo.precio)
  $('#tipoactividades_id').val(infoCombo.tipoactividades_id)
  $('#anticipoId').val(infoCombo.anticipo_id)
  infoCombo.mismo_dia == 1 ? $('#mismo_dia').prop('checked',true):$('#mismo_dia').prop('checked',false);


  infoPrecios.forEach((infoPrecio)=>{
  
   $(`#formPerson${infoPrecio.persona_id}`)[0][1].value =infoPrecio.precio1;
   $(`#formPerson${infoPrecio.persona_id}`)[0][2].value =infoPrecio.precio2;
   $(`#formPerson${infoPrecio.persona_id}`)[0][3].value =infoPrecio.precio3;
   $(`#formPerson${infoPrecio.persona_id}`)[0][4].value =infoPrecio.doble;
   $(`#formPerson${infoPrecio.persona_id}`)[0][5].value =infoPrecio.doblebalanc;
   $(`#formPerson${infoPrecio.persona_id}`)[0][6].value =infoPrecio.triple;
   $(`#formPerson${infoPrecio.persona_id}`)[0][7].value =infoPrecio.triplebalanc;

  infoPrecio.promocion == 1 ?
    $(`#formPerson${infoPrecio.persona_id}`)[0][8].setAttribute('checked',true):
    $(`#formPerson${infoPrecio.persona_id}`)[0][8].setAttribute('checked',false)
  infoPrecio.promocion == 1 ?
    $(`#formPerson${infoPrecio.persona_id}`)[0][9].setAttribute('checked',true):
    $(`#formPerson${infoPrecio.persona_id}`)[0][9].setAttribute('checked',false)
  infoPrecio.promocion == 1 ?
    $(`#formPerson${infoPrecio.persona_id}`)[0][10].setAttribute('checked',true):
    $(`#formPerson${infoPrecio.persona_id}`)[0][10].setAttribute('checked',false)

   

  })



  
 


}

// --------------------------end printInfoCombo--------------------------------
 
// --------------------------btn-agregar-----------------------------
/*  add activity to the miniCrud
* call to function printActivity this need a second function getInfoActivity 
*/
  $(document).on('click','.btn-agregar', function(e){
    // params: ID == e.target.parentElement.children[1].value
    getInfoActivity(e.target.parentElement.children[1].value);
    
    $('#bodyTable').children()? $('.btn-guardar').prop('disabled',false) : $('.btn-guardar').prop('disabled',true) 
     
    
  })
  // $(document).on('click','.btn-crear', function(e){
  //  
  // })
// --------------------------end btn-agregar-----------------------------

// --------------------------btn-eliminar-----------------------------
// delete activity to the miniCrud
  $(document).on('click','.btn-eliminar', function(e){
    let activityId = e.target.getAttribute('name')
    let comboID = $('#comboId').val()
 
    swal({
      title: "¿Eliminar Actividad?",
      text: "Esta Acción Removera La Actividad De La Lista De Activiades Seleccionadas",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        let goRemoveId = aggregateActivities.indexOf(activityId)

        aggregateActivities.splice(goRemoveId,1);
      
        e.target.parentElement.parentNode.parentNode.parentNode.remove();
        if(aggregateActivities.length == 0) $('.btn-guardar').prop('disabled',true)  

        fetch(`combos/${comboID}`,{
          method: 'DELETE',
          body: JSON.stringify({activityId:activityId}),
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-Token": $('input[name="_token"]').val()
          }
         
        })
        .then((response)=>{
          return response.json();
        })
        .then((jsonResponse)=>{
          swal("Actividad Eliminada Con exito", {
            icon: "success",
          });
        })
        .catch((err)=>{
          console.log(err)
        })
        
      } else {
        swal("Actividad No Eliminada");
      }
    });
  })
  
// -------------------------- end btn-eliminar-----------------------------


// --------------------------btn-guardar-----------------------------
document.addEventListener('click',function(e){
  
  if(e.target.classList.contains('btn-guardar')) {

    const formPerson1 = document.querySelector('#formPerson1');
    const formPerson2 = document.querySelector('#formPerson2');
    const formPerson3 = document.querySelector('#formPerson3');
   
    const formactiviadescombo = document.querySelectorAll('[class^=form-actividad-combo]');

   
    let data= {}, precio1={},precio2={},precio3={}, precios=[];
    const actividadesCombo = [];
    
    
    formactiviadescombo.forEach((form)=>{
      let actividadCombo = {};
      for (let i = 0; i < form.length; i++) {
       
       actividadCombo['select']=form.children[0].children[0].options[form.children[0].children[0].selectedIndex].text
       actividadCombo['horario_id'] = form.children[0].children[0].options[form.children[0].children[0].selectedIndex].value
       actividadCombo['actividades_id'] =form.children[0].children[2].value
    
       
      }

      actividadesCombo.push(actividadCombo)
    //  console.log(actividadesCombo)
    })

    data['actividades_combo'] = actividadesCombo
   
  
      for (let i = 0; i < formPerson1.length; i++) {
      
        precio1[formPerson1[i].name]=formPerson1[i].value
      

      }
      formPerson1[8].checked == true ? precio1.promocion = 1:precio1.promocion = 0;  
      formPerson1[9].checked == true ? precio1.restriccion = 1:precio1.restriccion = 0;  
      formPerson1[10].checked == true ? precio1.acompanante = 1:precio1.acompanante = 0;  
      

      for (let i = 0; i < formPerson2.length; i++) {
   
        precio2[formPerson2[i].name]=formPerson2[i].value

      }
      formPerson2[8].checked == true ? precio2.promocion = 1:precio2.promocion = 0;  
      formPerson2[9].checked == true ? precio2.restriccion = 1:precio2.restriccion = 0;  
      formPerson2[10].checked == true ? precio2.acompanante = 1:precio2.acompanante = 0;  
      
      for (let i = 0; i < formPerson3.length; i++) {
   
        precio3[formPerson3[i].name]=formPerson3[i].value

      }
      formPerson3[8].checked == true ? precio3.promocion = 1:precio3.promocion = 0;  
      formPerson3[9].checked == true ? precio3.restriccion = 1:precio3.restriccion = 0;  
      formPerson3[10].checked == true ? precio3.acompanante = 1:precio3.acompanante = 0;  
      
      
      precios.push(precio1,precio2,precio3,)
 

    data['precios'] = precios
    let dataform = $('#combosForm').serializeArray();
    let preciosYPasesForm = $('#AddPreciosYPasesForm').serializeArray();

    for (let i = 0; i < dataform.length; i++) {
   
      data[dataform[i].name]=dataform[i].value
  
    }
    for (let i = 0; i < preciosYPasesForm.length; i++) {
   
      data[preciosYPasesForm[i].name]=preciosYPasesForm[i].value
  
    }   

    fetch('/combos',{
            method: 'POST', 
            body: JSON.stringify(data),
            headers: {
              "Content-Type": "application/json",
              "Accept": "application/json",
              "X-Requested-With": "XMLHttpRequest",
              "X-CSRF-Token": $('input[name="_token"]').val()
            }
          })
          .then((response)=>{
            return response.json()
          })
          .then((jsonResponse)=>{
            let  message ="";
            if(jsonResponse.errors){
              let errors = $.each(jsonResponse.errors, function (key, value) {
                    
                message += `${value}
                `                     
              });
              swal({
                title: "Error de Validación",
                text: `${message}`,
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
            }else if(jsonResponse.success){
              swal("Good job!", `${jsonResponse.success}!`, "success");
              $('#bodyTable').html(' ');
              $('#combos').modal('hide');
              aggregateActivities.length=0;
              if(aggregateActivities.length == 0) $('.btn-guardar').prop('disabled',true)
            }
           
          })
          .catch((err)=>{
            console.log(err)
          })
 // --------------------------end btn-guardar-----------------------------        
 
  } /* termina boton guardar */
    

})

// --------------------------btn-editar (Show)----------------------------- -----

$(document).on('click','.btn-editar', function(e){
  $('#clave').prop('disabled', true);
  $('.btn-guardar')
  .parents('.form-group')
  .html('<button class="btn btn-primary btn-update">Actualizar</button>')
 
  


  const ID = e.target.getAttribute('data-id');
  var token = $("input[name='_token']").val();
  $('#combosForm').append(`<input type="hidden" value ="${ID}" id="comboId">`)
  let info;
    fetch(`combos/${ID}/edit`,{
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-Token": $('input[name="_token"]').val()
      },
    })
    .then((response) => {
      return response.json();
    }).then((responseJson)=>{
      console.log(responseJson.precios)
        printInfoCombo(responseJson.combo, responseJson.precios);
        responseJson.actividades.forEach((infoactividad)=>{
          printActivity(infoactividad);
      });

    }).catch((err) => {
      console.log(err);
    });
  
  $('#combos').modal('show')
  
})
// --------------------------btn-editar----------------------------- -----

//---------------------------btn update--------------------------------------

$('.form-group').on('click', '.btn-update', function (event) {
 


  let comboId= $('#comboId').val()

    const formPerson1 = document.querySelector('#formPerson1');
    const formPerson2 = document.querySelector('#formPerson2');
    const formPerson3 = document.querySelector('#formPerson3');
    const formactiviadescombo = document.querySelectorAll('[class^=form-actividad-combo]');
    let data= {}, precio1={},precio2={},precio3={}, precios=[];
    const actividadesCombo = [];
    
  
  
    formactiviadescombo.forEach((form)=>{
      let actividadCombo = {};
        for (let i = 0; i < form.length; i++) { 
          actividadCombo['select']=form.children[0].children[0].options[form.children[0].children[0].selectedIndex].text
          actividadCombo['horario_id'] = form.children[0].children[0].options[form.children[0].children[0].selectedIndex].value
          actividadCombo['actividades_id'] =form.children[0].children[2].value
      }
  
          actividadesCombo.push(actividadCombo)
  
    })
  
    data['actividades_combo'] = actividadesCombo
    
      for (let i = 0; i < formPerson1.length; i++) {
  
        precio1[formPerson1[i].name]=formPerson1[i].value
  
      }
      for (let i = 0; i < formPerson2.length; i++) {
  
        precio2[formPerson2[i].name]=formPerson2[i].value
  
      }
      for (let i = 0; i < formPerson3.length; i++) {
  
        precio3[formPerson3[i].name]=formPerson3[i].value
  
      }
        
        precios.push(precio1,precio2,precio3,)
   
   
      data['precios'] = precios
      let dataform = $('#combosForm').serializeArray();
      let preciosYPasesForm = $('#AddPreciosYPasesForm').serializeArray();
  
  
      for (let i = 0; i < dataform.length; i++) {
     
        data[dataform[i].name]=dataform[i].value
    
      }
      for (let i = 0; i < preciosYPasesForm.length; i++) {
     
        data[preciosYPasesForm[i].name]=preciosYPasesForm[i].value
    
      }   
      fetch(`/combos/${comboId}`,{
        method: 'PUT', 
        body: JSON.stringify(data),
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-Token": $('input[name="_token"]').val()
        }
    })
    .then((response)=>{
      return response.json()
    })
    .then((jsonResponse)=>{
      let  message ="";
      if(jsonResponse.errors){
        let errors = $.each(jsonResponse.errors, function (key, value) {
              
          message += `${value}
          `                     
        });
        swal({
          title: "Error de Validación",
          text: `${message}`,
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
      }else if(jsonResponse.success){
        swal("Good job!", `${jsonResponse.success}!`, "success");
        $('#bodyTable').html(' ');
        $('#combos').modal('hide');
        aggregateActivities.length=0;
        if(aggregateActivities.length == 0) $('.btn-guardar').prop('disabled',true)
      }
     
      })
      .catch((err)=>{
        console.log(err)
      })
  
  
   
    
    
  });
  
  
  document.addEventListener('click',function(e){
    e.preventDefault()
// alert(e.target)
if(e.target.id =='btnDesactivar'){
   //--------------------------------desactivarActividad(this)-----
    
          let id= e.target.getAttribute('data-id');
     
          fetch(`/desactivarcombo/${id}`,{
            method: 'PUT', 
            // body: JSON.stringify(data),
            headers: {
              "Content-Type": "application/json",
              "Accept": "application/json",
              "X-Requested-With": "XMLHttpRequest",
              "X-CSRF-Token": $('input[name="_token"]').val()
            }
        })
          .then((response)=>{
            return response.json()
          })
          .then((responseJson)=>{
            swal("Good job!", `${responseJson.success}!`, "success");
          })
          .catch((err)=>{
            console.log(err);
          });
        
        
}
if(e.target.id =='btnDelete'){
  //--------------------------------Delete Combo(this)-----
   
         let id= e.target.getAttribute('data-id');
    
         fetch(`/actividades/${id}`,{
           method: 'DELETE', 
           headers: {
             "Content-Type": "application/json",
             "Accept": "application/json",
             "X-Requested-With": "XMLHttpRequest",
             "X-CSRF-Token": $('input[name="_token"]').val()
           }
       })
         .then((response)=>{
           return response.json()
         })
         .then((responseJson)=>{
           swal("Good job!", `Combo eliminado Correctamente`, "success");
         })
         .catch((err)=>{
           console.log(err);
         });
       
       
}

  })



//---------------------------end btn update-----------------------------------






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

      // habilitar acompañate 
      habilitarAcompnante = (e)=>{
        let id = e.getAttribute('data-id');
        let checkAcompanante = document.querySelector(`#acompanantePersonaId${id}`)
        
        if(e.checked){
        
        checkAcompanante.disabled = false;
        }else{
        checkAcompanante.disabled = true;
        }
        }

       