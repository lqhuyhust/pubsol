<?php if(is_array($widget) && !empty($widget['feature'])) : ?>
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-0 feature-row">
        <?php
            foreach($widget['feature'] as $wdg)
            {   
                $this->_view->setVar('currentWidget', $wdg);
                echo $this->renderWidget($wdg['layout']);
            }
         ?>
        </div>
    </div>
</div>
<?php endif; ?> 