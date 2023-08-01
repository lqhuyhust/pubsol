<?php
$this->theme->add($this->url . 'assets/calendar/css/style.css', '', 'calendar_style');
?>
<div class="main min-height-auto">
    <main class="content p-0 ">
        <div class="container-fluid p-0">
            <div class="row justify-content-center mx-auto">
                <div class="col-12 p-0">
                    <div class="card border-0 shadow-none mb-0">
                        <div class="card-body pb-0">
                            <div class="row align-items-center">
                                <form id="form_submit" class="row pe-0 pb-2" action="<?php echo $this->link_form . '/' . $this->id ?>" method="POST">
                                    <div class="col-lg-11 col-sm-12">
                                        <input id="input_title" type="hidden" name="title">
                                        <input type="hidden" name="save_close" id="save_close">
                                        <div class="d-flex input-group-navbar">
                                            <div class="pe-2">
                                                <?php $this->ui->field('milestone');  ?>
                                            </div>
                                            <div class="pe-2">
                                                <select name="tags[]" id="tags" multiple>
                                                    <?php foreach ($this->filter_tag as $tag) : ?>
                                                        <option value="<?php echo $tag['id'] ?>" selected><?php echo $tag['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <button type='Submit' data-bs-toggle="tooltip" title="Filter" class="btn btn-outline-success btn_apply" type="button">
                                                Save
                                            </button>
                                            <button data-bs-toggle="tooltip" title="Clear Filter" id="clear_filter" class="btn btn-outline-secondary ms-2" type="button">
                                                Clear
                                            </button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="_method" value="<?php echo $this->id ? 'PUT' : 'POST' ?>">
                                </form>
                            </div>
                            <div class="outline">
                                <table id="calendar">
                                    <caption class="d-flex justify-content-between">
                                        <div class="actions">
                                            <button class="btn btn-secondary"><i class="fa-solid fa-chevron-left"></i></button>
                                            <button class="btn btn-secondary"><i class="fa-solid fa-chevron-right"></i></button>
                                            <button class="btn btn-secondary">Today</button>
                                        </div>
                                        <div>
                                            <?php echo date('F Y'); ?>
                                        </div>
                                        <div></div>
                                    </caption>
                                    <tr class="weekdays">
                                        <th scope="col">Sunday</th>
                                        <th scope="col">Monday</th>
                                        <th scope="col">Tuesday</th>
                                        <th scope="col">Wednesday</th>
                                        <th scope="col">Thursday</th>
                                        <th scope="col">Friday</th>
                                        <th scope="col">Saturday</th>
                                    </tr>
                                    <?php foreach($this->days as $day) :
                                        if (date('l', $day['date']) == 'Sunday') {
                                            echo '<tr class="days">';
                                        }

                                        $class = date('m') != date('m', $day['date']) ? 'other-month' : '';
                                        echo '<td class="day ' . $class . '">
                                                <div class="date">' . date('d', $day['date']) . '</div>';
                                        if ($day['event'])
                                        {
                                            foreach($day['event'] as $event)
                                            {
                                                $title = $event['status'] == 'start' || date('l', $day['date']) == 'Sunday' ? $event['title'] : "";  
                                                echo '<div class="event '. $event['status']. '">
                                                <div class="event-desc">
                                                    <a target="_blank" href="'. $this->link_request. '/'. $event['id'].'" >'. $title.' </a>
                                                    </div>
                                                </div>';
                                            }
                                        }
                                        
                                        if (date('l', $day['date']) == 'Saturday') {
                                            echo '</tr>';
                                        }

                                    endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>
<?php echo $this->render('backend.report.form.javascript') ?>