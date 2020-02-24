<template>
  <div
    class="modal fade"
    tabindex="-1"
    role="dialog"
    aria-labelledby="comisionistas"
    aria-hidden="true"
    id="comisionistasForm"
  >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tipoComisionistasLabel">Tipo comisionistas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form v-on:submit.prevent>
            <div
              class="alert alert-danger alert-dismissible fade show"
              role="alert"
              v-if="messageError.length > 0"
            >
              <p v-for="error in messageError" :key="error" v-html="error"></p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="form-group col-6 offset-3">
              <label for="clave">Clave</label>
              <input type="text" class="form-control" v-model="clave" />
            </div>
            <div class="form-group col-6 offset-3">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" v-model="nombre" />
            </div>
            <div class="form-group col-6 offset-3">
              <button class="btn btn-success btn-block" @click="guardar">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import store from "../../store/";
export default {
  data() {
    return {
      clave: "",
      nombre: "",
      messageError: []
    };
  },
  props: {
      tipoComisionistaId: {
          required: false,
      }
  },
  methods: {
    guardar() {
      if (this.clave != "" && this.nombre != "") {
        axios
          .post("/comisionistas", {
            clave: this.clave,
            nombre: this.nombre
          })
          .then(response => {
            store.dispatch(
              "setTipoComisionistas",
              response.data.tipoComisionistas
            );
            swal({
              title: "¡Guardado!",
              icon: "success",
              text: response.data.response
            });
          })
          .catch(error => {
            let errros = error.response.data.errors;
            for (const key in errros) {
              if (errros.hasOwnProperty(key)) {
                const messageError = errros[key];
                this.messageError.push(
                  `<strong class="text-capitalize">${key}!</strong> ${messageError}.`
                );
              }
            }
            console.log(this.messageError);
          });
      }
    }
  }
};
</script>
