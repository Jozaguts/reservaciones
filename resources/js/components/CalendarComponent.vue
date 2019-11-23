<template>
<v-container>
    <v-row>
        <v-col cols="1" class="btn-reserva">
            +Reserva
        </v-col>
        <v-col v-for="tipoActividad in tipoActividades" :key="tipoActividad.id" :style="getEventColor(tipoActividad)">
            {{tipoActividad.nombre}}
        </v-col>
    </v-row>
    <v-row>
        <!-- horas de trabajo -->
        <v-col cols="1">
            <v-row v-for="(hora, index) in horas" :key="'hour-job' + index" class="hour-container">
                {{printHour(hora)}}
            </v-row>
        </v-col>
        <v-col  v-for="tipoActividad in tipoActividades" :key="'avent-col'+tipoActividad.id">
                <v-row v-for="(hora, index) in horas" :key="'event-row'+index" class="event-row" :ref="'taid'+tipoActividad.id+'hora'+hora">

                </v-row>
            </v-col>
    </v-row>
</v-container>



</template>

<script>

export default {

data(){
    return{
        tipoActividades: [],
        horas: 24,
        data:[],
        events:[]
    }
},
methods: {
   async getEvents(){
        try {
            const REQUEST = await axios.get('reservaciones/dashboard');
            let data = REQUEST.data.info;
            let tipoActividades = REQUEST.data.tipo_actividades;
            let events =[]; 
            tipoActividades.forEach(tipoActividad => {
                this.tipoActividades.push(tipoActividad)
            });
        
            data.forEach(actividad => {

                let horarios = actividad.horarios;
                
                horarios.forEach(function (horario,index){
                        
                      let event = {
                        tipo_actividad_id: actividad.tipo_actividad_id,
                        tipo_actividad_color: actividad.tipo_actividad_color,
                        hini:horario.hini,
                        hfin:horario.hfin,
                        actividad_nombre :actividad.actividad_nombre,
                        actividad_clave :actividad.actividad_clave,
                        actividad_id :actividad.actividad_id
                    }
                    events.push(event)
                   
                });

            });
             this.events = events;
             return false;
             

        } catch (error) {
          console.log(error)
        }
      },
       getEventColor (event) {
        return `background-color:${event.color}`;
      },
      printHour(num) {
         return moment(`1945-01-01 ${num}:00`).format('LT');
      },
      printEvent(events) {
          
        events.forEach(event => {
            let hora = event.hini.substring(0,2);
                if(hora <= 9 ){
                    hora =  event.hini.substring(1,2)
                }
            let ref = `taid${event.tipo_actividad_id}hora${hora}`

            let eventLayout = `
            <div class="container event-layout">
                <div class="row">
                    <div class="col-12" style="background-color:${event.tipo_actividad_color}">
                        <header><h1 class="title-event-layout">${event.actividad_clave} |${event.actividad_nombre} </h1></header>
                    </div>
                </div>
            </div> 
            `;

            
                                console.log(this.$refs[ref][0].innerHTML=eventLayout);
            // this.$refs[ref][0] (eventLayout);
        });
        
    }
},

    mounted(){
        this.getEvents();
        
    },
    updated(){
        this.printEvent(this.events);
    }
}
</script>

<style>
.hour-container{
    min-height: 40px;
    font-size: .7rem;
    color:black;
    justify-content: center;
    align-items: flex-start;
}
.btn-reserva{
    background-color: black;
    color:white;
    font-weight: 700;
    cursor: pointer;
}
.event-row{
    min-height: 40px;
    font-size: 1rem;
    color:black;
    justify-content: center;
    align-items: flex-start;
    border:#e0e0e0 1px solid;
}
.event-layout{
    max-height: 40px !important;
}
.title-event-layout{
    font-size: 12px !important;
}

</style>
