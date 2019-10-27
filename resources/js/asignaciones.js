// document.addEventListener('click', function(e){

//     // tentego el redirecionamiento de los links A
//     if(e.target.nodeName =="A") {
//         e.preventDefault();

//     }
  
// })



function asignacionesInfo(e){

fetch(`asignaciones/${e.id}`,{
    method: "GET"
})
.then((response)=>{
    return response.json();
})
.then((responseJson)=>{
    // info unidad
    const UNIDAD_INFO =responseJson.unidadInfo;
    $('#unidad_id').val('');
    $('#unidad_id').val(e.id);
    $('#clave').val(UNIDAD_INFO.clave)
    $('#nombre').val(UNIDAD_INFO.nombre)
    $('#capacidad').val(UNIDAD_INFO.capacidad)
    $('#placa').val(UNIDAD_INFO.placa)  
    $('#tipo_unidad').val(UNIDAD_INFO.tipo_unidad)  

    // info select actividades
    const ACTIVIDADES = responseJson.actividades;
 
    for (let i = 0; i < ACTIVIDADES.length; i++) {
        let option = document.createElement('option')
            option.innerText = ACTIVIDADES[i].nombre;
            option.setAttribute('value', ACTIVIDADES[i].id)
            option.setAttribute('data-clave', ACTIVIDADES[i].clave)
            

            $('#actividades').append(option);
        
    }
})
.catch((err)=>{
    console.log(err)
})
// REVISAR LOS OPCIONES DE EL SELECT HOARIOS
    // select horario
    $('#actividades').change(function (e) { 
        e.preventDefault();
        let idActividad = e.target.options[e.target.selectedIndex].value
        if(idActividad != 'false'){
            fetch(`asignaciones/info-actividad-horario/${idActividad}`,{
                method: 'GET',
            })
            .then((response)=>{
                return response.json();
            })
            .then((responseJson)=>{
                let options = responseJson.optionsHorario;
                $('#horario').html('')
                $('#horario').append('<option value="false" selected="true">Seleccione un Horario</option>');
                options.forEach(option => {
                    $('#horario').append(option)
                });
                
            })
            .catch((err)=>{
                console.log(err);
            })
        }
        
        
    });
    $('#horario').change(function (e) { 
        e.preventDefault();
        let idHorario = e.target.options[e.target.selectedIndex].value
        if(idHorario != 'false'){

            fetch(`asignaciones/salidas-llegadas/${idHorario}`,{
                method: 'GET',
            })
            .then((response) => {
                return response.json();
            })
            .then((responseJson) => {
                console.log(responseJson.info)
                let info, hora, tipo, punto;
                info = responseJson.info
                $('#slu').html('')
                $('#slu').append('<option value="false" selected="true">Seleccione un Horario</option>');
                info.forEach((salida)=>{
                    hora = salida.hora;
                    tipo= salida.tipo;
                    punto= salida.punto;
                    id=salida.sal_lleg_hor_id;
                $('#slu').append(`<option value="${id}" data-hora="${hora}" data-punto="${punto}" data-libre-o-multiple="${tipo}"> ${hora === null ?"Libre": hora }  | ${tipo} | ${punto}</option>`);
                })
               

            })
            .catch((err)=>{
                console.log(err);
            })
        }
       
    });
     /* 
        actividad_id @INT
        actividad_horario_id @INT
        unidad_id @INT
        salida @BOOLEAN
        unidad_id @INT
    */
   let ubucaciones = [];
    $('#seleccionar').on('click', function () {
    let idUbucacion = $('#slu').val() 
    
    
    if(!ubucaciones.includes(idUbucacion)){
        $('#actividades').val()             /*actividad_id */
        $('#horario').val()                 /*actividad_horario_id */
        $('#unidad_id').val()               /* actividad_horario_id */
        
        let clave =  $('#actividades>option:selected').data('clave')     /*CLAVE*/
        let nombre = $('#actividades>option:selected').text()            /*NOMBRE*/ 
        let horario;                                                    /*Horario*/

        if($('#horario>option:selected').data('type') == "Libre"){
            horario="Libre"                                             /*Horario*/
        }else{
            horario=$('#slu>option:selected').data('hora')              /*Horario*/
        }
        
        let salida = $('#slu>option:selected').data('libre-o-multiple')  /* SALIDA  S o Ll === unidad_id*/
       
        let ubicacion =$('#slu>option:selected').data('punto')          /* Ubucacion */

        let tbody = document.getElementById('tbody')
        tbody.innerHTML += `
        <form>
            <tr>
                <td scope="row">${clave}</td>
                <td>${nombre}</td>
                <td>${horario}</td>
                <td>${salida}</td>
                <td>${ubicacion}</td>
                <td><span class="btn btn-danger">-</span></td>
                <input type="hidden" value="${idUbucacion}">
            </tr>
        </form>
        `;
        ubucaciones.push(idUbucacion);
        $('#slu>option:selected').remove();
    }
       
       
    });


    /* delete */
    document.addEventListener('click',function(e){

        if(e.target.classList.contains('btn-danger')){
            
            let indx = ubucaciones.indexOf(e.target.parentElement.parentElement.children[6].value)
            ubucaciones.splice(indx,1);
            e.target.parentElement.parentElement.remove()
            
            // 
        }
    })
    // $('').on('click', function (e) {
       
    // });


//     <tr>
//     <td scope="row">CAN01</td>
//     <td>CANOPY EL EDEN</td>
//     <td>08:00:00</td>
//     <td>S</td>
//     <td>Jarretaderas</td>
//     <td><span class="btn btn-danger">-</span></td>
//   </tr>


}
$('.modal').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
})
// $(".modal").on("hidden.bs.modal", function(){
// $('#unidad_id').val('');
// $('#clave').val('');
// $('#nombre').val('');
// $('#tipo_unidad').val('');
// $('#capacidad').val('');
// $('#placa').val('');
  
// });