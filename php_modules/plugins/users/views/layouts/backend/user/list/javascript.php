<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    document.getElementById('clear_filter').onclick =  function() {
        document.getElementById("search").value = "";
        document.getElementById("filter_group").value = "";
        document.getElementById("search_status").value = "";
        document.getElementById("sort").value = "";
        document.getElementsByClassName('filterform')[0].submit();
    };
    var sort = <?php echo $this->sort ? '"'.$this->sort.'"' : 0; ?>;
    document.getElementById('sort_name').onclick =  function() {

        if(sort === "name desc")
        {
            document.getElementById('sort').value = "name asc";
        }
        else if(sort === "name asc")
        {
            document.getElementById('sort').value = "name desc";
        }
        else
        {
            document.getElementById('sort').value = "name asc";
        }

        document.getElementsByClassName('filterform')[0].submit();
    };

    document.getElementById('filter_status').onclick =  function() {

        if(sort == 'status asc') {
            document.getElementById("sort").value = "status desc";
        }
        else if (sort == "status desc") {
            document.getElementById("sort").value = "status asc";
        }else {
            document.getElementById("sort").value = "status asc";
        }
        document.getElementsByClassName('filterform')[0].submit();
    };

    $(document).ready(function() {
        $('#limit').select2({
            minimumResultsForSearch: Infinity,
        });
        $('#filter_group').select2({});

        $('#limit').on("change", function (e) {
            $('#filterform').submit()
        });
    });

    document.getElementById("btn-remove").addEventListener("click", function() {
        var result = confirm("Are you sure you want to delete this item?    ");
        if (result) {
            document.getElementById("tableList").action = '<?php echo $this->link_delete_user;?>';
            document.getElementById("method").value = "DELETE";
            document.getElementById("tableList").submit();
        }
        
    });

    $(document).ready(function(){
        $(".btn-delete-row").click(function(){
            var result = confirm("Are you sure you want to delete this item?    ");
            if (result) {
                $("#single-user").val($(this).attr('data-id'));
                $( "#single-user").prop('checked', true);
                $('#single-user').checked = true;
                document.getElementById("method").value = "DELETE";
                document.getElementById("tableList").action = '<?php echo $this->link_delete_user;?>';
                document.getElementById("tableList").submit();
            }
        });
    });
    
    document.getElementById("btn-active").addEventListener("click", function() {
        var result = confirm("Are you sure you want to active this user?    ");
        if (result) {
            document.getElementById("method").value = "PUT";
            document.getElementById("published").value = "active";
            document.getElementById("tableList").action = '<?php echo $this->link_update_user;?>';
            document.getElementById("tableList").submit();
        }
    });

    document.getElementById("btn-unactive").addEventListener("click", function() {
        var result = confirm("Are you sure you want to unactive this user?    ");
        if (result) {
            document.getElementById("method").value = "PUT";
            document.getElementById("published").value = "unactive";
            document.getElementById("tableList").action = '<?php echo $this->link_update_user;?>';
            document.getElementById("tableList").submit();
        }
    });
</script>
