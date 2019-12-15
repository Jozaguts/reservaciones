
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
  window.Vue = require('vue');
  import Vuetify from 'vuetify';
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
