<?php
$this->theme->add($this->url . 'assets/timeline/css/style.css', '', 'timeline_style');
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
                                <?php echo $this->render('backend.timeline.filter', []); ?>
                            </div>
                            <div class="row">
                                <div class="gantt-wrapper">
                                    <div class="gantt">
                                        <div class="gantt__row gantt__row--months">
                                            <div class="gantt__row-first m-auto">Request</div>
                                            <?php foreach($this->week as $date): ?>
                                            <span class="column-date"><?php echo date('D', strtotime($date)) ?><br><?php echo date('d-m', strtotime($date)) ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="gantt__row gantt__row--lines" data-month="5">
                                            <div class="position-absolute nav-previous-week">
                                                <a class="previous-week p-2 fs-1">
                                                    <i class="fa-solid fa-caret-left"></i>
                                                </a>
                                            </div>
                                            <span ></span>
                                            <?php foreach($this->week as $date): ?>
                                            <span class="current_date <?php echo strtotime($date) == strtotime($this->current_date) ? 'marker': ''; ?>" ></span>
                                            <?php endforeach; ?>
                                            <div class="position-absolute nav-next-week">
                                                <a class="next-week p-2 fs-1">
                                                    <i class="fa-solid fa-caret-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div>
                                            <?php foreach($this->list as $item) : ?>
                                            <div class="gantt__row">
                                                <div class="gantt__row-first px-2">
                                                    <a class="position-relative" href="<?php echo $this->link_detail . '/' . $item['id'] ?>"><?php echo $item['title'];?></a>
                                                </div>
                                                <ul class="gantt__row-bars">
                                                    <?php if (($item['start_at'] && $item['start_at'] != '0000-00-00 00:00:00') || ($item['finished_at'] && $item['finished_at'] != '0000-00-00 00:00:00') ) :?>
                                                        <li class="d-none item-timeline text-center" data-start_at='<?php echo $item['start_at']?>' data-finished_at='<?php echo $item['finished_at']?>' style="background-color: #2ecaac;"><?php echo date('d-m-Y', strtotime($item['start_at']));?> to <?php echo $item['finished_at'] != '0000-00-00 00:00:00' ? date('d-m-Y', strtotime($item['finished_at'])) : '...'; ?></li>
                                                    <?php endif; ?>

                                                </ul>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>
<script>
    let start_week = Date.parse('<?php echo $this->week[0]?>');
    let finished_week = Date.parse('<?php echo $this->week[6]?>');
    let current_date = Date.parse('<?php echo $this->current_date?>');
    function loadTimeline()
    {
        $('.item-timeline').each(function(index) {
            var start_at = $(this).data('start_at');
            var finished_at = $(this).data('finished_at');
            var first = null;
            var last = null;
            start_at = start_at && start_at != '0000-00-00 00:00:00' ? Date.parse(start_at) : 0; 
            finished_at = finished_at && finished_at != '0000-00-00 00:00:00' ? Date.parse(finished_at) : 0; 
            if (start_week >= start_at)
            {
                first = 1;
            }
            else{
                first = Math.ceil((start_at - start_week) / (1000 * 3600 * 24)) + 1;
            }

            if (finished_week <= finished_at)
            {
                last = '8';
            }
            else{
                last = 8 - Math.ceil((finished_week - finished_at) / (1000 * 3600 * 24)) + 1;
            }
            
            if (start_at == 0)
            {
                first = 0;
            }
            if (finished_at == 0)
            {
                last = first ? first : 0;
            }

            if (!(first > 8 || last <= 0))
            {
                $(this).removeClass('d-none');
                $(this).css('grid-column', first + '/' + last);
            }
            else{
                $(this).addClass('d-none');
            }
        });
    }

    function navDate()
    {
        const weekday = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
        $('.column-date').each(function(index){
            var current = new Date(start_week + index * 24 * 60 * 60 * 1000);
            var date_tmp = current.getDate().toString();
            var month_tmp = (current.getMonth() + 1).toString();
            date_tmp = date_tmp.length == 1 ? '0' + date_tmp : date_tmp;
            month_tmp = month_tmp.length == 1 ? '0' + month_tmp : month_tmp;
            $(this).html(weekday[current.getDay()] + '<br>' + date_tmp +'-'+ (month_tmp));
        });

        $('.current_date').each(function(index){
            var current = start_week + index * 24 * 60 * 60 * 1000;
            $(this).removeClass('marker');
            if (current == current_date)
            {
                $(this).addClass('marker');
            }
        });
    }

    $(document).ready(function(){
        loadTimeline();
        $('.previous-week').click(function(e){
            e.preventDefault();
            start_week = start_week - 7 * 24 * 60 * 60 * 1000;
            finished_week = finished_week - 7 * 24 * 60 * 60 * 1000;
            loadTimeline();
            navDate();
        });

        $('.next-week').click(function(e){
            e.preventDefault();
            start_week = start_week + 7 * 24 * 60 * 60 * 1000;
            finished_week = finished_week + 7 * 24 * 60 * 60 * 1000;
            loadTimeline();
            navDate();
        });
    });
</script>