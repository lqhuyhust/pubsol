<script>
    var widgets = <?php echo json_encode($this->widgets)?>;
    
    function loadWidget()
    {
        $.ajax({
            url: '<?php echo $this->link_load_widget.'/'. $this->id ?>',
            type: 'GET',
            success: function(resultData) {
                var list = '';
                if (resultData.status == 'success')
                {
                    $('.position-template .widgets').html('');
                    resultData.list.forEach(function(item) {
                        if (item.position_name)
                        {
                            $(`.position-item[data-position_name=${item.position_name}]`).each(function(index){
                                var count = $(this).find(`.button-widget`).length;
                                var limit = $(this).data('limit');
                                count++;
                                if (count >= limit)
                                {
                                    $(this).find(`.new-position-widget`).addClass('d-none');
                                    if (count > limit)
                                    {
                                        return true;
                                    }
                                }
                                else
                                {
                                    $(this).find(`.new-position-widget`).removeClass('d-none');
                                }
                                
                                var html = `<div class="mx-3 mb-1 position-relative">
                                    <button data-position="${item.position_name}" data-id="${item.id}" data-type="${item.widget_type}" type="button" class="btn btn-primary button-widget">${item.title}</button>
                                    <button data-id="${item.id}" data-type="${item.widget_type}" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger button-remove-widget"><i class="fa-solid fa-minus"></i></button>
                                </div>`;
                                $(this).find(`.widgets`).append(html);
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
        $('.widgets .button-widget').on('click', function(){
            let id = $(this).data('id');
            let widget_type = $(this).data('type');
            $('#widgetForm').modal('show');
            var link = widgets[widget_type] ? widgets[widget_type].link: ''; 
            $('#widget_form_load').attr('src', '<?php echo $this->url;?>' + link + '/' + id);
        });

        $('.widgets .button-remove-widget').on('click', function(e){
            var result = confirm("You are going to delete 1 widget. Are you sure ?");
            e.preventDefault();
            console.log('true');
            if (result) {
                let id = $(this).data('id');
                let widget_type = $(this).data('type');
                var link = widgets[widget_type] ? '<?php echo $this->url;?>' + widgets[widget_type].link + '/' + id: ''; 
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
                            loadWidget();
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
        loadWidget();
        $('#path').on('change', function(){
            let key = $(this).val();
            $('.position-template').addClass('d-none');
            $(`.position-template[data-template-path="${key}"]`).removeClass('d-none');
        })

        $('.new-position-widget').on('click', function(){
            let position = $(this).data('position_name');
            $('#position').val(position);
            $('#selectWidgetType').modal('show');
        });

        $('#createModel').on('click', function(){
            let template_id = $('#id').val();
            let widget_type = $('#widgets').val();
            $('#widgetForm').modal('show');
            var link = widgets[widget_type] ? widgets[widget_type].link: ''; 
            $('#widget_form_load').attr('src', '<?php echo $this->url;?>' + link);
        })

        $('#widgetForm').on('hide.bs.modal', function () {
            loadWidget();
        });
        $('#saveWidget').on('click', function(){
            let template_id = $('#id').val();
            let position = $('#position').val();
            console.log(template_id, position);
            $("#widget_form_load").contents().find('form#form_model #template_id').val(template_id)
            $("#widget_form_load").contents().find('form#form_model #position_name').val(position)
            $("#widget_form_load").contents().find('form#form_model #submit_button').click()
        });
    })
    
</script>