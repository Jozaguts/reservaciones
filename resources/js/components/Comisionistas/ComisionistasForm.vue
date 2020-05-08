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
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
            @click="toggleUpdate()"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <ValidationObserver v-slot="{ invalid }">
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
                <validation-provider rules="required|min:8" v-slot="{ errors }">
                  <input type="text" class="form-control" v-model="clave" />
                  <span class="text-danger">{{ errors[0] }}</span>
                </validation-provider>
              </div>
              <div class="form-group col-6 offset-3">
                <label for="nombre">Nombre</label>
                <validation-provider rules="required" v-slot="{ errors }">
                  <input type="text" class="form-control" v-model="nombre" />
                  <span class="text-danger">{{ errors[0] }}</span>
                </validation-provider>
              </div>
              <div class="form-group col-6 offset-3">
                <button
                  class="btn btn-success btn-block"
                  :disabled="invalid"
                  @click="guardar"
                >Guardar</button>
              </div>
            </form>
          </ValidationObserver>
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
      id: "",
      update: false,
      method: "",
      messageError: []
    };
  },

  props: {
    tipoComisionista: {
      type: Object,
      required: false,
      default: null
    }
  },
  watch: {
    tipoComisionista(newValue, oldValue) {
      if (newValue != null) {
        this.clave = newValue.clave;
        this.nombre = newValue.nombre;
        this.id = newValue.id;
        this.update = true;
      }
    }
  },
  methods: {
    toggleUpdate() {
      this.clave = "";
      this.nombre = "";
      this.id = "";
      this.update = false;
    },
    guardar() {
      if (this.clave != "" && this.nombre != "" && this.update === false) {
        axios
          .post("/comisionistas", {
            clave: this.clave,
            nombre: this.nombre
          })
          .then(response => {
            console.log(response.data.tipoComisionistas)
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
          .then(() => {
            $("#comisionistasForm").modal("hide");
            this.clave = "";
            this.nombre = "";
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
            console.error(this.messageError);
            setTimeout(() => {
              $(".close").alert("close");
              this.messageError = [];
            }, 3000);
          });
      } else {
        if (this.update) {
          axios
            .put(`comisionistas/${this.id}`, {
              tipoComisionistas: {
                clave: this.clave,
                nombre: this.nombre
              }
            })
            .then(response => {
              store.dispatch(
              "setTipoComisionistas",
              response.data.tipoComisionista
            );
              swal({
                title: "¡Guardado!",
                icon: "success",
                text: response.data.success
              });
            })
            .then(() => {
              $("#comisionistasForm").modal("hide");
              this.clave = "";
              this.nombre = "";
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
            console.error(this.messageError);
            setTimeout(() => {
              $(".close").alert("close");
              this.messageError = [];
            }, 3000);
          });
        }
      }
    }
  }
};
</script>
