<template id="bs-modal">
    <div
        id="create-reservation-modal"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        aria-labelledby="my-modal-title"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">
                        Crear Reservación
                    </h5>
                    <Loader :status="loaderStatus" />
                    <button
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container"> <!-- inicio del container del model -->
                        <v-stepper v-model="e6" vertical>
                             <v-stepper-header>
                                <template v-for="n in steps">
                                    <v-stepper-step
                                    :key="`${n.value}-step`"
                                    :complete="e6 > n"
                                    :step="n.value"
                                    editable
                                    >
                                     {{ n.name }}
                                    </v-stepper-step>

                                    <v-divider
                                    v-if="n.value !== steps"
                                    :key="n.value"
                                    ></v-divider>
                                </template>
                            </v-stepper-header>
                             <v-stepper-items>
                                <v-stepper-content step="1">
                                    <div class="row">
                                        <div class="col-xs-4 col-md-4">
                                            <div class="form-group">
                                                <label for="my-input">Actividad</label>
                                                <select
                                                    name="actividad"
                                                    id="actividad"
                                                    class="form-control"
                                                    v-model="actividad_id"
                                                >
                                                    <option value="" disabled
                                                        >Seleccione una actividad</option
                                                    >
                                                    <option
                                                        v-for="actividad in actividades"
                                                        :value="actividad.id"
                                                        v-text="actividad.nombre"
                                                        :key="actividad.id"
                                                    ></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-md-4">
                                            <div class="container p-0">
                                                <div class="row p-0">
                                                    <div class="col-sx-12 col-md-12 p-0">
                                                        <label for="fecha">Fecha</label>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            v-model="date"
                                                            readonly
                                                            @click="picker = !picker"
                                                        />
                                                        <template class="fade">
                                                            <v-date-picker
                                                                v-model="date"
                                                                :full-width="true"
                                                                v-if="picker"
                                                                @click:date="clickDate"
                                                                locale="es"
                                                            >
                                                            </v-date-picker>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- horarios -->
                                        <div class="col-xs-4 col-md-4">
                                            <label for="fecha">Horarios</label>
                                            <select
                                                name="horarios"
                                                id="horarios"
                                                class="form-control"
                                                v-model="horario_id"
                                                @change="getSalidasLlegadas()"
                                            >
                                                <option value="false" disabled selected
                                                    >Seleccione un Horario</option
                                                >
                                                <option
                                                    v-for="(horario, index) in horarios"
                                                    :key="index"
                                                    v-text="
                                                        horario.hini + ' | ' + horario.hfin
                                                    "
                                                    :value="horario.id"
                                                >
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- segunda fila -->
                                        <!-- salida ubicación  -->
                                        <div class="col-xs-4 col-md-4">
                                            <label for="salidas">Salida | Ubicación</label>
                                            <select
                                                name="salidas"
                                                id="salidas"
                                                class="form-control"
                                            >
                                                <option
                                                    :value="salida.id"
                                                    v-for="salida in salidas"
                                                    :key="salida.id"
                                                    v-text="salida.salida"
                                                >
                                                </option>
                                            </select>
                                        </div>
                                        <!-- ucupación -->
                                        <div class="col-md-4 col-xs-12 text-center">
                                            <label for="Ocupación">Ocupación</label>
                                            <p
                                                name="ocupacion"
                                                id="ocupacion"
                                                v-if="ocupacion"
                                            >
                                                <span
                                                    v-text="ocupacion.ocupacion + ' O /'"
                                                    class="ocupacion_span"
                                                >
                                                </span>
                                                <span
                                                    v-text="ocupacion.disponibilidad + ' D'"
                                                    class="disponibilidad_span"
                                                >
                                                </span>
                                            </p>
                                        </div>
                                        <!-- Llegadas ubicación  -->
                                        <div class="col-xs-4 col-md-4">
                                            <label for="llegada">Llegada | Ubicación</label>
                                            <select
                                                name="llegada"
                                                id="llegada"
                                                class="form-control"
                                            >
                                                <option
                                                    :value="llegada.id"
                                                    v-for="llegada in llegadas"
                                                    :key="llegada.id"
                                                    v-text="llegada.llegada"
                                                >
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- 3er row -->
                                    <div class="row">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="th-custom">
                                                        Cantidad
                                                    </th>
                                                    <th class="th-custom">
                                                        personas
                                                    </th>
                                                    <th class="th-custom">
                                                        ocupación
                                                    </th>
                                                    <th class="th-custom">
                                                        balance
                                                    </th>
                                                    <th class="th-custom">
                                                        precio
                                                    </th>
                                                    <th class="th-custom">
                                                        totales
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <DetalleReservacion
                                                    :actividad_id="actividad_id"
                                                    :personas="personas"
                                                    v-for="i in 5"
                                                    :detalleId="i"
                                                    :key="i"
                                                >
                                                </DetalleReservacion>
                                                <tr>
                                                    <td colspan="5">
                                                        <div
                                                            class="form-group d-flex align-items-baseline text-center"
                                                        >
                                                            <label
                                                                for="nom-reserva"
                                                                class="text "
                                                                >Nombre de
                                                                reservacion</label
                                                            >
                                                            <input
                                                                type="text"
                                                                id="nom-reserva"
                                                                class="form-control col-8 ml-auto"
                                                            />
                                                        </div>
                                                    </td>
                                                    <td colspan="2" class="d-flex">
                                                        <input
                                                            type="text"
                                                            readonly
                                                            class="form-control totales mr-1 totalBold d-inline"
                                                            v-model="getTotalBalance"
                                                        />
                                                        <input
                                                            type="text"
                                                            readonly
                                                            class="form-control totales totalBold d-inline"
                                                            v-model="getTotalPrecio"
                                                        />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5">
                                                        <div
                                                            class="form-group d-flex align-items-baseline text-center"
                                                        >
                                                            <label
                                                                for="nom-comisionista"
                                                                class="text "
                                                                >Comisionista</label
                                                            >
                                                            <select
                                                                name="nom-comisionista"
                                                                id="nom-comisionista"
                                                                class="form-control col-8 ml-auto"
                                                            >
                                                                <option>
                                                                    Seleccione un
                                                                    comisionista
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td colspan="2">
                                                        <button class="btn btn-success col"  @click="e6 = 2">
                                                            Siguiente
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </v-stepper-content>
                                 <v-stepper-content step="2">
                                    <v-container>
                                        <v-row>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="total-balance">Total Balance</label>
                                                    <input type="text" min="0" class="form-control" readonly>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="total-Precio">Total Precio</label>
                                                    <input type="text" min="0" class="form-control" readonly>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group ">
                                                    <label for="anticipo Minimo">Anticipo Minimo </label>
                                                    <input type="text" min="0" class="form-control" readonly>
                                                </div>
                                            </div>
                                        </v-row>
                                        <v-row>
                                            <div class="col-4">
                                                <div class="form-group row align-items-baseline">
                                                    <label for="pago-1" class="col-6 col-form-label"> Pago 1</label>
                                                    <div class="col-6 py-0">
                                                    <input type="text" min="0" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group row align-items-baseline">
                                                    <select
                                                    name="select1-pago-1"
                                                    id="select1-pago-1"
                                                    class="form-control"
                                                    >
                                                    <option>
                                                        opcion 1
                                                    </option>
                                                    <option>
                                                        opcion 2
                                                    </option>
                                                    <option>
                                                        opcion 3
                                                    </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group row align-items-baseline">
                                                    <select
                                                    name="select1-pago-1"
                                                    id="select1-pago-1"
                                                    class="form-control"
                                                    >
                                                    <option>
                                                        opcion 1
                                                    </option>
                                                    <option>
                                                        opcion 2
                                                    </option>
                                                    <option>
                                                        opcion 3
                                                    </option>
                                                    </select>
                                                </div>
                                            </div>                                           
                                        </v-row>
                                        <v-row>
                                            <div class="col-4">
                                                <div class="form-group row align-items-baseline">
                                                    <label for="pago-1" class="col-6 col-form-label"> Pago 2</label>
                                                    <div class="col-6 py-0">
                                                    <input type="text" min="0" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group row align-items-baseline">
                                                    <select
                                                    name="select1-pago-1"
                                                    id="select1-pago-1"
                                                    class="form-control"
                                                    >
                                                    <option>
                                                        opcion 1
                                                    </option>
                                                    <option>
                                                        opcion 2
                                                    </option>
                                                    <option>
                                                        opcion 3
                                                    </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group row align-items-baseline">
                                                    <select
                                                    name="select1-pago-1"
                                                    id="select1-pago-1"
                                                    class="form-control"
                                                    >
                                                    <option>
                                                        opcion 1
                                                    </option>
                                                    <option>
                                                        opcion 2
                                                    </option>
                                                    <option>
                                                        opcion 3
                                                    </option>
                                                    </select>
                                                </div>
                                            </div>                                           
                                        </v-row>
                                        <v-row>
                                            <div class="col-4">
                                                <div class="form-group row align-items-baseline">
                                                    <label for="pago-1" class="col-6 col-form-label"> Pago 3</label>
                                                    <div class="col-6 py-0">
                                                    <input type="text" min="0" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group row align-items-baseline">
                                                    <select
                                                    name="select1-pago-1"
                                                    id="select1-pago-1"
                                                    class="form-control"
                                                    >
                                                    <option>
                                                        opcion 1
                                                    </option>
                                                    <option>
                                                        opcion 2
                                                    </option>
                                                    <option>
                                                        opcion 3
                                                    </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group row align-items-baseline">
                                                    <select
                                                    name="select1-pago-1"
                                                    id="select1-pago-1"
                                                    class="form-control"
                                                    >
                                                    <option>
                                                        opcion 1
                                                    </option>
                                                    <option>
                                                        opcion 2
                                                    </option>
                                                    <option>
                                                        opcion 3
                                                    </option>
                                                    </select>
                                                </div>
                                            </div>                                           
                                        </v-row>
                                        <v-row>
                                            <div class="col-4">
                                                <div class="form-group row align-items-baseline">
                                                    <label for="pago-1" class="col-6 col-form-label"> Pago 4</label>
                                                    <div class="col-6 py-0">
                                                    <input type="text" min="0" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group row align-items-baseline">
                                                    <select
                                                    name="select1-pago-1"
                                                    id="select1-pago-1"
                                                    class="form-control"
                                                    >
                                                    <option>
                                                        opcion 1
                                                    </option>
                                                    <option>
                                                        opcion 2
                                                    </option>
                                                    <option>
                                                        opcion 3
                                                    </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group row align-items-baseline">
                                                    <select
                                                    name="select1-pago-1"
                                                    id="select1-pago-1"
                                                    class="form-control"
                                                    >
                                                    <option>
                                                        opcion 1
                                                    </option>
                                                    <option>
                                                        opcion 2
                                                    </option>
                                                    <option>
                                                        opcion 3
                                                    </option>
                                                    </select>
                                                </div>
                                            </div>                                           
                                        </v-row>
                                        <!-- fila de totales -->
                                        <v-row>
                                            <div class="col-4 mr-auto">
                                                <div class="form-group row">
                                                    <label class="col-6 row text-bold ml-3"> Totales</label>
                                                    <div class="col-6">
                                                        <input type="text" class="form-control" readonly placeholder="$1,000.00">
                                                    </div>
                                                </div>
                                            </div>
                                        </v-row>
                                        <v-row>
                                            <div class="col-5">
                                                <div class="form-group text-center d-flex flex-column align-items-center">
                                                    <label for="saldo-balance" class="display-1">Saldo Balance</label>
                                                    <input type="text" class="form-control col-6" readonly placeholder="$300.00">
                                                    <select class="form-control col-6">
                                                        <option>
                                                            CxC
                                                        </option>
                                                        <option>
                                                            Onboard
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div class="form-group text-center d-flex flex-column align-items-center">
                                                    <label for="saldo-doble" class="display-1 mt-1">Saldo Precio</label>
                                                    <input type="text" class="form-control col-6 mt-1" readonly placeholder="$1,300.00">
                                                    <select class="form-control col-6">
                                                        <option>
                                                            Descartar
                                                        </option>
                                                        <option>
                                                            Onboard
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2 d-flex align-items-end">
                                                <div class="form-group">
                                                    <button class="btn btn-success">
                                                        Confirmar
                                                    </button>
                                                </div>
                                            </div>
                                        </v-row>
                                    </v-container> 
                                </v-stepper-content>
                            </v-stepper-items>
                        </v-stepper>
                    </div> <!-- fin del container -->
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import DetalleReservacion from "../DetalleReservacionComponent.vue";
import Loader from "../LoaderComponent.vue";
import store from "../../store/index.js";
export default {
    components: {
        DetalleReservacion,
        Loader
    },
    computed: {
        loaderStatus() {
            return store.state.showLoader;
        },
        getTotalPrecio() {
            return (this.totalPrecio = store.getters.getTotalPrecio);
        },
        getTotalBalance() {
            return (this.totalBalance = store.getters.getTotalBalance);
        }
    },
    data() {
        return {
            steps:[
                {
                    value: 1,
                    name: "Reservaciones"
                },
                {
                    value: 2,
                    name: "Pagos"
                }
            ],
            e6: 1,
            actividad_id: "",
            horario_id: "",
            actividades: [],
            horarios: [],
            salidas: [],
            llegadas: [],
            personas: [],
            ocupacion: "",
            focus: moment().format("Y-M-D"),
            date: new Date().toISOString().substr(0, 10),
            picker: false,
            totalPrecio: 0,
            totalBalance: 0
        };
    },
    methods: {
        async getActividades() {
            try {
                store.commit("showLoader");
            } catch (error) {
                console.log(error);
            }
            await axios
                .get("/reservaciones/getActividades")
                .then(res => {
                    this.actividades = res.data.actividades;
                    try {
                        store.commit("showLoader");
                    } catch (error) {
                        console.log(error);
                    }
                })
                .catch(error => console.log(error));
        },
        clickDate() {
            this.picker = !this.picker;
            if (this.date != "" && this.actividad_id != "") {
                let dia = moment(this.date).get("day");
                switch (dia) {
                    case 0:
                        dia = "d";
                        break;
                    case 1:
                        dia = "l";
                        break;
                    case 2:
                        dia = "m";
                        break;
                    case 3:
                        dia = "x";
                        break;
                    case 4:
                        dia = "j";
                        break;
                    case 5:
                        dia = "v";
                        break;
                    case 6:
                        dia = "s";
                        break;
                    default:
                        break;
                }
                this.getHorarios(this.actividad_id, dia);
            }
        },
        async getHorarios(idactividad, dia) {
            try {
                store.commit("showLoader");
            } catch (error) {
                console.log(error);
            }
            await axios
                .get("/reservaciones/gethorarios", {
                    params: {
                        idactividad: idactividad,
                        dia: dia
                    }
                })
                .then(res => {
                    this.horarios = res.data.horarios;
                    try {
                        store.commit("showLoader");
                    } catch (error) {
                        console.log(error);
                    }
                })
                .catch(error => console.log(error));
        },
        getSalidasLlegadas() {
            try {
                store.commit("showLoader");
            } catch (error) {
                console.log(error);
            }
            axios
                .get("/reservaciones/getsalidas-llegadas", {
                    params: {
                        horarioId: this.horario_id
                    }
                })
                .then(res => {
                    this.salidas = res.data.salidas;
                    this.llegadas = res.data.llegadas;
                    this.ocupacion = res.data.ocupacion;
                    try {
                        store.commit("showLoader");
                    } catch (error) {
                        console.log(error);
                    }
                })
                .catch(error => console.log(error));
        },
        getPersonas() {
            axios
                .get("/reservaciones/getpersonas")
                .then(res => (this.personas = res.data.personas))
                .catch(error => console.log(error));
        }
    },
    created() {
        this.getActividades();
        this.getPersonas();
    }
};
</script>

<style>
.ocupacion_span {
    color: #3490dc;
}
.disponibilidad_span {
    color: #38c172;
}
th {
    text-transform: capitalize;
}
.input-cantidad {
    max-width: 60px;
}
.totalBold,
.totalBold::placeholder {
    font-weight: 900;
}
.v-stepper--vertical .v-stepper__content {
    padding: 0 !important;
    margin:0 !important;
}
.th-custom{
    text-align:center;
}
.text {
    padding-left: 1rem;
}
</style>
