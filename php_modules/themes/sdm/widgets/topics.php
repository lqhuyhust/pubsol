<div class="d-flex">
        <div class="bg-green-2 px-0" style="min-width: 200px; max-width: 200px;">
            <div align="center" class="bg-white">
                <img class="img-fluid" src="<?php echo  $this->url ?>media/images/facts_corner_hdr.jpg" width="185" height="50">
            </div>
            <div class="ps-2">
                <div class="ps-3">
                    <div class="fs-3 fw-bold text-warning py-3 font">Our Topics:</div>
                </div>
                <div class="ps-3">
                    <?php
                    echo '<span class="links_topic">';
                    foreach ($this->topic as $item) {
                        if ($item['topic_active'] == 'Y') {
                            echo $item['topic_name'] . "<br>\n";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>