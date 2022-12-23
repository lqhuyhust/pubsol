<form class="hidden" method="POST" id="form_delete_relate_note">
    <input type="hidden" value="<?php echo $this->token ?>" name="token">
    <input type="hidden" value="DELETE" name="_method">
</form>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    function listRelateNote(data)
    {
        $.ajax({
            url: '<?php echo $this->link_list_relate_note ?>',
            type: 'POST',
            data: data,
            success: function(resultData)
            {
                var list = '';
                if (Array.isArray(resultData))
                {
                    
                    resultData.forEach(function(item)
                    {
                        list += `
                        <tr>
                            <td>
                                <input class="checkbox-item-relate-note" type="checkbox" name="ids[]" value="${item['id']}">
                            </td>
                            <td>
                                <a href="<?php echo $this->url ?>${item['note_id']}">${item['title']}</a>
                            </td>
                            <td>${item['description']}</td>
                        </tr>
                        `
                    });
                    $("#listRelateNote").html(list);
                }
            }
        })
    }
    listRelateNote();
    $(document).ready(function() {
        $("#select_all_relate_note").click( function(){
            $('.checkbox-item-relate-note').prop('checked', this.checked);
        });
        $(".button_delete_item_relate_note").click(function() {
            var id = $(this).data('id');
            var result = confirm("You are going to delete 1 record(s). Are you sure ?");
            if (result) {
                $('#form_delete_relate_note').attr('action', '<?php echo $this->link_form;?>/' + id);
                $('#form_delete_relate_note').submit();
            }
            else
            {
                return false;
            }
        });
        $('#delete_relate_note_selected').click(function(){
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
                $('#formListRelateNote').submit();
            }
            else
            {
                return false;
            }
        });
        $('#limit').on("change", function (e) {
            $('#filter_form').submit()
        });
        $(".show_data_relate_note").click(function() {
            var id = $(this).data('id');
            var title = $(this).data('title');
            var description = $(this).data('description');

            $('#title').val(title);
            $('#description').val(description);
            
        });
    });
</script>