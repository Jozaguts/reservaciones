import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

let store = new Vuex.Store({
    state: {
        showCreateReservationModal: false,
        showLoader: false,
        totalPrecio: 0,
        totalBalance: 0,
        totalDetalle1: 0,
        totalDetalle2: 0,
        totalDetalle3: 0,
        totalDetalle4: 0,
        totalDetalle5: 0,
        totaBalanceDetalle1: 0,
        totaBalanceDetalle2: 0,
        totaBalanceDetalle3: 0,
        totaBalanceDetalle4: 0,
        totaBalanceDetalle5: 0,
        saldoBalance: 0,
        saldoPrecio: 0,
        porcentajeAnticipo: 0,
        anticipoMinimo: 0,
    },
    mutations: {
        showLoader(state) {
            state.showLoader = !state.showLoader;
        },
        sumarPrecio(state, data) {
            let id = data.data["detalleId"];
            state[`totalDetalle${id}`] = +data.data["cantidad"];
            this.dispatch("sumarToTalPrecio");
        },
        sumarBalance(state, data) {
            let id = data.data["detalleId"];
            state[`totaBalanceDetalle${id}`] = +data.data["cantidad"];
            this.dispatch("sumarTotalBalance");
        },
        sumarTotalPrecio(state) {
            state.totalPrecio =
                state.totalDetalle1 +
                state.totalDetalle2 +
                state.totalDetalle3 +
                state.totalDetalle4 +
                state.totalDetalle5;
        },
        sumarTotalBalance(state) {
            state.totalBalance =
                state.totaBalanceDetalle1 +
                state.totaBalanceDetalle2 +
                state.totaBalanceDetalle3 +
                state.totaBalanceDetalle4 +
                state.totaBalanceDetalle5;
        },
        porcentajeAnticipo(state, anticipo) {
            state.porcentajeAnticipo = anticipo
        },
        anticipoMinimo(state) {
            state.anticipoMinimo = (state.totalBalance * state.porcentajeAnticipo) / 100;
        }
    },
    getters: {
        getTotalPrecio(state) {
            return state.totalPrecio;
        },
        getTotalBalance(state) {
            return state.totalBalance;
        },
        getAnticipoMinimo(state) {
            return state.anticipoMinimo;
        }
    },
    actions: {
        sumarToTalPrecio(context) {
            context.commit("sumarTotalPrecio");
        },
        sumarTotalBalance(context) {
            context.commit("sumarTotalBalance");
            context.commit('anticipoMinimo');

        },
        setPorcentajeAnticipo(context,anticipo) {
            context.commit('porcentajeAnticipo',anticipo);
        },
        setAnticipoMinimo(context) {
            context.commit('anticipoMinimo');
        }
    }
});

export default store;
