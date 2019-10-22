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
                info.forEach((salida)=>{
                    hora = salida.hora;
                    tipo= salida.tipo;
                    punto= salida.punto;
                    id=salida.sal_lleg_hor_id;
                $('#slu').html('')
                $('#slu').append('<option value="false" selected="true">Seleccione un Horario</option>');
                $('#slu').append(`<option value="${id}" > ${hora} | ${tipo} | ${punto}</option>`);

                })
               

            })
            .catch((err)=>{
                console.log(err);
            })
        }
       
    });
}