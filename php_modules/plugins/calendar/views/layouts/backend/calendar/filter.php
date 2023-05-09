<form id="filter_form" class="row pe-0 pb-2" action="<?php echo $this->link_list ?>" method="POST">
    <div class="col-lg-11 col-sm-12">
        <div class="input-group input-group-navbar">
            <div class="pe-2">
                <?php $this->field('milestone');  ?>
            </div>
            <div class="pe-2">
                <?php $this->field('search');  ?>
            </div>
            <button type='Submit' data-bs-toggle="tooltip" title="Filter" class=" align-middle btn border border-1 ms-2" type="button">
                <i class="fa-solid fa-filter"></i>
            </button>
            <button data-bs-toggle="tooltip" title="Clear Filter" id="clear_filter" class="align-middle btn border border-1 ms-2" type="button">
                <i class="fa-solid fa-filter-circle-xmark"></i>
            </button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function(){
        document.getElementById('clear_filter').onclick = function() {
            document.getElementById("search").value = "";
            $("#milestone").val('').trigger('change');
            document.getElementById('filter_form').submit();
        };

    });
</script>