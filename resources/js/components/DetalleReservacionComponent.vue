<template>
    <tr>
        <th class="d-flex pr-0 justify-content-end ml-2">
            <button
                class="btn btn-secondary"
                v-on:click="cantidad == 0 ? (cantidad = 0) : cantidad--"
            >
                -
            </button>
            <input
                type="text"
                v-model="cantidad"
                onkeyup="this.value=this.value.replace(/[^\d]/,'')"
                class="form-control mx-1 d-inline input-cantidad text-center p-0"
            />
            <button class="btn btn-primary" v-on:click="cantidad++">+</button>
        </th>
        <th>
            <select
                name="persona"
                id="persona"
                class="form-control text-capitalize"
                v-model="persona_id"
                v-on:change="fillOcupacionSelect(actividad_id, persona_id)"
            >
            <option value="" disabled >
                Seleccione una opción
            </option>
                <option
                    v-for="persona in personas"
                    :key="persona.id"
                    :value="persona.id"
                    v-text="persona.nombre"
                >
                </option>
            </select>
        </th>
        <th>
            <select
                class="form-control"
                name="ocupacion"
                id="ocupacion"
                v-model="selectOcupacion"
                v-on:change="
                    getBalancePrecio(actividad_id, persona_id, selectOcupacion, getComisionistaId)
                "
            >
            <option value="" disabled class="text-capitalize">
                Seleccione una opción
            </option>
                <option
                    v-for="(ocupacion, index) in ocupaciones"
                    :key="index"
                    v-text="ocupacion"
                >
                </option>
            </select>
        </th>
        <th>
            <input
                type="text"
                readonly
                class="form-control input-balance"
                v-model="inputBalance"
            />
        </th>
        <th>
            <input
                type="text"
                v-model="inputPrecio"
                class="form-control input-precio"
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                v-on:keyup="sumInputPrecio()"
            />
        </th>
        <th class="d-flex">
            <input
                type="text"
                readonly
                class="form-control totales mx-1"
                :value="draftBalance | currency"
            />
            <input
                type="text"
                readonly
                class="form-control totales mx-1"
                :value="draftPrecio | currency"
            />
        </th>
    </tr>
</template>

<script>
import store from "../store";

export default {
    props: ["actividad_id", "personas", "detalleId"],
    data() {
        return {
            cantidad: 0,
            persona_id: "",
            inputBalance: "",
            inputPrecio: "",
            selectOcupacion: "",
            ocupaciones: [],
            balanceBase: 0,
            precioBase: 0,
            draftPrecio: 0,
            draftBalance: 0
        };
    },
    computed: {
        getComisionistaId() {
            return store.getters.getComisionistaId;
        }
    },
    methods: {
        fillOcupacionSelect(actividadId, personaId) {
            this.selectOcupacion=""
            if (actividadId != "" && personaId != "") {
                try {
                    store.commit("showLoader");
                } catch (error) {
                    console.log(error);
                }
                axios("/reservaciones/fillOcupacionSelect", {
                    params: {
                        actividadId,
                        personaId
                    }
                }).then(res => {
                    this.ocupaciones = res.data.ocupacion;
                    try {
                        store.commit("showLoader");
                    } catch (error) {
                        console.log(error);
                    }
                });
            } else {
                swal({
                    icon: "info",
                    title: "Seleccione una actividad y/o tipo de ocupacion"
                });
            }
        },
        getBalancePrecio(actividadId, personaId, ocupacion, comisionistaId) {
            
            if (actividadId != "" && personaId != "" && ocupacion != "" && comisionistaId != "" ) {
                
                try {
                    store.commit("showLoader");
                } catch (error) {
                    console.log(error);
                }
                axios("/reservaciones/getbalanceprecio", {
                    params: {
                        actividadId,
                        personaId,
                        ocupacion,
                        comisionistaId
                    }
                })
                    .then(res => {
                        this.inputBalance = this.currency(res.data.balance);
                        this.inputPrecio = this.currency(res.data.precio);
                        this.balanceBase = parseInt(res.data.balance);
                        this.precioBase = parseInt(res.data.precio);
                        this.draftPrecio = (this.cantidad * res.data.precio)
                        this.draftBalance = (this.cantidad * res.data.balance)
                        this.actualizarBalanceYPrecio();
                        store.dispatch('setPorcentajeAnticipo', res.data.porcentajeAnticipo)

                        try {
                            store.commit("showLoader");
                        } catch (error) {
                            console.log(error);
                        }
                    })
                    .catch(error => console.log(error));
            }
        },
        currency(value) {
            return new Intl.NumberFormat("en-US", {
                style: "currency",
                currency: "USD",
                minimumFractionDigits: 2
            }).format(value);
        },
        sumaPrecio(cantidad, detalleId) {
            store.commit({
                type: "sumarPrecio",
                data: { cantidad, detalleId }
            });
        },
        sumInputPrecio() {
            if(this.inputPrecio != "") {
                this.draftPrecio = this.cantidad * this.inputPrecio;
                    store.commit({
                        type: "sumarPrecio",
                        data: {
                            cantidad: this.cantidad * this.inputPrecio,
                            detalleId: this.detalleId
                        }
                    });
                }else {
                    this.draftPrecio = this.cantidad * this.inputPrecio;
                    store.commit({
                        type: "sumarPrecio",
                        data: {
                            cantidad: this.cantidad * this.inputPrecio,
                            detalleId: this.detalleId
                        }
                    });
                }
        },
        actualizarBalanceYPrecio() {
            if (this.cantidad >= 0) {
                /* si no modificó el precio, utilizo precioBase */
                if (this.inputPrecio.includes("$")) {
                    this.draftPrecio = this.cantidad * this.precioBase;
                    store.commit({
                        type: "sumarPrecio",
                        data: {
                            cantidad: this.cantidad * this.precioBase,
                            detalleId: this.detalleId
                        }
                    });
                } else {
                    /* si modifo el inputPrecio tomo su valor */
                    this.draftPrecio = this.cantidad * this.inputPrecio;
                    store.commit({
                        type: "sumarPrecio",
                        data: {
                            cantidad: this.cantidad * this.inputPrecio,
                            detalleId: this.detalleId
                        }
                    });
                }
                this.draftBalance = this.cantidad * this.balanceBase;
                store.commit({
                    type: "sumarBalance",
                    data: {
                        cantidad: this.cantidad * this.balanceBase,
                        detalleId: this.detalleId
                    }
                });
            } else if (this.cantidad === 0) {
                this.draftPrecio = 0;
                this.draftBalance = 0;
                store.commit({
                    type: "sumarPrecio",
                    data: {
                        cantidad: this.cantidad * this.precioBase,
                        detalleId: this.detalleId
                    }
                });
                store.commit({
                    type: "sumarBalance",
                    data: {
                        cantidad: this.cantidad * this.balanceBase,
                        detalleId: this.detalleId
                    }
                });
            }
        }
    },
    watch: {
        cantidad() {
            this.actualizarBalanceYPrecio();
        },
    },
    filters:{
         currency(value) {
            return new Intl.NumberFormat("en-US", {
                style: "currency",
                currency: "USD",
                minimumFractionDigits: 2
            }).format(value);
        },
    }
};
</script>

<style>
.input-balance,
.input-precio,
.totales {
    text-align: center;
    max-width: 80px;
    padding-left:5px;
    padding-right:5px;
}
</style>
