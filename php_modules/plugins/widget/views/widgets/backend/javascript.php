<script>
    $(document).ready(function() {
        $("#select_widgets").select2({
            matcher: matchCustom,
            ajax: {
                url: "<?php echo $this->link_widgets ?>",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    position = $('#position').val();;
                    return {
                        search: params.term,
                        position: position
                    };
                },
                processResults: function(data, params) {
                    let items = [];
                    if (data.data.length > 0) {
                        data.data.forEach(function(item) {
                            items.push({
                                id: item.id,
                                text: item.title
                            })
                        })
                    }

                    return {
                        results: items,
                        pagination: {
                            more: false
                        }
                    };
                },
                cache: true
            },
            placeholder: 'Widgets',
            minimumInputLength: 1,
        });

        function matchCustom(params, data) {
            // If there are no search terms, return all of the data
            if ($.trim(params.term) === '') {
                return data;
            }

            // Do not display the item if there is no 'text' property
            if (typeof data.text === 'undefined') {
                return null;
            }

            // Return `null` if the term should not be displayed
            return null;
        }

        $('#add-widget-position').on('click', function(e){
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '<?php echo $this->form_add_widget; ?>',
                data: $('#form_add_widget').serialize(),
                success: function (result) {
                    if (result.status == 'success')
                    {
                        alert('Update widget successfull')
                    }
                    else
                    {
                        alert(message);
                    }

                    $('#select_widgets').val(null).trigger('change');
                    $('#selectWidgetModal').modal('hide');
                    loadWidget();
                }
            });
        })
    })
</script>