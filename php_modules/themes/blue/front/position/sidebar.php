<div class="sticky" data-sticky data-anchor="content">
    <?php if(is_array($widget) && !empty($widget['sidebar']))
        {
            foreach($widget['sidebar'] as $wdg)
            {   
                $this->_view->setVar('currentWidget', $wdg);
                echo $this->renderWidget($wdg['layout']);
            }
        } ?>
</div>