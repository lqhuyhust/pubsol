<div class="callout large primary">
        <div class="text-center">
        <?php if(is_array($widget) && !empty($widget['top_bar']))
            {
                foreach($widget['top_bar'] as $wdg)
                {   
                    $this->_view->setVar('currentWidget', $wdg);
                    echo $this->renderWidget($wdg['layout']);
                }
            } ?>
        </div>
    <!-- 
            <h1>Our Blog</h1>
         -->
</div>