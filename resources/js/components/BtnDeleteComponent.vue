<template>
  <a href="#!" class="table-head table-head__btn btn btn-delete btn-danger" @click="deleteTipoActividad" ></a>
</template>

<script>
export default {
      props: {
        tipoActividadId: null
    },
    methods:{
    deleteTipoActividad (){
        swal({
            icon:'warning',
            text: '¿Eliminar Tipo De Actividad?'
        })
        .then(res =>{
            if(res) {
                axios.delete(`tipoactividades/${this.tipoActividadId}`)
                .then(res => {
                    swal({
                        icon:'success',
                        text: '¡Tipo De Actividad Eliminada!'   
                    })
                })
                .catch(error => console.log(error))
            }
        })
       
    }
}

}
</script>

<style>

</style>
