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
                        if (item.position)
                        {
                            position = item.position;
                            if (Array.isArray(position))
                            {
                                position.forEach(function(value, i){
                                    $(`.position-item[data-position=${value}]`).each(function(index){
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
                                            <button data-position="${value}" data-id="${item.id}" data-type="${item.widget_type}" type="button" class="btn btn-primary button-widget">${item.title}</button>
                                            <button data-id="${item.id}" data-type="${item.widget_type}" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger button-remove-widget"><i class="fa-solid fa-minus"></i></button>
                                        </div>`;
                                        $(this).find(`.widgets`).append(html);
                                    })
                                })
                            }
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
            var result = confirm("You are going to delete a widget. This can't be recovered!");
            e.preventDefault(); 
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
                            alert('Widget removed successfully');
                            loadWidget();
                        }
                        else
                        {
                            alert("Widget can't removed");
                        }
                    }
                });
            }
            return true;
        });
    }

    function closeFrame(wdg)
    {
        $('#widgetForm').modal('hide');
        console.log('closeFrame', wdg);
    }

    $(document).ready(function(){
        // load image template
        function loadImage(wdg)
        {
            var template = $('#path').val();
            $('.image-template').addClass('d-none');
            $('.image-template').each(function(index){
                var data = $(this).data('template');
                if (template == data)
                {
                    $(this).removeClass('d-none');
                }
            })
        }

        loadImage();

        loadWidget();
        $('#path').on('change', function(){
            let key = $(this).val();
            $('.position-template').addClass('d-none');
            $(`.position-template[data-template-path="${key}"]`).removeClass('d-none');
            loadImage();
        })

        $('.new-position-widget').on('click', function(){
            let position = $(this).data('position');
            $('#position').val(position);
            $('#selectWidgetModal').modal('show');
            $("#selectWidgets").val(null).trigger('change');
        });

        $('#createWidget').on('click', function(){
            $('#selectWidgetModal').modal('hide');
            $('#selectWidgetType').modal('show');
        });

        $('#createModel').on('click', function(){
            let template_id = $('#id').val();
            let widget_type = $('#widgets').val();
            $('#widgetForm').modal('show');
            $('#selectWidgetType').modal('hide');
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
            $("#widget_form_load").contents().find('form#form_model #position').val(position)
            $("#widget_form_load").contents().find('form#form_model #submit_button').click()
        });

        let key = $('#path').val();
        $('.position-template').addClass('d-none');
        $(`.position-template[data-template-path="${key}"]`).removeClass('d-none');
    })
    
</script>