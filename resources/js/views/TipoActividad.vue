<template>
  <div class="content" id="vista_tipo_actividad" >
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-dark font-weight-bold">Tipo De Actividades</div>
                        <div class="card-body">
                            <div class="row justify-content-end my-2">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tipo_actividad_modal"><span class="font-weight-bolder">+</span> Tipo Actividad</button>
                            </div>
                                <div class="row">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="table-head" >Clave</th>
                                                <th class="table-head" >Nombre</th>
                                                <th class="table-head" >Color</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                    <tr v-for="tipoActividad in tipoActividades" :key="tipoActividad.id">
                                                        <td class=" table-head table-head__name" v-text="tipoActividad.clave"></td><!--  clave -->
                                                        <td class="table-head table-head__surname" v-text="tipoActividad.nombre" ></td> <!-- nombre -->
                                                        <td class="table-head table-head__surname text-capitalize">
                                                            <span :style="setColor(tipoActividad.color)"  ></span> <!-- color -->
                                                        </td>
                                                        <td class="table-head table-head__actions">
                                                            <btn-update :tipoActividadId="tipoActividad.id"/>
                                                            <btn-delete :tipoActividadId="tipoActividad.id"/>
                                                        </td>
                                                    </tr>
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
export default {
    data(){
        return {
            tipoActividades: [],
        }
    },
    methods:{
        getData(){
            axios.get('tipoactividades')
            .then(res =>  this.tipoActividades = res.data)
            .catch(error => console.log(error))
        },
           setColor: function(color){

            return `background-color:${color}; display:block; width:5rem; height: 1.5rem;`;
        }
    },
    created() {
        this.getData()
    },
    computed:{

    }


}
</script>

<style>

</style>
























































    <!-- <template>
<v-sheet>
      <form id="formTipoActividad" @submit.prevent="crearActividad" >

          <input type="hidden" name="id_tipo_actividad"  >
                <div class="col-6 offset-3">
                    <div class="form-group">
                        <label for="my-input">Clave</label>
                        <input class="form-control" type="text" name="clave" id="clave" v-model="clave" required maxlength="5">
                        <small ref="clave" class="text-danger"> </small>
                    </div>
                </div>
                <div class="col-6 offset-3">
                    <div class="form-group">
                        <label for="my-input">Nombre</label>
                        <input  class="form-control" type="text" name="nombre" id="nombre" v-model="nombre" required>
                         <small ref="nombre" class="text-danger"> </small>
                    </div>
                </div>
                <div class="col-6 offset-3">
                    <div class="form-group">
                        <label for="my-input">Tipo Unidad</label>
                            <select id="tipounidad_id" class="form-control" name="tipounidad_id" v-model="tipounidad_id" required>
                                <option v-for="tipo_unidad in tipo_unidades" :key="tipo_unidad.id" :value="tipo_unidad.id">{{tipo_unidad.nombre}} </option>
                            </select>
                             <small ref="tipounidad_id" class="text-danger"> </small>
                    </div>
                </div>
                <div class="col-6 offset-3">
                    <div class="form-group">
                        <label for="my-input">Text</label>
                  color picker
                         <color-picker @colorSeleccioado="color = $event"/>
                    </div>
                </div>

            <div class="col-6 offset-3">
                <div class="btn-group" role="group" aria-label="Button group">
                <button type="submit" class="btn btn-success btn-block" id="btn_guardar_tipo_actividad"  @getIdTipoActividad="tipo_actividad_id = $event">
                    Guardar
                </button>
                </div>
            </div>
        </form>
</v-sheet>
</template>

<script>
//##########################FALTA PASAR EL ID DEL TIPO ACTIVIDAD HACIA EL COMPOENNTE PARA OBTENER SU INFO##########################################################

export default {
    data: () => {
        return{
            clave: '',
            nombre: '',
            tipounidad_id:'',
            color:'',
            tipo_unidades:'',
            errors: [],
        }
    },
    methods: {
        crearActividad(){

            axios.post('tipoactividades', {
                clave: this.clave,
                nombre: this.nombre,
                tipounidad_id: this.tipounidad_id,
                color: this.color
            })
            .then(res =>{

            swal({
                icon: "success",
                text: res.data.message
                })
            })
            .catch(err => {
                let errors = err.response.data.errors;
                let error ={}, errorsArray=[];

                for (const key in errors) {
                    error[key] = errors[key][0]
                    errorsArray.push(error)
                }
            this.pintarErrores(errorsArray);
            })
        },

        pintarErrores(errors){
            // por cada error
            for(let i=0; i<errors.length; i++ ){

                for(const ref in this.$refs) {
                    if(errors[i].hasOwnProperty(ref)){
                        this.$refs[ref].innerText = errors[i][ref];
                        setTimeout(() => {
                             this.$refs[ref].innerText = "";
                        }, 3000);
                    }else{
                         this.$refs[ref].innerText= "";
                    }
            }
            }
        },
        async obtenerTipoActividades (){
             this.tipo_unidades = await axios.get('tipoactividades')
                    .then(response => response.data)
                    .catch(error => console.log(error.response));
            return false;

        }
    },
    mounted() {
        this.obtenerTipoActividades();
    },
    beforeUpdate(){

    }
}
</script>

<style scoped>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 300px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}
</style>
  -->
