<template>
    <model-select :options="options"
                  v-model="item"
                  placeholder="Seleccione un comisionista"
                  :change="setComisionistaId()"
    >
    </model-select>
</template>

<script>
    import { ModelSelect } from 'vue-search-select';
    import store from '../store';

    export default {
        name: "SelectDinamico",
        data () {
            return {
                options: [ ],
                item: {
                    value: '',
                    text: ''
                },
            }
        },
        methods: {
            getComisionistas() {
                axios.get('comisionistas/all')
                    .then(response => {
                        response.data.comisionistas.map(comisionista => {
                            const data = {
                                value: comisionista.id,
                                text: comisionista.nombre
                            }
                            this.options.push(data)
                        })
                    })
                    .catch(erros =>console.error(erros))
            },
            setComisionistaId() {
                
                if(this.item.value != ''){
                    store.dispatch('setComisionistaId', this.item);
                }else{
                    console.log('seleccione un comisionista')
                }
                   
                
            }

            // reset () {
            //     this.item = {}
            // },
            // selectFromParentComponent1 () {
            //     // select option from parent component
            //     this.item = this.options[0]
            // },
                 },
        components: {
            ModelSelect
        },
        created() {
            this.getComisionistas();
        }
    }
</script>

<style scoped>

</style>
