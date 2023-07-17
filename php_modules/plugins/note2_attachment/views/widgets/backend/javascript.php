<script>
    $(document).ready(function(){
        $('.btn-upload').on('click', function(e){
            e.preventDefault();
            var check = $('#file')[0].files.length;
            if (!check)
            {
                alert('File Upload Empty');
                return false;
            }

            var form = new FormData($('#form_submit')[0]);
            $.ajax({
                url: '<?php echo $this->link_attachment ?>',
                type: 'POST',
                processData: false,
                contentType: false,
                data: form,
                success: function(result) {
                    if (result.status != 'done')
                    {
                        var message = result.message ? result.message : 'Upload Failed';
                        alert(result.message);
                    }

                    loadAttachments();
                    $('#file').val(null);
                }
            });
        });

        function loadAttachments()
        {
            var url = '<?php echo $this->url();?>';
            $.ajax({
            url: '<?php echo $this->link_attachment ?>',
            type: 'GET',
            success: function(result) {
                var list = '';
                if (Array.isArray(result.list)) {

                    result.list.forEach(function(item) {
                        list += `
                        <div class="card border shadow-none d-flex flex-column me-2 justify-content-center" style="width: auto;">
                            <a href="${url}/${item.path}" target="_blank" class="h-100 my-2 px-2 mx-auto" style="">
                                <img style="height: 120px; max-width: 100%;" src="${url}/${item.path}">
                            </a>
                            <div class="card-body d-flex">
                                <p class="card-text fw-bold m-0 me-2">${item.title}</p>
                                <a data-id="${item.id}" class="ms-auto button_delete_item fs-4"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </div>
                        `
                    });
                    $("#list-attachments").html(list);
                }
            }
        });
        }
    });
</script>