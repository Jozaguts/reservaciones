<template>
    <v-row>
        <div class="col-4">
            <div class="form-group row align-items-baseline">
                <label for="pago-1" class="col-6 col-form-label">
                    Pago {{ pago }}</label
                >
                <div class="col-6 py-0">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="0.00 $"
                        onkeyup="this.value=this.value.replace(/[^\d]/,'')"
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
                    name="select1-pago-1"
                    id="select1-pago-1"
                    class="form-control"
                >
                    <option v-for="option in allOptions" >
                        {{option}}
                    </option>
                </select>
            </div>
        </div>
    </v-row>
</template>

<script>
export default {
    props:[
        'pago'
    ],
    data() {
        return {
            selectTipoDepago: null,
            allOptions: [],
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
      watch: {
        selectTipoDepago() {
           
            let opciones = this.tiposDePago.filter(tipo => tipo.nombre == this.selectTipoDepago) 
            this.allOptions = opciones[0].opciones
                
            }
            
        
    },
};
</script>

<style></style>
