<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script>

    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            center: 'addEventButton'
        },
        customButtons: {
            addEventButton: {
            text: 'add event...',
            click: function() {
                var dateStr = prompt('Enter a date in YYYY-MM-DD format');
                var date = new Date(dateStr + 'T00:00:00'); // will be in local time

            if (!isNaN(date.valueOf())) { // check if the date is valid
                calendar.addEvent({
                title: 'dynamic event',
                start: date,
                allDay: true
                });
                alert('Great. Now, update your database...');

                // update database
                $newEvent = new Event();
                $newEvent->set_title() = "CNY";
                $newEvent->set_date() = $date;
                
            } else {
                alert('Invalid date.');
            }
        }
      }
    }
    });

    calendar.render();
    });

    </script>
  </head>
  <body>
    <div id='calendar'></div>
  </body>
</html>