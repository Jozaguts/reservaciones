<template>
  <div class="modal-body">
     <form v-on:submit.prevent>
         <div class="form-group col-6 offset-3">
             <label for="clave">Clave</label>
             <input type="text" class="form-control" v-model="clave">
         </div>
         <div class="form-group col-6 offset-3">
             <label for="nombre">Nombre</label>
             <input type="text" class="form-control" v-model="nombre">
         </div>
         <div class="form-group col-6 offset-3">
             <button class="btn btn-success btn-block" @click="guardar">Guardar</button>
         </div>

     </form>
  </div>
</template>

<script>
export default {
    data(){
        return{
            clave: "",
            nombre: ""
        }
    },
    methods: {
        guardar() {
            axios.post('/comisionista',{
                clave:this.clave,
                nombre:this.nombre
            })
            .then(response => {
                console.log(response)
            })
            .catch(error =>  {
                console.log(error)
            })
        }
    }

}
</script>

<style>

</style>
