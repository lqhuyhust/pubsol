<?php if(is_array($widget) && !empty($widget['slider'])) : ?>
<div class="container-fluid px-0 mb-5">
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <?php
            foreach($widget['slider'] as $wdg)
            {   
                $this->_view->setVar('currentWidget', $wdg);
                echo $this->renderWidget($wdg['layout']);
            }
         ?>
    </div>
</div>
<?php endif; ?> 