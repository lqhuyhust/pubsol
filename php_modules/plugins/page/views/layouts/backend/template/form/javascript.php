<script>
    var modules = <?php echo json_encode($this->modules)?>;
    
    function loadModule()
    {
        $.ajax({
            url: '<?php echo $this->link_load_module.'/'. $this->id ?>',
            type: 'GET',
            success: function(resultData) {
                var list = '';
                if (resultData.status == 'success')
                {
                    $('.position-template .modules').html('');
                    resultData.list.forEach(function(item) {
                        if (item.position_name)
                        {
                            $(`.position-item[data-position_name=${item.position_name}]`).each(function(index){
                                var count = $(this).find(`.button-module`).length;
                                var limit = $(this).data('limit');
                                count++;
                                if (count >= limit)
                                {
                                    $(this).find(`.new-position-module`).addClass('d-none');
                                    if (count > limit)
                                    {
                                        return true;
                                    }
                                }
                                else
                                {
                                    $(this).find(`.new-position-module`).removeClass('d-none');
                                }
                                
                                var html = `<div class="mx-3 mb-1 position-relative">
                                    <button data-position="${item.position_name}" data-id="${item.id}" data-type="${item.module_type}" type="button" class="btn btn-primary button-module">${item.title}</button>
                                    <button data-id="${item.id}" data-type="${item.module_type}" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger button-remove-module"><i class="fa-solid fa-minus"></i></button>
                                </div>`;
                                $(this).find(`.modules`).append(html);
                            })
                        }
                    })

                    eventButton();
                }
            }
        });
    }

    function eventButton()
    {
        $('.modules .button-module').on('click', function(){
            let id = $(this).data('id');
            let module_type = $(this).data('type');
            $('#moduleForm').modal('show');
            var link = modules[module_type] ? modules[module_type].link: ''; 
            $('#module_form_load').attr('src', '<?php echo $this->url;?>' + link + '/' + id);
        });

        $('.modules .button-remove-module').on('click', function(e){
            var result = confirm("You are going to delete 1 module. Are you sure ?");
            e.preventDefault();
            console.log('true');
            if (result) {
                let id = $(this).data('id');
                let module_type = $(this).data('type');
                var link = modules[module_type] ? '<?php echo $this->url;?>' + modules[module_type].link + '/' + id: ''; 
                var form = new FormData();
                form.append("_method", 'DELETE');
                console.log(link);
                $.ajax({
                    url: link,
                    type: 'POST',
                    data: form,
                    processData: false,
                    contentType: false,
                    success: function(resultData) {
                        var list = '';
                        if (resultData.status == 'success')
                        {
                            alert('Delete successfully');
                            loadModule();
                        }
                        else
                        {
                            alert('Delete Failed');
                        }
                    }
                });
            }
            return true;
        });
    }
    $(document).ready(function(){
        loadModule();
        $('#path').on('change', function(){
            let key = $(this).val();
            $('.position-template').addClass('d-none');
            $(`.position-template[data-template-path="${key}"]`).removeClass('d-none');
        })

        $('.new-position-module').on('click', function(){
            let position = $(this).data('position_name');
            $('#position').val(position);
            $('#selectModuleType').modal('show');
        });

        $('#createModel').on('click', function(){
            let template_id = $('#id').val();
            let module_type = $('#modules').val();
            $('#moduleForm').modal('show');
            var link = modules[module_type] ? modules[module_type].link: ''; 
            $('#module_form_load').attr('src', '<?php echo $this->url;?>' + link);
        })

        $('#moduleForm').on('hide.bs.modal', function () {
            loadModule();
        });
        $('#saveModule').on('click', function(){
            let template_id = $('#id').val();
            let position = $('#position').val();

            $("#module_form_load").contents().find('form#form_model #template_id').val(template_id)
            $("#module_form_load").contents().find('form#form_model #position_name').val(position)
            $("#module_form_load").contents().find('form#form_model #submit_button').click()
        });
    })
    
</script>