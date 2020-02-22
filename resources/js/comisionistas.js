import Vue from "vue";
import Vuex from "vuex";
import Vuetify from "vuetify";

Vue.use(Vuex);
Vue.use(Vuetify);

import comisionistas from './views/Comisionistas.vue'
new Vue({
    el: "#comisionistas",
    components: {
        "comisionistas-component":comisionistas
    },
    vuetify: new Vuetify({
        icons: {
            iconfont: "mdi" 
        }
    })
});
