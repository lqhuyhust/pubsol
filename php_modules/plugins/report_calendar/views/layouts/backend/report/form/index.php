<?php
$this->theme->add($this->url . 'assets/calendar/css/style.css', '', 'calendar_style');
?>

<table id="calendar">
    <caption><?php echo date('F Y');?></caption>
    <tr class="weekdays">
        <th scope="col">Sunday</th>
        <th scope="col">Monday</th>
        <th scope="col">Tuesday</th>
        <th scope="col">Wednesday</th>
        <th scope="col">Thursday</th>
        <th scope="col">Friday</th>
        <th scope="col">Saturday</th>
    </tr>
    <?php $date = $this->start_date;?>
    <?php while($date <= $this->end_date) : 
        if (date('l', $date) == 'Sunday'){
            echo '<tr class="days">';
        }
        
        $class = date('m') != date('m', $date) ? 'other-month' : '';
        echo '<td class="day '. $class. '">
        <div class="date">'. date('d', $date). '</div>
        </td>';

        if (date('l', $date) == 'Saturday'){
            echo '</tr>';
        }

        $date += 86400;
    endwhile; ?>
    <!-- <tr class="days">
        <td class="day other-month">
            <div class="date">27</div>
        </td>
        <td class="day other-month">
            <div class="date">28</div>
            <div class="event">
                <div class="event-desc">
                    HTML 5 lecture with Brad Traversy from Eduonix
                </div>
                <div class="event-time">
                    1:00pm to 3:00pm
                </div>
            </div>
        </td>
        <td class="day other-month">
            <div class="date">29</div>
        </td>
        <td class="day other-month">
            <div class="date">30</div>
        </td>
        <td class="day other-month">
            <div class="date">31</div>
        </td>
        <td class="day">
            <div class="date">1</div>
        </td>
        <td class="day">
            <div class="date">2</div>
            <div class="event">
                <div class="event-desc">
                    Career development @ Community College room #402
                </div>

                <div class="event-time">
                    2:00pm to 5:00pm
                </div>
            </div>
            <div class="event">
                <div class="event-desc">
                    Test event 2
                </div>

                <div class="event-time">
                    5:00pm to 6:00pm
                </div>
            </div>
        </td>
    </tr> -->
</table>