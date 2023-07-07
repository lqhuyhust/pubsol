<?php if(is_array($widget) && !empty($widget['copyright'])) : ?>
<div class="container-fluid copyright py-4">
    <div class="container">
        <div class="row">
        <?php
            foreach($widget['copyright'] as $wdg)
            {   
                $this->_view->setVar('currentWidget', $wdg);
                echo $this->renderWidget($wdg['layout']);
            }
         ?>
        </div>
    </div>
</div>
<?php endif; ?> 