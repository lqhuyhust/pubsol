<footer class="callout large secondary">
    <article class="grid-container">
        <div class="grid-x">
            <?php if (is_array($widget) && !empty($widget['footer'])) {
                foreach ($widget['footer'] as $index => $wdg) {
                    $this->_view->setVar('currentWidget', $wdg);
                    echo $this->renderWidget($wdg['layout']);
                }
            } ?>
        </div>
    </article>
</footer>