<template>
    <tr >
        <th class="d-flex">
            <button class="btn btn-secondary" v-on:click="cantidad == 0 ? cantidad=0 :cantidad--">-</button>
            <input type="text"  v-model="cantidad" onkeyup="this.value=this.value.replace(/[^\d]/,'')" class="form-control mx-1 d-inline input-cantidad text-center" >
            <button class="btn btn-primary" v-on:click="cantidad++">+</button>
        </th>
        <th>
            <select name="persona" id="persona" class="form-control"
                v-model="persona_id"
                v-on:change="fillOcupacionSelect(actividad_id,persona_id)">
                    <option v-for="persona in personas"
                        :key="persona.id"
                        :value="persona.id"
                        v-text="persona.nombre">
                    </option>
            </select>
        </th>
        <th>
            <select class="form-control"
                    name="ocupacion"
                    id="ocupacion"
                    v-model="selectOcupacion"
                    v-on:change="getBalancePrecio(actividad_id,persona_id,selectOcupacion)">
                    <option
                        v-for="(ocupacion, index) in ocupaciones"
                        :key="index"
                        v-text="ocupacion">
                    </option>
            </select>
        </th>
        <th>
            <input type="text" readonly  class="form-control input-balance" v-model="inputBalance" >
        </th>
        <th>
            <input type="text" v-model="inputPrecio" class="form-control input-precio">
        </th>
        <th class="d-flex">
            <input type="text" readonly class="form-control totales mx-1" v-model="totalBalance">
            <input type="text" readonly class="form-control totales mx-1" v-model="totalPrecio">
        </th>
    </tr>
</template>

<script>
import store from '../store'
export default {
    props:['actividad_id'],
data(){
    return{
        cantidad: 0,
        persona_id:'',
        personas:[],
        inputBalance:'',
        inputPrecio:'',
        selectOcupacion:'',
        ocupaciones:[],
        totalBalance:0,
        totalPrecio:0
    }
},
methods:{
     getPersonas(){
            axios.get('/reservaciones/getpersonas')
            .then((res => this.personas = res.data.personas)).catch(error => console.log(error))
        },
        fillOcupacionSelect(actividadId,personaId){
            if(actividadId !="" && personaId != ""){
                 try {
                        store.commit('showLoader')
                     } catch (error) {
                         console.log(error);
                     }
                axios('/reservaciones/fillOcupacionSelect',{
                    params:{
                        actividadId,
                        personaId
                    }
                }).then((res =>{
                    this.ocupaciones = res.data.ocupacion
                    try {
                         store.commit('showLoader')
                     } catch (error) {
                         console.log(error);
                     }
                }))
            }else{
                swal({
                    icon:'info',
                    title:'Seleccione una actividad y/o tipo de ocupacion'
                })
            }

        },
        getBalancePrecio(actividadId,personaId,ocupacion) {
            if(actividadId != "" && personaId != "" && ocupacion != "") {
                try {
                    store.commit('showLoader')
                } catch (error) {
                    console.log(error);
                }
                axios('/reservaciones/getbalanceprecio',{
                    params:{
                    actividadId,
                    personaId,
                    ocupacion
                    }
                }).then((res) =>{

                    this.inputBalance = this.currency(res.data.balance);
                    this.inputPrecio = this.currency(res.data.precio)
                    try {
                         store.commit('showLoader')
                     } catch (error) {
                         console.log(error);
                     }
                }).catch((error =>console.log(error)))

            }
        },
        currency(value){
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 2
                }).format(value)
        },
},
created(){
     this.getPersonas()
}
}
</script>

<style>
.input-balance,.input-precio, .totales{
    text-align: center;
    max-width: 80px;
}
</style>
