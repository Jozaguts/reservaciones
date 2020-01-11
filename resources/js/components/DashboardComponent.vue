<template>
<v-app>

  <v-row class="fill-height pr-5">
    <create-reservaciones > </create-reservaciones>
    <v-col cols="4" class="justify-center"  v-if="showCalendar">
       <v-date-picker
      v-model="focus"
      width="290"
      @click:date="clickDate"
      class="mt-4"
    ></v-date-picker>
    </v-col>
    <v-col >
      <v-sheet height="64">
        <v-toolbar flat color="white">
          <v-btn outlined class="mr-4" type="button" data-toggle="modal" data-target="#create-reservation-modal">
             <v-icon class="display-1 reserva-add" >mdi-calendar-plus</v-icon>
          </v-btn>
          <v-btn outlined class="mr-4" @click="setToday">
            Hoy
          </v-btn>
          <v-btn fab text small @click="prev">
            <v-icon small>mdi-chevron-left</v-icon>
          </v-btn>
          <v-btn fab text small @click="next">
            <v-icon small>mdi-chevron-right</v-icon>
          </v-btn>
          <v-toolbar-title>{{ title }}</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-menu bottom right>
            <template v-slot:activator="{ on }">
              <v-btn
                outlined
                v-on="on"
              >
                <span>{{ typeToLabel[type] }}</span>
                <v-icon right>mdi-menu-down</v-icon>
              </v-btn>
              <v-icon large
                @click="showCalendar = !showCalendar"
              >mdi-calendar-month</v-icon>
            </template>

            <v-list>
              <v-list-item @click="type = 'day'">
                <v-list-item-title>Día</v-list-item-title>
              </v-list-item>
              <v-list-item @click="type = 'week'">
                <v-list-item-title>Semana</v-list-item-title>
              </v-list-item>
              <!-- <v-list-item @click="type = 'month'">
                <v-list-item-title>Month</v-list-item-title>
              </v-list-item> -->
              <!-- <v-list-item @click="type = '4day'">
                <v-list-item-title>4 days</v-list-item-title>
              </v-list-item> -->
            </v-list>
          </v-menu>
        </v-toolbar>
      </v-sheet>
      <v-sheet height="600">
        <v-calendar
          ref="calendar"
          v-model="focus"
          color="primary"
          :events="events"
          :event-color="getEventColor"
          :event-margin-bottom="3"
          :now="today"
          :type="type"
          :weekdays="weekdays"
          @click:event="showEvent"
          @click:more="viewDay"
          @click:date="viewDay"
          @change="updateRange"
        ></v-calendar>
        <v-menu
          v-model="selectedOpen"
          :close-on-content-click="false"
          :activator="selectedElement"
          offset-x
        >
          <v-card
            color="grey lighten-4"
            min-width="350px"
            flat
          >
            <v-toolbar
              :color="selectedEvent.color"
              dark
            >
              <v-btn icon>
                <v-icon class="display-1">mdi-calendar-plus</v-icon>
              </v-btn>
              <v-toolbar-title v-html="selectedEvent.name"></v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn icon>
                <v-icon>mdi-account-multiple-check</v-icon>
              </v-btn>
              <v-btn icon>
                <v-icon>mdi-printer</v-icon>
              </v-btn>
              <!-- <v-btn icon>
                <v-icon>mdi-dots-vertical</v-icon>
              </v-btn> -->
              <v-menu offset-y>
                <template v-slot:activator="{ on }">
                <v-btn
                    icon
                    v-on="on"
                >
                   <v-icon>mdi-dots-vertical</v-icon>
                </v-btn>
                </template>
                <v-list>
                    <v-list-item>
                         <v-icon>mdi-cash-plus</v-icon>
                    </v-list-item>
                    <v-list-item>
                         <v-icon>mdi-pencil</v-icon>
                    </v-list-item>
                <!-- <v-list-item
                    v-for="(item, index) in items"
                    :key="index"
                    @click="">
                    <v-list-item-title>{{ item.title }}</v-list-item-title> -->
                <!-- </v-list-item> -->
                </v-list>
            </v-menu>
            </v-toolbar>
            <v-card-text>
              <span v-html="selectedEvent.details"></span>
            </v-card-text>
            <v-card-actions>
              <v-btn
                text
                color="secondary"
                @click="selectedOpen = false"
              >
                Cancel
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-menu>
      </v-sheet>
    </v-col>
  </v-row>

</v-app>
</template>
<script>
    import CreateReservaciones from './Reservaciones/Create.vue';
    import store from '../store/index.js';
  export default {
      components:{
          'create-reservaciones':CreateReservaciones
      },
    data: () =>({
      today: moment().format('Y-M-D'),
      focus: moment().format('Y-M-D'),
      type:"day",
      typeToLabel:{
        // month: "Mes",
        Week: "Semana",
        day: "Día",
        // "4day": "4 Días"
      },
      name: null,
      details: null,
      start:null,
      color: "#197602",
      currentlyEditing:null,
      selectedEvent:{},
      selectedElement: null,
      selectedOpen:false,
      events:[],
      dialog:false,
      showCalendar:false,
      weekdays:[1, 2, 3, 4, 5, 6, 0]
    }),
    computed: {
      title () {
        const { start, end } = this
        if (!start || !end) {
          return ''
        }

        const startMonth = this.monthFormatter(start)
        const endMonth = this.monthFormatter(end)
        const suffixMonth = startMonth === endMonth ? '' : endMonth

        const startYear = start.year
        const endYear = end.year
        const suffixYear = startYear === endYear ? '' : endYear

        const startDay = start.day + this.nth(start.day)
        const endDay = end.day + this.nth(end.day)

        switch (this.type) {
          case 'month':
            return `${startMonth} ${startYear}`
          case 'week':
          case '4day':
            return `${startMonth} ${startDay} ${startYear} - ${suffixMonth} ${endDay} ${suffixYear}`
          case 'day':
            return `${startMonth} ${startDay} ${startYear}`
        }
        return ''
      },
      monthFormatter () {
        return this.$refs.calendar.getFormatter({
          timeZone: 'UTC', month: 'long',
        })
      },

    },
    mounted(){
         this.getEvents(this.today);
    },
    methods:{
      async getEvents(day){
        try {
           await axios.get('/reservaciones/dashboard', {
            params: {
            day: day
            }
        }).then(res => {
            res.data.horarios.length > 0
            ? this.events = res.data.horarios
            : swal({
                title: "¡No hay asignaciones registradas!",
                icon:"info"
            })

        })
        } catch (error) {
          console.log(error)
        }
      },

      viewDay ({ date }) {
        this.focus = date
        this.type = 'day'
      },
      getEventColor (event) {
        return event.color
      },
      setToday () {
        this.focus = this.today
      },
      prev () {
        this.$refs.calendar.prev()
      },
      next () {
        this.$refs.calendar.next()
      },
      showEvent ({ nativeEvent, event }) {
        const open = () => {
          this.selectedEvent = event
          this.selectedElement = nativeEvent.target
          setTimeout(() => this.selectedOpen = true, 10)
        }

        if (this.selectedOpen) {
          this.selectedOpen = false
          setTimeout(open, 10)
        } else {
          open()
        }

        nativeEvent.stopPropagation()
      },
      updateRange ({ start, end }) {
        // You could load events from an outside source (like database) now that we have the start and end dates on the calendar
        let no_coincidencias = 0;
           this.events.forEach(event =>{

            event.start.substring(0,10) == start.date ? true : no_coincidencias++;
        })
        if(no_coincidencias == this.events.length){
            this.getEvents(start.date)
        }
        this.start = start
        this.end = end

      },
      nth (d) {
        return d > 3 && d < 21
          ? 'th'
          : ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'][d % 10]
      },
    clickDate(){
        this.getEvents(this.focus)
    },
     showCreateReservationModal() {
        //   return store.state.showCreateReservationModal = !store.state.showCreateReservationModal;
        console.log(store.state.showCreateReservationModal = !store.state.showCreateReservationModal);
      }
    }



  };
</script>
<style >
.libre_icon{
    display: inline-block;
    background-image: url(/svg/libre.svg);
    background-size: contain;
    background-position: 50% 50%;
    width: 25px;
    height: 25px;
    margin: 0 .5rem;
    line-height: .2rem;
    text-align: center;
}
.ocupacion_icon{
    display: inline-block;
    background-image: url(/svg/ocupado.svg);
    background-size: contain;
    background-position: 50% 50%;
    width: 25px;
    height: 25px;
    margin: 0 .5rem;
    line-height: .2rem;
    text-align: center;
}
.show_icon{
    display: inline-block;
    background-image: url(/svg/show.svg);
    background-size: contain;
    background-position: 50% 50%;
    width: 25px;
    height: 25px;
    margin: 0 .5rem;
    line-height: .2rem;
    text-align: center;
}
.noshow_icon{
    display: inline-block;
    background-image: url(/svg/noshow.svg);
    background-size: contain;
    background-position: 50% 50%;
    width: 25px;
    height: 25px;
    margin: 0 .5rem;
    line-height: .2rem;
    text-align: center;
}
.v-card__text{
    font-size: 35px !important;
    font-weight: bold !important;
}
.reserva-add{
    color:rgba(0,0,0,.54) !important;
}
</style>
