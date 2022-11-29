<div>
    <div class="bg-green-2 px-0" style="min-width: 216px; max-width: 216px;">
        <div align="center" class="bg-white">
            <img class="img-fluid my-3" src="<?php echo  $this->url ?>media/images/facts_corner_hdr.jpg" width="185" height="50">
        </div>
        <div>
            <div class="ps-4">
                <div class="fs-1 fw-bold text-warning py-3 font">Our Topics:</div>
            </div>
            <div class="ps-4 pb-5">
                <span class="links_topic">
                    <?php
                    foreach ($this->topic as $item) {
                        if ($item['topic_active'] == 'Y') {
                            if ($this->user_type == 'admin') {
                                echo '<a href="' . $this->url . 'topics?t=' . $item['topic_id'] . '" target="mainFrame">' . $item['topic_name'] . "</a> <font size='+1' color='red'><b>*</b></font><br>\n";
                            } else {
                                echo '<a style="color: white;" href="' . $this->url . 'topics?t=' . $item['topic_id'] . '" target="mainFrame">' . $item['topic_name'] . "</a><br>\n";
                            }
                        }
                    }
                    ?>
            </div>
        </div>
    </div>
</div>