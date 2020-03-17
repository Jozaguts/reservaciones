<template>
    <model-select :options="options"
                  v-model="item"
                  placeholder="Seleccione un comisionista">
    </model-select>
</template>

<script>
    import { ModelSelect } from 'vue-search-select';

    export default {
        name: "SelectDinamico",
        props:['options',],
        data () {
            return {
                options: [
                    { value: '1', text: 'COM01 Alfredo Rios'},
                    { value: '2', text: 'COM02 Jose Gutíerrez' },
                    { value: '3', text: 'COM03 David Hernandez' },
                    { value: '4', text: 'COM04 Fernanda Suarez' },
                    { value: '5', text: 'COM05 Ernesto Valle' }
                ],
                item: {
                    value: '',
                    text: ''
                },
            }
        },
        methods: {
            reset () {
                this.item = {}
            },
            selectFromParentComponent1 () {
                // select option from parent component
                this.item = this.options[0]
            },
                 },
        components: {
            ModelSelect
        }
    }
</script>

<style scoped>

</style>
