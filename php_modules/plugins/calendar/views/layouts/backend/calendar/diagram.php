<?php
$this->theme->add($this->url . 'assets/fullcalendar/index.global.js', '', 'fullcalendar-js');
?>
<?php echo $this->render('notification', []); ?>
<div class="main">
    <main class="content p-0 ">
        <div class="container-fluid p-0">
            <div class="row justify-content-center mx-auto">
                <div class="col-12 p-0">
                    <div class="card border-0 shadow-none">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <?php echo $this->render('backend.calendar.filter', []); ?>
                            </div>
                            <div class="row">
                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next,today',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,multiMonthYear'
            },
            initialDate: '<?php echo date('Y-m-d') ?>',
            navLinks: true,
            editable: false,
            dayMaxEvents: true,
            events: <?php echo $this->calendar;?>
        });

        calendar.render();
    });
</script>