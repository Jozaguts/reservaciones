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
                options2: [
                    { value: '1', text: 'aa' + ' - ' + '1' },
                    { value: '2', text: 'ab' + ' - ' + '2' },
                    { value: '3', text: 'bc' + ' - ' + '3' },
                    { value: '4', text: 'cd' + ' - ' + '4' },
                    { value: '5', text: 'de' + ' - ' + '5' }
                ],
                item2: ''
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
            reset2 () {
                this.item2 = ''
            },
            selectFromParentComponent2 () {
                // select option from parent component
                this.item2 = this.options2[0].value
            }
        },
        components: {
            ModelSelect
        }
    }
</script>

<style scoped>

</style>
