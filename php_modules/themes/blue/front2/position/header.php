<div class="container-fluid bg-primary text-white d-lg-flex">
    <div class="container py-3"> 
        <?php if(is_array($widget) && !empty($widget['header']))
        {
            foreach($widget['header'] as $wdg)
            {   
                $this->_view->setVar('currentWidget', $wdg);
                echo $this->renderWidget($wdg['layout']);
            }
        } ?>
    </div>
</div>