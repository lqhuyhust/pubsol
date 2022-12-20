<?php if( $this->message ){ ?>
    <div class="toast show">
  <div class="toast-header">
    Toast Header
    <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
  </div>
  <div class="toast-body">
    Some text inside the toast body
  </div>
</div>
<script>
    document.getElementById('close_message').onclick =  function() {
        document.getElementById("alert_message").style.display = "none";
    };
</script>
<?php 
}
?>