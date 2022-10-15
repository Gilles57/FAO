// assets/js/calendar/index.js
import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import frLocale from '@fullcalendar/core/locales/fr';

import "./index.css"; // this will create a calendar.css file reachable to 'encore_entry_link_tags'

document.addEventListener("DOMContentLoaded", () => {
  let calendarEl = document.getElementById("calendar-holder");
  let { eventsUrl } = calendarEl.dataset;
          console.log(JSON.stringify({}))

  let calendar = new Calendar(calendarEl, {
    locale: frLocale,
    // themeSystem: 'bootstrap5',
    editable: true,
    expandRows: true,
    dayMaxEvents: false,
    contentHeight: 200,
    eventSources: [
      {
        url: eventsUrl,
        method: "POST",
        extraParams: {
          filters: JSON.stringify({}) // pass your parameters to the subscriber
        },
        failure: () => {
          alert("Il y a eu une erreur à la création de l'agenda!");
        },
      },
    ],
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay"
    },

    initialView: "dayGridMonth",
    height: '100%',
    navLinks: true, // can click day/week names to navigate views
    plugins: [ interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin ],
    timeZone: "UTC",
  });

  calendar.render();
});
