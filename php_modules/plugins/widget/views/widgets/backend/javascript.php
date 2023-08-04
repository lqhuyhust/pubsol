<script>
    $(document).ready(function() {
        $("#selectWidgets").select2({
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
                                text: item.name
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
            dropdownParent: $("#selectWidgetModal"),
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
    })
</script>