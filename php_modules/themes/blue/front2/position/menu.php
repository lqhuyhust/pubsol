<div class="container-fluid bg-white sticky-top">
        <div class="container">
        <?php if(is_array($widget) && !empty($widget['menu']))
        {
            foreach($widget['menu'] as $wdg)
            {   
                $this->_view->setVar('currentWidget', $wdg);
                echo $this->renderWidget($wdg['layout']);
            }
        } ?>
    </div>
</div>