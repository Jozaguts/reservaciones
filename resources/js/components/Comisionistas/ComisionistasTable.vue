<template>
  <table class="table">
    <thead>
      <tr>
        <th class="table-head">Clave</th>
        <th class="table-head">Nombre</th>
        <th class="table-head">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr id="trBg" v-for="comisionista in tipoComisionistas" :key="comisionista.id">
        <td class="table-head table-head__name">{{comisionista.clave}}</td>
        <td class="table-head table-head__surname">{{comisionista.nombre}}</td>
        <td class="table-head table-head__actions">
          <a
            href="#!"
            class="table-head table-head__btn btn-edit btn btn-primary"
            data-toggle="modal"
            data-target="#comisionistasForm"
            :id="comisionista.id"
            @click="$emit('updatetipocomisionista', {
            id:comisionista.id,
            clave: comisionista.clave,
            nombre: comisionista.nombre
          })"
          ></a>
          <a
            href="#!"
            :id="comisionista.id"
            class="table-head table-head__btn btn btn-delete btn-danger"
            @click="deleteTipoComisionista(comisionista.clave, comisionista.nombre, comisionista.id)"
          ></a>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import store from "../../store";
export default {
  data() {
    return {
      tipoComisionistas: []
    };
  },
  // revisar la logica de computed properties y watchers
  computed: {
    countTipoComisionistas() {
      return (this.tipoComisionistas = store.getters.getTipoComisionistas);
    }
  },
  watch: {
    countTipoComisionistas(oldValue, newValue) {
      return newValue;
    }
  },
  methods: {
    getTipoComisionistas() {
      axios
        .get("/comisionistas/")
        .then(result => {
          this.tipoComisionistas = result.data.tipoComisionistas;
        })
        .catch(err => {});
    },
    getTipoComisionista(id) {
      store.commit("setTipoComisionistaId", id);
    },
    async deleteTipoComisionista(clave, nombre, id) {
      await swal({
        icon: "warning",
        title: "Eliminar Tipo Comisionista",
        text: `Se eliminara al comisionista ${nombre} con clave: ${clave}`,
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          axios(`comisionistas/${id}`, {
            method: "DELETE",
            params: { id }
          }).then(response => {
            if (response.data.success) {
              swal({
                icon: "success",
                text: response.data.success
              });
              this.getTipoComisionistas();
            } else {
              swal({
                icon: "danger",
                text: response.data.errors
              });
            }
          });
        } else {
          swal("Tipo comisionista No ha sido eliminado");
        }
      });
    }
  },
  beforeMount() {
    this.getTipoComisionistas();
  }
};
</script>

<style>
</style>