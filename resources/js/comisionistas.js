import Vue from "vue";
import Vuex from "vuex";
import Vuetify from "vuetify";

Vue.use(Vuex);
Vue.use(Vuetify);

Vue.component('tipo-comisionistas', require('./views/modals/TipoComisionistas.vue').default);
new Vue({
    el: "#comisionistas",
    vuetify: new Vuetify({
        icons: {
            iconfont: "mdi" // default - only for display purposes
        }
    })
});
