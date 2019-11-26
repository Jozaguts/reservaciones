<template>
<v-app >
 <div class="text-center">
      <v-color-picker
        v-model="color"
        :hide-canvas="hideCanvas"
        :hide-inputs="hideInputs"
        :hide-mode-switch="hideModeSwitch"
        :show-swatches="showSwatches"
        class="text-center mx-auto my-auto"
      >
      </v-color-picker>
    </div>
</v-app>
</template>

<script>
export default {
    data(){
        return{
            hideCanvas:true,
            hideInputs:true,
            showSwatches:false,
            hideModeSwitch:false,
            color:""
        }
    }

}
</script>

<style lang="scss">
.v-application--wrap{
    min-height: 0 !important
}
.theme--light, .v-application{
    background: transparent !important;
}
</style>
