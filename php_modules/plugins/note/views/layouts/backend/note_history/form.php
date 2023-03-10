<?php
$this->theme->add( $this->url .'assets/css/select2.min.css', '', 'select2-css');
$this->theme->add( $this->url .'assets/css/select2_custom.css', '', 'select2-custom-css');
$this->theme->add( $this->url. 'assets/js/select2.full.min.js', '', 'bootstrap-select2');
$this->theme->add( $this->url.'assets/tinymce/tinymce.min.js', '', 'tinymce');
?>
<?php echo $this->render('notification'); ?>
<div class="container-fluid align-items-center row justify-content-center mx-auto pt-3">
    <form enctype="multipart/form-data" action="<?php echo $this->link_form . '/' . $this->id ?>" method="post" id="form_submit">
        <div class="row g-3">
            <div class="col-lg-8 col-sm-12">
                <input id="input_title" type="hidden" class="d-none" name="title" required>
                <div class="row">
                    <div class="mb-3 col-lg-12 col-sm-12 mx-auto">
                        <div class="fw-bold d-flex  mb-2">
                            <span class="me-auto">Description:</span> 
                            <span>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" <?php echo ($this->data && $this->data['editor'] == 'sheetjs') ? 'checked' : ''; ?> name="editor" id="sheetToogle" value="sheetjs">
                                    <label class="form-check-label" for="sheetToogle">Sheet Editor</label>
                                </div>
                            </span>
                        </div>
                        <div id="html_editor">
                            <?php $this->field('description'); ?>
                        </div>
                        <?php $this->field('description_sheetjs'); ?>
                    </div>
                </div>
                
                <div class="d-flex g-3 flex-row align-items-end m-0 pb-3 justify-content-center">
                    <?php $this->field('token'); ?>
                    <input class="form-control rounded-0 border border-1" type="hidden" name="_method" value="<?php echo 'POST' ?>">
                    <div class="me-2">
                        <a href="<?php echo $this->link_list ?>">
                            <button type="button" class="btn btn-outline-secondary">Cancel</button>
                        </a>
                    </div>
                    <div class="me-2">
                        <input type="hidden" name="save_close" id="save_close">
                        <button type="submit" class="btn btn-outline-success btn_save_close">Rollback</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="row">
                    <div class="mb-3 col-lg-12 col-sm-12 mx-auto">
                        <label class="form-label fw-bold">Note:</label>
                        <?php $this->field('note'); ?>
                    </div>
                </div>
                <div class="row pt-3" style="display: none">
                    <div class="mb-3 col-lg-12 col-sm-12 mx-auto">
                        <label class="form-label fw-bold">Tags:</label>
                        <?php $this->field('tags'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-lg-12 col-sm-12 mx-auto">
                        <label class="form-label fw-bold">Tags:</label>
                        <select class="js-example-tags" multiple id="select_tags">
                            <?php foreach ($this->data_tags as $item) : ?>
                                <option selected="selected" value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

        </div>
        
    </form>
</div>
<style>
    span.select2 {
        width: 100% !important;
    }
</style>
<script>
    $(document).ready(function(e) {

        $(".btn_save_close").click(function(e) {
            e.preventDefault();
            var result = confirm("You are going to rollback. Are you sure ?");
            if (result) {
                $("#save_close").val(1);
                $('#form_submit').submit();
            }
            else
            {
                return false;
            }
            
            
        });


    });
    
</script>
<?php
$js = <<<Javascript
    var new_tags = [];
    $(".js-example-tags").select2({
        tags: true,
        createTag: newtag,
        matcher: matchCustom,
        ajax: {
            url: "{$this->link_tag}",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    search: params.term
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
        placeholder: 'Search tags',
        minimumInputLength: 2,
    });

    function newtag(params, data) {
        var term = $.trim(params.term);
        if (term === '') {
            return null;
        }

        return {
            id: term,
            text: term,
            newTag: true // add additional parameters
        }
    }

    $('.js-example-tags').on('select2:select', async function(e) {
        let tag = e.params.data;
        if (tag.newTag === true) {
            await $.post("{$this->link_tag}", {
                    name: tag.text
                })
                .done(function(data) {
                    new_tags.push({
                        id: data.data.id,
                        text: data.data.name
                    })

                    setTags();
                });
        } else {
            setTags();
        }
    });

    $('.js-example-tags').on('select2:unselect', function(e) {
        setTags();
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

    function setTags() {
        let tmp_tags = $('#select_tags').val();
        if (tmp_tags.length > 0) {
            var items = [];

            if (new_tags.length > 0) {
                tmp_tags.forEach(function(item, key) {
                    let ck = false;
                    new_tags.forEach(function(item2, key2) {

                        if (item == item2.text)
                            ck = item2
                    })

                    if (ck === false)
                        items.push(item)
                    else
                        items.push(ck.id)
                })
            } else items = tmp_tags

            $('#tags').val(items.join(','))
        } else {
            $('#tags').val('')
        }
    }

    $(document).ready(function() {
        if (!$('#sheetToogle').is(":checked"))
        {
            $('#sheet_description_sheetjs').addClass('d-none');
            $('#html_editor').removeClass('d-none');
        }
        else
        {
            $('#html_editor').addClass('d-none');
        }

        $('.clear-version').on('click', function(){
            var result = confirm("You are going to delete 1 record(s). Are you sure ?");
            if (result) {
                var version_id = $(this).data('version-id');
                $('#form_submit').attr('action', '{$this->link_form}/version/' + version_id);
                $('input[name="_method"').val('DELETE');
                $('#form_submit').submit();
            }
            else
            {
                return false;
            }
        });
        $('#sheetToogle').change(function()
        {
            if ($(this).is(":checked"))
            {
                $('#html_editor').addClass('d-none');
                $('#sheet_description_sheetjs').removeClass('d-none');
                reRender_description_sheetjs();
            }
            else
            {
                $('#html_editor').removeClass('d-none');
                $('#sheet_description_sheetjs').addClass('d-none');
            }
        });
        $("#description").attr('rows', 25);
        $(".button_delete_item").click(function() {
            var id = $(this).data('id');
            var result = confirm("You are going to delete 1 file(s) attchament. Are you sure ?");
            if (result) {
                $('#form_delete').attr('action', '{$this->link_form_attachment}' + id);
                $('#form_delete').submit();
            }
            else
            {
                return false;
            }
        });
    });
Javascript;

$this->theme->addInline('js', $js);
?>