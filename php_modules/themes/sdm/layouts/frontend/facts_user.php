<?php
$this->theme->add($this->url . 'assets/css/factsstyles.css', '', 'factsstyles');
$this->theme->add($this->url . 'assets/css/styles.css', '', 'styles');
$this->theme->add($this->url . 'assets/css/bootstrap.css', '', 'bootstrap');
$this->theme->add($this->url . 'assets/js/jquery-3.6.0.min.js', '', 'jquery-3.6.0.min');
$this->theme->add($this->url . 'assets/js/bootstrap.bundle.min.js', '', 'bootstrap');
?>

<div class="">
  <div class="d-flex align-items-center p-0 m-0" >
    <div class="p-0 m-0" style="width: 274px; min-width:216px; max-width:216px;">
      <iframe class="w-100 vh-100 " src="<?php echo  $this->url ?>topic_list" name="leftFrame" frameborder="no" scrolling="yes"></iframe>
    </div>
    <div class="w-100 p-0 m-0">
    <iframe class="w-100 vh-100" src="<?php echo  $this->url ?>topics" name="mainFrame" frameborder="no"></iframe>
    </div>
  </div>
</div>