<?php
$this->theme->add($this->url . 'assets/css/select2.min.css', '', 'select2-css');
$this->theme->add($this->url . 'assets/css/select2_custom.css', '', 'select2-custom-css');
$this->theme->add($this->url . 'assets/js/select2.full.min.js', '', 'bootstrap-select2');
$this->theme->add($this->url . 'assets/treejs/js/jstree.min.js', '', 'treejs');
$this->theme->add($this->url . 'assets/treejs/css/style.css', '', 'treejs_style');
?>
<?php echo $this->render('notification', []); ?>
<div class="container-fluid align-items-center row justify-content-center mx-auto pt-3">
    <form enctype="multipart/form-data" action="<?php echo $this->link_form . '/' . $this->id ?>" method="post" id="form_submit">
        <div class="row">
            <div class="col-lg-4 col-sm-12">
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
                <div class="mb-3 col-lg-12 col-sm-12 mx-auto">
                    <div class="overflow-auto" id="tree_root">
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-sm-12 d-none" id="related_request">
                <div class="d-flex mb-2">
                    <h3>Related Request: </h3>
                    <h3 class="ms-1" id="name_node"><a id="link_node" target="_blank" type="button" id="close_request" class=""></a></h3>
                </div>
                <table id="request-table" class="table table-striped border-top border-1" style="width:100%">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Deadline at</th>
                            <th>Finished at</th>
                        </tr>
                    </thead>
                    <tbody id="body_related_request">
                    </tbody>
                </table>
            </div>
        </div>
        <input class="form-control rounded-0 border border-1" type="hidden" name="_method" value="<?php echo $this->id ? 'PUT' : 'POST' ?>">
        <?php $this->field('notes'); ?>
        <?php $this->field('config'); ?>
        <input type="hidden" name="save_close" id="save_close">
    </form>
</div>
<script>
    var ignore = <?php echo json_encode($this->ignore) ?>;
    $(document).ready(function(e) {
        var data = <?php echo $this->data ? $this->data['config'] : '[]'; ?>;
        $(".btn_save_close").click(function(e) {
            e.preventDefault();
            $("#save_close").val(1);
            $('input#input_title').val($('input#title').val());
            if (!$('input#title').val()) {
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
            if (!$('input#title').val()) {
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

        $("#close_request").click(function(e){
            e.preventDefault();
            $('#related_request').addClass('d-none');
        });
        $('.add-note-button').on('click', function(e) {
            e.preventDefault();
            var notes_selected = $('#notes').select2('data');
            if (notes_selected && Array.isArray(notes_selected)) {
                notes_selected.forEach(function(item, index) {
                    ignore.push(item.id);
                    createNote(item);
                });
            }

            $('#notes').val(null).trigger('change');
        })

        function createNote(item) {
            var node = $('#tree_root').jstree().get_selected();
            var index = node && node[0] ? node[0] : '-1';
            index = item.id == '-1' ? '#' : index;
            type = item.type ? item.type : 'note';
            $('#tree_root').jstree().create_node(index, {
                "id": item.id,
                "text": item.text,
                'type' : type,
            }, "last");
        }
        $('#tree_root').jstree({
            "core": {
                "animation": 0,
                "check_callback": true,
                "themes": {
                    "stripes": true
                },
                'data': data,
            },
            "types": {
                "#": {
                    "valid_children": ["root"]
                },
                "note": {
                    "valid_children": ["note"]
                },
            },
            "plugins": [
                "contextmenu", "dnd", "search",
                "state", "types", "wholerow"
            ],
            "contextmenu": {
                "trigger": 'hover',
                "items": function(node) {
                    if (node.id == '-1')
                    {
                        return {};
                    }
                    return {
                        "Remove": {
                            "separator_before": false,
                            "separator_after": false,
                            "label": "Remove",
                            "action": function(obj) {
                                $('#tree_root').jstree().delete_node(node);
                                var index = ignore.indexOf(node.id);
                                if (index !== -1) {
                                    ignore.splice(index, 1);
                                }
                            }
                        }
                    };
                }
            }
        });
        if (data.length == 0)
        {
            createNote({'id': '-1', 'text': 'ROOT', 'type' : 'root'});
        }
        $('#tree_root').on('select_node.jstree', function (even, node){
            node = node.node;
            var detail_link = '<?php echo $this->link_request .'/' ?>' + node.id;
            var node_detail = '<?php echo $this->link_note ?>/' + node.id;

            $('#link_node').text(node.text);
            $('#link_node').attr('href', node_detail);
            $('#body_related_request').html('');
            if (node.id == '-1')
            {
                $('#link_node').text('');
                return true;
            }
            $.ajax({  
                type: 'GET',  
                url: detail_link, 
                data: {},
                success: function(response) {
                    if (response.status == 'success')
                    {
                        var data = response.data;
                        $('#related_request').addClass('d-none');

                        data.forEach(function(item) {
                            var link_detail = '<?php echo $this->link_detail_request . '/'; ?>' + item.id;
                            $('#body_related_request').append(`
                                <tr>
                                    <td><a target="_blank" href="${link_detail}" >${item.title}</a></td>
                                    <td>${item.deadline_at}</td>
                                    <td>${item.finished_at}</td>
                                </tr>
                            `);
                        })
                        $('#related_request').removeClass('d-none');
                    }
                    else{
                        alert(response.message)
                    }
                }
            });
        })
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