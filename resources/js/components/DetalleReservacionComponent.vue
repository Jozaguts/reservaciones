<template>
    <tr>
        <th class="d-flex">
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
                class="form-control mx-1 d-inline input-cantidad text-center"
            />
            <button class="btn btn-primary" v-on:click="cantidad++">+</button>
        </th>
        <th>
            <select
                name="persona"
                id="persona"
                class="form-control"
                v-model="persona_id"
                v-on:change="fillOcupacionSelect(actividad_id, persona_id)"
            >
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
                    getBalancePrecio(actividad_id, persona_id, selectOcupacion)
                "
            >
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
            />
        </th>
        <th class="d-flex">
            <input
                type="text"
                readonly
                class="form-control totales mx-1"
                v-model="draftBalance"
            />
            <input
                type="text"
                readonly
                class="form-control totales mx-1"
                v-model="draftPrecio"
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
    methods: {
        fillOcupacionSelect(actividadId, personaId) {
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
        getBalancePrecio(actividadId, personaId, ocupacion) {
            if (actividadId != "" && personaId != "" && ocupacion != "") {
                try {
                    store.commit("showLoader");
                } catch (error) {
                    console.log(error);
                }
                axios("/reservaciones/getbalanceprecio", {
                    params: {
                        actividadId,
                        personaId,
                        ocupacion
                    }
                })
                    .then(res => {
                        this.inputBalance = this.currency(res.data.balance);
                        this.inputPrecio = this.currency(res.data.precio);
                        this.balanceBase = parseInt(res.data.balance);
                        this.precioBase = parseInt(res.data.precio);
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
        }
    },
    watch: {
        cantidad() {
            if (this.cantidad > 0) {
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
    }
};
</script>

<style>
.input-balance,
.input-precio,
.totales {
    text-align: center;
    max-width: 80px;
}
</style>
