import Vue from "vue";
import Vuex from "vuex";
import Vuetify from "vuetify";
import {ValidationObserver, ValidationProvider, extend  } from 'vee-validate';
import { required,min } from 'vee-validate/dist/rules';
import Comisionistas from './views/Comisionistas.vue'


Vue.use(Vuex);
Vue.use(Vuetify);
Vue.component('ValidationObserver', ValidationObserver);
Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ComisionistasComponent', Comisionistas);

// Add a rule.
extend('required', {
    ...required,
    message: 'Campo es requerido'
});
extend('min', {
    ...min,
    message: 'Mínimo 8 caracteres'
})

new Vue({
    el: "#comisionistas",
    vuetify: new Vuetify({
        icons: {
            iconfont: "mdi"
        }
    })
});
