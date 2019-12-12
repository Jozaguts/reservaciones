<template>
     <a href="#!" class="table-head table-head__btn btn-edit btn btn-primary" data-toggle="modal" data-target="#tipo_actividad_modal" @click="sendTipoActividadId" ></a>
</template>

<script>

import EventBus from '../EventBus';


export default {

    props: {
        tipoActividadId: null
    },
    methods:{
    sendTipoActividadId (){
         EventBus.$emit('sendTipoActividadId', this.tipoActividadId);
    }
}

}
</script>

<style>

</style>
