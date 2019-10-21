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
   
        fetch(`asignaciones/info-actividad-horario/${idActividad}`,{
            method: 'GET',
        })
        .then((response)=>{
            return response.json();
        })
        .then((responseJson)=>{
            let options = responseJson.optionsHorario;
            $('#horario').html('')
            $('#horario').append('<option disabled selected="true">Seleccione un Horario</option>');
            options.forEach(option => {
                $('#horario').append(option)
            });
            
        })
        
    });
    $('#horario').change(function (e) { 
        e.preventDefault();
        let idHorario = e.target.options[e.target.selectedIndex].value
        fetch(`asignaciones/salidas-llegadas/${idHorario}`,{
            method: 'GET',
        })
        .then((response) => {
            return response.json();
        })
        .then((responseJson) => {
            console.log(responseJson)
        })
    });
}