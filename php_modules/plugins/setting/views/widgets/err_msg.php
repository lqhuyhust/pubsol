
<div align="center"><p class="capt3"><font color="#cc0000"><br><?php echo $this->err_msg ?></font></p>
   <br> 
     <a href="<?php echo $this->goBack ? $this->goBack : 'javascript:history.back()'?>" onClick="MM_nbGroup('down','navbar1','facts_button_back1','<?php echo $this->url?>media/images/facts_button_back2.jpg',1);" 
    onMouseOver="MM_nbGroup('over','facts_button_back1','<?php echo $this->url?>media/images/facts_button_back2_f2.jpg','<?php echo $this->url?>media/images/facts_button_back2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
    <img name="facts_button_back1" src="<?php echo $this->url?>media/images/facts_button_back2.jpg" width="110" height="36" border="0" alt=""></a>&nbsp;&nbsp;&nbsp;&nbsp;
  <!-- start of ftr1 -->
</div>
    <?php 
    echo $this->render('widgets.footer1');
    ?>