<script src="<?php echo base_url() ?>assets/admin/js/fullcalendar-main.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        initialDate: '<?php echo date('Y-m-d') ?>',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        // eventClick: function(info) {
        //   alert('Event: ' + info.event.title + ' ' + info.event.start);
        // },
        events: [
          <?php foreach ($appointments as $appointment): ?>
            {
              title: '<?php echo html_escape($appointment->service_name.' - '.$appointment->customer_name) ?>',
              start: '<?php echo html_escape($appointment->date) ?>'
            },
          <?php endforeach; ?>
        ],
        eventColor: '#3CB371'

      });

      calendar.render();
    });

</script>