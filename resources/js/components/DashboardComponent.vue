<template>
  <div class="table-responsive">
     <table class="table">
       <thead class="thead-dark">
        <tr>
           <!-- Encabezado y Boton Agregar reserva  -->
          <th class="text-center">
            +Reserva
          </th>
            <!-- END Encabezado y Boton Agregar reserva  -->

            <!-- encabezados de Tipo de activiades  -->
          <th 
            v-for="(info_tipo_actividad, index) in info_tipo_actividades"
            :style=" info_tipo_actividad.color == info_tipo_actividad.color ?
            `background-color: ${info_tipo_actividad.color}` :
            false " 
            :key="index"
            :name="info_tipo_actividad.nombre"
          >
              {{info_tipo_actividad.nombre}}  
          </th> 
          <!-- END Encabezado de tipo de activiades -->
        </tr>
       </thead>
       <tbody>
         <!-- +Reserva  info  columna horas (horas de trabajo en el dia)-->
         <tr v-for='(hora, index) in total_horas' 
            :key='index'> 
            <td class="text-center" >
              {{printHour(index)}}
            </td>
              <td v-for="(tipo_actividad ) in info_tipo_actividades"
              :velue="tipo_actividad.color">
                 {{printHour(index,false)}} {{tipo_actividad.id}}
              </td>
         </tr>
         <!-- END +Reserva info  columna horas-->
       
         <!-- Casillas por tipo de actividad 
              pintar por cada tipo de actividad la misma cantidad de filas que tiene las horas "+Reserva" -->
       <tr>

       </tr>
          <!-- END Casillas por tipo de actividad -->
       </tbody>
     </table>
  </div>
</template>


<script>

export default {
  beforeCreate(){
    axios.get('reservaciones/dashboard ')
    .then(res=>{
        this.total_horas = res.data.total_horas
        this.hini = res.data.hini;
        this.hfin = res.data.hfin;
        this.info_tipo_actividades = res.data.tipo_actividades
        this.actividades = res.data.actividades[0]
        console.log(this.actividades);
      })
  },

    mounted(){
      this.printActivity();
    },

data(){
    return{
      total_horas: '',
      hini:'',
      hfin:'',
      info_tipo_actividades: '',
      actividades:''

    }
  },
  methods:{
    printHour: function(hora, format){
      if(hora != undefined && format != false){
        return  moment(`1970-01-01 ${this.hini}`).add(hora, 'h').format("HH:mm a")
      }else if(format == false && hora != undefined){
        return  moment(`1970-01-01 ${this.hini}`).add(hora, 'h').format("HH:mm")
      }
      
    },
    printActivity: function(){
     let colum = document.getElementsByName('06:00 AM')
   
    }
  },
}
</script>

<style>

th{
  min-width: 120px;
  font-size: 14px;
}
</style> 