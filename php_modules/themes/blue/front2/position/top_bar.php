<div class="top-bar">
    <?php if(is_array($widget) && !empty($widget['top_bar']))
        {
            foreach($widget['top_bar'] as $wdg)
            {   
                $this->_view->setVar('currentWidget', $wdg);
                echo $this->renderWidget($wdg['layout']);
            }
        } ?>
    <!-- <div class="top-bar-left">
        <ul class="menu">
            <li class="menu-text">Yeti Agency</li>
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="menu">
            <li><a href="#">One</a></li>
            <li><a href="#">Two</a></li>
            <li><a href="#">Three</a></li>
            <li><a href="#">Four</a></li>
        </ul>
    </div> -->
</div>