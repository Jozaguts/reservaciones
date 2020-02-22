<template>
  <table class="table">
    <thead>
      <tr>
        <th class="table-head">Clave</th>
        <th class="table-head">Apellidos</th>
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
          ></a>
          <a href="#!" class="table-head table-head__btn btn btn-delete btn-danger"></a>
        </td>
      </tr>

    </tbody>
  </table>
</template>

<script>
import store from '../../store';
export default {
    data() {
        return {
            tipoComisionistas:[]
        }
    },
    // revisar la logica de computed properties y watchers
    computed: {
        countTipoComisionistas() {
            return this.tipoComisionistas = store.getters.getTipoComisionistas;
        }
    },
    watch: {
        countTipoComisionistas(oldValue, newValue) {
            return newValue;
        }
    },
    methods: {
        getTipoComisionistas() {
            axios.get('/comisionistas/')
            .then((result) => {
                this.tipoComisionistas = result.data.tipoComisionistas
            }).catch((err) => {
                
            });
        }
    },
    beforeMount () {
        this.getTipoComisionistas();
    }
};
</script>

<style>
</style>