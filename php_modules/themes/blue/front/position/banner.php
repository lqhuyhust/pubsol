<div class="callout large primary">
    <div class="text-center">
    <?php if(is_array($widget) && !empty($widget['banner']))
        {
            foreach($widget['banner'] as $wdg)
            {   
                $this->_view->setVar('currentWidget', $wdg);
                echo $this->renderWidget($wdg['layout']);
            }
        } ?>
    </div>
</div>