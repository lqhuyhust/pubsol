<div class="sticky" data-sticky data-anchor="content">
    <?php if(is_array($widget) && !empty($widget['top_bar']))
        {
            foreach($widget['top_bar'] as $wdg)
            {   
                $this->_view->setVar('currentWidget', $wdg);
                echo $this->renderWidget($wdg['layout']);
            }
        } ?>
    <!-- <h4>Categories</h4>
    <ul>
        <li><a href="#">Skyler</a></li>
        <li><a href="#">Jesse</a></li>
        <li><a href="#">Mike</a></li>
        <li><a href="#">Holly</a></li>
    </ul>

    <h4>Authors</h4>
    <ul>
        <li><a href="#">Skyler</a></li>
        <li><a href="#">Jesse</a></li>
        <li><a href="#">Mike</a></li>
        <li><a href="#">Holly</a></li>
    </ul> -->
</div>