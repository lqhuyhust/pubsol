<div class="top-bar">
    <?php if(is_array($widget) && !empty($widget['top_bar']))
        {
            foreach($widget['top_bar'] as $wdg)
            {   
                $this->_view->setVar('currentWidget', $wdg);
                echo $this->renderWidget($wdg['layout']);
            }
        } ?>
</div>