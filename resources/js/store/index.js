import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

let store = new Vuex.Store({
    state:{
        showCreateReservationModal: false,
        showLoader: false
    },
    mutations:{
        showLoader(state) {
            state.showLoader = !state.showLoader
        }
    }
});

export default store;

