<form class="hidden" method="POST" id="form_delete">
    <input type="hidden" value="<?php echo $this->token ?>" name="token">
    <input type="hidden" value="DELETE" name="_method">
</form>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    document.getElementById('clear_filter').onclick = function() {
        document.getElementById("search").value = "";
        document.getElementById("sort").value = "title asc";
        document.getElementById("status").value = "";
        document.getElementById('filter_form').submit();
    };
    $(document).ready(function() {
        $("#select_all").click( function(){
            $('.checkbox-item:not(:disabled)').prop('checked', this.checked);
            
        });
        $(".button_delete_item").click(function() {
            var id = $(this).data('id');
            var result = confirm("You are going to delete 1 record(s). Are you sure ?");
            if (result) {
                $('#form_delete').attr('action', '<?php echo $this->link_form;?>/' + id);
                $('#form_delete').submit();
            }
            else
            {
                return false;
            }
        });
        $('#delete_selected').click(function(){
            var count = 0;
            $('input[name="ids[]"]:checked').each(function() {
                count++;
            });
            if (!count)
            {
                alert('Please select the record before deleting!')
                return false;
            }
            var result = confirm("You are going to delete " + count + " record(s). Are you sure ?");
            if (result) {
                $('#formList').submit();
            }
            else
            {
                return false;
            }
        });
        $('#limit').on("change", function (e) {
            $('#filter_form').submit()
        });

        $(".show_data").click(function() {
            var id = $(this).data('id');
            var title = $(this).data('title');
            var description = $(this).data('description');
            var start_at = $(this).data('start_at');
            var finished_at = $(this).data('finished_at');
            var tags = $(this).data('tags');
            $('#select_tags').val('').trigger('change');

            if (Array.isArray(tags))
            {
                tags.forEach(function(item,index){
                    var newOption = new Option(item.name, item.id, true, true);
                    $('#select_tags').append(newOption).trigger('change');
                });
            }
            setTags();

            $('#title').val(title);
            $('#description').val(description);
            $('#start_at').val(start_at);
            $('#finished_at').val(finished_at);

            $('#form_request').attr('action', '<?php echo $this->link_form;?>/' + id);
            if(id) {
                $('#request').val('PUT');
            } else {
                $('#request').val('POST');
            }
        });
    });
</script>