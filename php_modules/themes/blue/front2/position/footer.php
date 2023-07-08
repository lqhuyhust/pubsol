<footer class="callout large secondary">
    <article class="grid-container">
        <div class="grid-x">
            <?php if (is_array($widget) && !empty($widget['footer'])) {
                foreach ($widget['footer'] as $wdg) {
                    echo '<div class="large-'..' cell">'
            
                    $this->_view->setVar('currentWidget', $wdg);
                    echo $this->renderWidget($wdg['layout']);
                }
            } ?>
        </div>
    </article>
            <!-- 
        
            <div class="large-4 cell">
                <h5>Vivamus Hendrerit Arcu Sed Erat Molestie</h5>
                <p>Curabitur vulputate, ligula lacinia scelerisque tempor, lacus lacus ornare ante, ac egestas est urna sit amet arcu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed molestie augue sit.</p>

            </div>
            <div class="large-3 large-offset-2 cell">
                <ul class="menu vertical">
                    <li><a href="#">One</a></li>
                    <li><a href="#">Two</a></li>
                    <li><a href="#">Three</a></li>
                    <li><a href="#">Four</a></li>
                </ul>
            </div>
            <div class="large-3 cell">
                <ul class="menu vertical">
                    <li><a href="#">One</a></li>
                    <li><a href="#">Two</a></li>
                    <li><a href="#">Three</a></li>
                    <li><a href="#">Four</a></li>
                </ul>
            </div>
        </div>
    </article> -->
</footer>