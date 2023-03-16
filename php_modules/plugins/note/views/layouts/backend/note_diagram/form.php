<?php
$this->theme->add($this->url . 'assets/css/select2.min.css', '', 'select2-css');
$this->theme->add($this->url . 'assets/css/select2_custom.css', '', 'select2-custom-css');
$this->theme->add($this->url . 'assets/js/select2.full.min.js', '', 'bootstrap-select2');
$this->theme->add($this->url . 'assets/treejs/js/jstree.min.js', '', 'treejs');
$this->theme->add($this->url . 'assets/treejs/css/style.min.css', '', 'treejs_style');
?>
<?php echo $this->render('notification'); ?>
<div class="container-fluid align-items-center row justify-content-center mx-auto pt-3">
    <form enctype="multipart/form-data" action="<?php echo $this->link_form . '/' . $this->id ?>" method="post" id="form_submit">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <input id="input_title" type="hidden" class="d-none" name="title">
                <div class="row">
                    <div class="mb-3 col-lg-12 col-sm-12 mx-auto d-flex">
                        <button class="btn btn-outline-success me-3 add-note-button">Add</button>
                        <div class="w-auto flex-fill">
                            <select multiple name="notes" id="notes" class="d-none">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-12 col-sm-12 mx-auto">
                        <div class="text-center">
                            <h3>Tree</h3>
                        </div>
                        <div id="tree_root">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->field('notes'); ?>
        <?php $this->field('config'); ?>
        <input type="hidden" name="save_close" id="save_close">
    </form>
</div>
<script>
    var view_mode = '<?php echo $this->view_mode ?>';
    var ignore = [];
    $(document).ready(function(e) {
        var data = '<?php echo $this->data ? $this->data['config'] : ''; ?>';
        data = data ? JSON.parse(data) : [];
        $(".btn_save_close").click(function(e) {
            e.preventDefault();
            $("#save_close").val(1);
            $('input#input_title').val($('input#title').val());
            if (!$('input#title').val())
            {
                alert("Please enter a valid Title");
                $('html, body').animate({
                    scrollTop: 0
                });
                $('input#title').focus();
                return false;
            }
            var config = $('#tree_root').jstree().get_json();
            $('#config').val(JSON.stringify(config));
            $('#notes').val(ignore.toString());
            $('#form_submit').submit();
        });

        $(".btn_apply").click(function(e) {
            e.preventDefault();
            $("#save_close").val(0);
            $('input#input_title').val($('input#title').val());
            if (!$('input#title').val())
            {
                alert("Please enter a valid Title");
                $('html, body').animate({
                    scrollTop: 0
                });
                $('input#title').focus();
                return false;
            }
            var config = $('#tree_root').jstree().get_json();
            $('#config').val(JSON.stringify(config));
            $('#notes').val(ignore.toString());
            $('#form_submit').submit();
        });

        $('.add-note-button').on('click', function(e){
            e.preventDefault();
            var notes_selected = $('#notes').select2('data');
            if (notes_selected && Array.isArray(notes_selected))
            {
                notes_selected.forEach(function(item, index) {
                    ignore.push(item.id);
                    createNote(item);
                });
            }

            $('#notes').val(null).trigger('change');
        })

        function createNote(item)
        {
            $('#tree_root').jstree().create_node('#' ,  { "id" : item.id, "text" : item.text }, "last");
        }
        $('#tree_root').jstree({
            "core" : {
                "animation" : 0,
                "check_callback" : true,
                "themes" : { "stripes" : true },
                'data' : data,
            },
            "types" : {
                "note" : {
                    "valid_children" : ["note"]
                },
            },
            "plugins" : [
                "contextmenu", "dnd", "search",
                "state", "types", "wholerow"
            ],
            "contextmenu":{         
                "items": function(node) {
                    return {
                        "Open": {
                            "separator_before": false,
                            "separator_after": false,
                            "label": "Open",
                            "action": function (obj) { 
                                var detail_link = '<?php echo $this->link_note ?>' + node.id;
                                window.open(detail_link);
                            }
                        },
                        "Remove": {
                            "separator_before": false,
                            "separator_after": false,
                            "label": "Remove",
                            "action": function (obj) { 
                                $('#tree_root').jstree().delete_node(node);
                                var index = ignore.indexOf(node.id);
                                if (index !== -1)
                                {
                                    ignore.splice(index, 1);
                                }
                            }
                        }
                    };
                }
            }
        });

        var new_tags = [];
        $("#notes").select2({
            matcher: matchCustom,
            placeholder: 'Select Notes',
            minimumInputLength: 1,
            multiple: true,
            closeOnSelect: false,
            ajax: {
                url: "<?php echo $this->link_search ?>",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        search: params.term,
                        ignore: ignore.toString(),
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
        });

        function matchCustom(params, data) {
            if ($.trim(params.term) === '') {
                return data;
            }

            if (typeof data.text === 'undefined') {
                return null;
            }

            // Return `null` if the term should not be displayed
            return null;
        }
    });
    
</script>