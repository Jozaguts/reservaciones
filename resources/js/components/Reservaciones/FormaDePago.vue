<template>
    <v-row>
        <div class="col-4">
            <div class="form-group row align-items-baseline">
                <label for="pago-1" class="col-6 col-form-label">
                    Pago {{ pago }}</label
                >
                <div class="col-6 py-0">
                    <input
                        type="number"
                        min="0"
                        step="any"
                        class="form-control"
                        v-model.number="abono"
                        @keyup="setAbono"
                        placeholder="$0.00"
                    />
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group row align-items-baseline">
                <select
                    name="select1-pago-1"
                    id="select1-pago-1"
                    class="form-control"
                    v-model="selectTipoDepago"
                    placeholder="Seleccione un tipo de pago"
                >
                    <option
                        v-for="tipoDePago in tiposDePago"
                        :key="tipoDePago.id"
                    >
                        {{ tipoDePago.nombre }}
                    </option>
                </select>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group row align-items-baseline">
                <select
                    name="select1-pago-2"
                    id="select1-pago-2"
                    class="form-control"
                >
                    <option v-for="(option, index) in allOptions" :key="index">
                        {{option}}
                    </option>
                </select>
            </div>
        </div>
    </v-row>
</template>

<script>
import {mapGetters} from 'vuex';
import store from "../../store/";
export default {
    props:[
        'pago'
    ],
    computed: {
        ...mapGetters([
      'getTotalAbonos'
        ])
    },
    data() {
        return {
            selectTipoDepago: null,
            allOptions: [],
            abono: 0.00,
            tiposDePago: [
            {
                id: "tipo01",
                nombre: "Efectivo",
                    opciones:[
                "Nombre comisionista",
                "Nombre operador",
                "Nombre de otro comisionista",
                "Oficina"
            ]
            },
            {
                id: "tipo02",
                nombre: "Cupón",
                opciones:[123,213,123,67,234,67,9,3,21]
            },
            {
                id: "tipo03",
                nombre: "Tarjeta",
                opciones:[
                    "visa",
                    "MasterCard",
                    "Amex",
                    "otra"
                ]
            },
            {
                id: "tipo04",
                nombre: "Dolares",
                    opciones:[
                "Nombre comisionista",
                "Nombre operador",
                "Nombre de otro comisionista",
                "Oficina"
            ]
            }
        ],
        }
    },
    methods:{
        setAbono() {
            const nombreAbono = `totalAbono${this.pago}`;

            const payload = {
                nombreAbono,
                "cantidad":parseFloat( this.abono)
            }
            if(this.abono > 0){
                store.commit('sumarAbono',payload )
            } else if(this.abono =="") {
                payload.cantidad =0;
                store.commit('sumarAbono',payload )
            }
      }
    },
      watch: {
        selectTipoDepago() {
            let opciones = this.tiposDePago.filter(tipo => tipo.nombre == this.selectTipoDepago)
            this.allOptions = opciones[0].opciones
        }
    },
};
</script>

<style></style>
