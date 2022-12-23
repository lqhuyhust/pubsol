<form class="hidden" method="POST" id="form_delete">
    <input type="hidden" value="<?php echo $this->token ?>" name="token">
    <input type="hidden" value="DELETE" name="_method">
</form>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    function listTask(data)
    {
        $.ajax({
            url: '<?php echo $this->link_list ?>',
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
                            <input class="checkbox-item" type="checkbox" name="ids[]" value="<?php echo $this->item['id']; ?>">
                        </td>
                        <td>
                            <a href="#"
                                class="show_data" 
                                data-id="<?php echo  $this->item['id'] ?>" 
                                data-title="<?php echo  $this->item['title']  ?>" 
                                data-url="<?php echo   $this->item['url'] ?>" 
                                data-bs-placement="top" 
                                data-bs-toggle="modal" 
                                data-bs-target="#Popup_form_task">
                                <?php echo  $this->item['title']  ?>
                            </a>
                        </td>
                        <td><a href="<?php echo $this->item['url']; ?>"><?php echo   $this->item['url'] ?></a></td>
                        <td><?php echo   $this->item['created_at'] ?></td>
                        <td>
                            <a href="#>" 
                                class="fs-4 me-1 show_data"
                                data-id="<?php echo  $this->item['id'] ?>" 
                                data-title="<?php echo  $this->item['title']  ?>" 
                                data-url="<?php echo   $this->item['url']?>"
                                data-bs-placement="top" 
                                data-bs-toggle="modal" 
                                data-bs-target="#Popup_form_task">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                    </tr>
                        `
                    });
                    $("#listTask").html(list);
                }
            }
        })
    }
    $(document).ready(function() {
        $("#select_all").click( function(){
            $('.checkbox-item').prop('checked', this.checked);
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
            var url = $(this).data('url');

            $('#title').val(title);
            $('#url').val(url);

            $('#form_task').attr('action', '<?php echo $this->link_form;?>/' + id);
            if(id) {
                $('#task').val('PUT');
            } else {
                $('#task').val('POST');
            }
        });
    });
</script>