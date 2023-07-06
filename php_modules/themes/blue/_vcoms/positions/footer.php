<?php 
if ($this->modules)
{
    foreach($this->modules as $module)
    {
        $this->_view->setVar('currentModule', $module);
        echo $this->renderWidget($module['path']);
    }
}
?>