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
        tipoComisionistas:[],
        totalAbono1:0,
        totalAbono2:0,
        totalAbono3:0,
        totalAbono4:0,
        totalAbono5:0,
        totalAbonos:0,
        comisionistaId:''

    },
    mutations: {
        saldoPrecio(state,saldo) {
            state.saldoPrecio = 0;
            
            if((state.totalAbonos - state.totalPrecio) < 0){
             state.saldoPrecio = (state.totalAbonos - state.totalPrecio);
           }else if((state.totalAbonos - state.totalPrecio) >= 0) {
             state.saldoPrecio = 0;
           }
        //   console.log(
        //       `
        //       totalBalance: ${state.totalBalance}
        //       totalAbonos: ${state.totalAbonos}
        //       saldoBalance: ${state.saldoBalance}
        //       `
        //   );
        },
        saldoBalance(state, saldo) {
         
           state.saldoBalance = 0;
            
           if((state.totalAbonos - state.totalBalance) < 0){
            state.saldoBalance = (state.totalAbonos - state.totalBalance);
          }else if((state.totalAbonos - state.totalBalance) >= 0) {
            state.saldoBalance = 0;
          }

        },
        comisionistaId(state, comisionistaId) {
          state.comisionistaId = comisionistaId
        },
        totalAbonos(state) {
           state.totalAbonos = state.totalAbono1 +
               state.totalAbono2 +
               state.totalAbono3 +
               state.totalAbono4 +
               state.totalAbono5;

        },
        sumarAbono(state, {nombreAbono, cantidad}) {
            state[nombreAbono] = cantidad
            this.dispatch('totalAbonos')
            .then(() =>{
                this.dispatch('setSaldoBalance', cantidad)
               
            })
            .then(() => {
                this.dispatch('setSaldoPrecio', cantidad)
            })
            .catch(error => console.log(error))
        },
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
        },
        tipoComisionistas(state, comisionistas) {
            state.tipoComisionistas = comisionistas;
        }
    },
    getters: {
        getSaldoPrecio(state) {
            return state.saldoPrecio;
        },
        getSaldoBalance(state) {
            return state.saldoBalance;
        },
        
        getComisionistaId(state) {
          return state.comisionistaId;
        },
        getTotalAbonos(state) {
            return state.totalAbonos;
        },
        getTotalPrecio(state) {
            return state.totalPrecio;
        },
        getTotalBalance(state) {
            return state.totalBalance;
        },
        getAnticipoMinimo(state) {
            return state.anticipoMinimo;
        },
        getTipoComisionistas(state) {
            return state.tipoComisionistas
        }
    },
    actions: {
        setSaldoPrecio({commit}, saldo) {
            commit('saldoPrecio', saldo);
        },
        setSaldoBalance({commit}, saldo) {
            commit('saldoBalance', saldo);
        },
        setComisionistaId({commit}, {value}) {
            commit('comisionistaId', value)
        },
        totalAbonos(context) {
            context.commit('totalAbonos');
        },
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
        },
        setTipoComisionistas(context,comisionistas) {
            context.commit('tipoComisionistas',comisionistas);
        }

    }
});

export default store;
