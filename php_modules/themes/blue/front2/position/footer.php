<?php if(is_array($widget) && !empty($widget['footer'])) : ?>
<div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
        <?php
            foreach($widget['footer'] as $wdg)
            {   
                $this->_view->setVar('currentWidget', $wdg);
                echo $this->renderWidget($wdg['layout']);
            }
         ?>
        </div>
    </div>
</div>
<?php endif; ?>