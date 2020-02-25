
window.addEventListener('click', function(e){
    if (document.getElementById('btnUserName').contains(e.target)){

      let toggleStatus = 1;
      function toggleMenu (){
        if(toggleStatus==1){

          btnLogOut.classList.remove("d-none");
          btnLogOut.classList.add("show");
          toggleStatus = 0;
        }else if(toggleStatus==0){
          btnLogOut.classList.remove("show");
          btnLogOut.classList.add("d-none");
          toggleStatus=1;
        }
      }
      toggleMenu();
      // Clicked in box
    } else{
      if( btnLogOut.classList.contains("show")){
        btnLogOut.classList.remove("show");
        btnLogOut.classList.toggle("d-none");
      }
    }
  });
  import Vue from 'vue';
  import Vuex from 'vuex';
  import Vuetify from 'vuetify';
  import VueCommonFilters from 'vue-common-filters'
   
  // THESE ARE ALL OPTIONS YOU CAN CUSTOMIZE
  // YOU ARE NOT REQUIRED TO COPY ALL THESE OPTIONS
  // YOU CAN PASS EMPTY OR NO OPTIONS AT ALL
   
  let config = {
      "currency": {
          "symbol": "$",
          "decimalDigits": 2,
          "symbolOnLeft": false,
          "spaceBetweenAmountAndSymbol": true
      },
   
      "text": {
          "truncateClamp": "..."
      },
   
      "numbers": {
          "decimalDigits": 2
      },
   
      "array": {
          "implodeDelimiter": ", "
      },
   
      "dates": {
          "defaultFormat": "YYYY-MM-DD HH:mm:ss",
          "filterConvertFormat": "DD MMMM YYYY"
      }
  }
   
  Vue.use(VueCommonFilters, config)
  window.Vue = require('vue');
  Vue.use(Vuex);
  Vue.use(Vuetify);


  Vue.component('dasboard', require('./components/DashboardComponent.vue').default);
  Vue.component('calendar', require('./components/CalendarComponent.vue').default);
 new Vue({
  el: "#dashboard",
  vuetify: new Vuetify({
    icons: {
      iconfont: 'mdi', // default - only for display purposes
    },
  })


})
