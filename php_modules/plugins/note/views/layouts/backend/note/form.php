<?php
$this->theme->add($this->url . 'assets/css/select2.min.css', '', 'select2-css');
$this->theme->add($this->url . 'assets/css/select2_custom.css', '', 'select2-custom-css');
$this->theme->add($this->url . 'assets/js/select2.full.min.js', '', 'bootstrap-select2');
$this->theme->add($this->url . 'assets/tinymce/tinymce.min.js', '', 'tinymce');
?>
<?php echo $this->render('notification'); ?>
<div class="container-fluid align-items-center row justify-content-center mx-auto pt-3">
    <form enctype="multipart/form-data" action="<?php echo $this->link_form . '/' . $this->id ?>" method="post" id="form_submit">
        <div class="row">
            <div id="col-8" class="col-lg-8 col-sm-12">
                <input id="input_title" type="hidden" class="d-none" name="title" required>
                <div class="row">
                    <div class="mb-3 col-lg-12 col-sm-12 mx-auto">
                        <div class="fw-bold d-flex  mb-2">
                            <span class="me-auto">Description:</span> 
                            <span>
                                <div class="button-editor-mode form-check form-switch me-2 mb-0">
                                    <input class="form-check-input" type="radio" <?php echo ( !$this->data || $this->data && $this->data['editor'] == 'tynimce') ? 'checked' : ''; ?> name="editor" id="tynimceToogle" value="tynimce">
                                    <label class="form-check-label" for="tynimceToogle">Tynimce Mode</label>
                                </div>
                            </span>
                            <span>
                                <div class=" button-editor-mode form-check me-2 form-switch mb-0">
                                    <input class="form-check-input" type="radio" <?php echo ($this->data && $this->data['editor'] == 'sheetjs') ? 'checked' : ''; ?> name="editor" id="sheetToogle" value="sheetjs">
                                    <label class="form-check-label" for="sheetToogle">Sheet Mode</label>
                                </div>
                            </span>
                            <span>
                                <div class="button-editor-mode form-check form-switch mb-0">
                                    <input class="form-check-input" type="radio" <?php echo ($this->data && $this->data['editor'] == 'presenter') ? 'checked' : ''; ?> name="editor" id="PresenterToogle" value="presenter">
                                    <label class="form-check-label" for="PresenterToogle">Presenter Mode</label>
                                </div>
                            </span>
                            <nav class="navbar navbar-expand navbar-light navbar-bg d-flex justify-content-end py-0" style="box-shadow: inherit;">
                                <a class="sidebar-toggle1 js-sidebar-toggle" id="sidebarToggle" style="color: black !important;">
                                    <i class="fa-solid fa-bars fs-2 "></i>
                                </a>
                            </nav>
                        </div>
                        <div id="html_editor" class="d-none">
                            <?php $this->field('description'); ?>
                        </div>
                        <?php $this->field('description_sheetjs'); ?>
                        <div id="presenter_editor" class="d-none">
                            <?php $this->field('description_presenter'); ?>
                        </div>
                        <div id="content" class="p-3 d-none text-break">
                            <?php if (isset($this->data['description'])) {
                                echo $this->data['description'];
                            } ?>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex g-3 flex-row align-items-end m-0 pb-3 justify-content-center">
                    <?php $this->field('token'); ?>
                    <input class="form-control rounded-0 border border-1" type="hidden" name="_method" value="<?php echo $this->id ? 'PUT' : 'POST' ?>">
                    <div class="me-2">
                        <a href="<?php echo $this->link_list ?>">
                            <button type="button" class="btn btn-outline-secondary">Cancel</button>
                        </a>
                    </div>
                    <div class="me-2">
                        <input type="hidden" name="save_close" id="save_close">
                        <button id="save_and_close" type="submit" class="btn btn-outline-success btn_save_close">Save & Close</button>
                    </div>
                    <div class="me-2">
                        <button id="apply" type="submit" class="btn btn-outline-success btn_apply">Apply</button>
                    </div>
                </div>
            </div>
            <div id="col-4" class="col-lg-4 col-sm-12">
                <div class="row">
                    <div class="mb-3 col-lg-12 col-sm-12 mx-auto">
                        <label class="form-label fw-bold">Note:</label>
                        <?php $this->field('note'); ?>
                    </div>
                </div>
                <?php if ($this->data && !$this->data_version) : ?>
                <div class="row">
                    <div class="mb-1 col-lg-12 col-sm-12 mx-auto">
                        <label data-bs-target="#listRevision" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="listRevision" class="form-label fw-bold"><i class="fa-solid fa-clock-rotate-left"></i> Revision: <?php echo count($this->data['versions']);?></label>
                    </div>
                    <div class="collapse mb-2" id="listRevision">
                        <ul class="list-group list-group-flush">
                            <?php foreach($this->data['versions'] as $item) : ?>
                            <li class="list-group-item d-flex">
                                <a href="<?php echo $this->link_form. '/version/'.$item['id']?>">Modified At: <?php echo $item['created_at'] ?> by <?php echo $item['created_by'] ?></a>
                                <a href="#" class="clear-version ms-auto" data-version-id="<?php echo $item['id']?>"><i class="fa-solid fa-trash"></i></a>
                            </li>
                            <?php endforeach;?>
                        </ul>
                        
                    </div>
                </div>
                <?php endif; ?>
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
                <label class="form-label fw-bold pt-2">Attachments:</label>
                <input name="files[]" type="file" multiple id="file" class="form-control">
                <div class="d-flex flex-wrap pt-4">
                    <?php foreach ($this->attachments as $item) :
                        $extension = @end(explode('.', $item['path']));
                        if (in_array($extension, ['png', 'jpg', 'jpeg'])) {
                            $path = file_exists(PUBLIC_PATH . $item['path']) ? $this->url . $item['path'] : $this->url . 'media/default/default_image.png';
                        }
                        elseif($extension == 'pdf')
                        {
                            $path = $this->url . 'media/default/default_pdf.png';
                        }
                        elseif(in_array($extension, ['doc', 'docx']))
                        {
                            $path = $this->url . 'media/default/default_doc.png';
                        } 
                        elseif(in_array($extension, ['xlsx', 'csv']))
                        {
                            $path = $this->url . 'media/default/default_excel.png';
                        }
                        else
                        {
                            $path = $this->url . 'media/default/default_file.png';
                        }
                        ?>
                        <div class="card border shadow-none d-flex flex-column me-2 justify-content-center" style="width: auto;">
                            <a href="<?php echo file_exists(PUBLIC_PATH. $item['path'] ) ? $this->url . $item['path'] : '' ?>" target="_blank" class="h-100 my-2 px-2 mx-auto" title="<?php echo $item['name']; ?>" style="">
                                <img style="height: 120px; max-width: 100%;" src="<?php echo $path ?>" alt="<?php echo $item['name']; ?>">
                            </a>
                            <div class="card-body d-flex">
                                <p class="card-text fw-bold m-0 me-2"><?php echo $item['name']; ?> </p>
                                <a data-id="<?php echo $item['id']?>" class="ms-auto me-2 button_download_item fs-4"><i class="fa-solid fa-download"></i></a>
                                <a data-id="<?php echo $item['id']?>" class="ms-auto button_delete_item fs-4"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </div>
                        <div class="d-block">
                            
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
        
    </form>
</div>
<form class="hidden" method="POST" id="form_delete">
    <input type="hidden" value="<?php echo $this->token ?>" name="token">
    <input type="hidden" value="DELETE" name="_method">
</form>
<form class="hidden" method="POST" id="form_download">
    <input type="hidden" value="<?php echo $this->token ?>" name="token">
    <input type="hidden" value="POST" name="_method">
</form>
<style>
    span.select2 {
        width: 100% !important;
    }
</style>
<script>
    var view_mode = '<?php echo $this->view_mode ?>';
    $(document).ready(function(e) {
        var editor = '<?php echo $this->data ? $this->data['editor'] : '' ?>';
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
            var json_data = canvas.toJSON();
            $('#description').val(JSON.stringify(json_data));
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
            var json_data = canvas.toJSON();
            $('#description_presenter').val(JSON.stringify(json_data));
            $('#form_submit').submit();
        });

        if(view_mode) {
            $("#save_and_close").addClass("d-none");
            $("#apply").addClass("d-none");
            $("#save_and_close_header").addClass("d-none");
            $("#apply_header").addClass("d-none");
            $("#col-8").addClass("col-lg-12");
            $("#col-4").addClass("col-lg-0 d-none");
            $(".button-editor-mode").addClass('d-none');
            openModeEditor();
        } else {
            $("#html_editor").removeClass("d-none");
            $("#check_mode").removeClass("d-none");
            $("#content").removeClass("border");
            $("#save_and_close").removeClass("d-none");
            $("#apply").removeClass("d-none");
            $("#save_and_close_header").removeClass("d-none");
            $("#apply_header").removeClass("d-none");
            openModeEditor();
        }

        $("#mode").click(function () {
            if(view_mode)
            {
                view_mode = '';
                $("#open").text('View Mode');
                $("#content").addClass("d-none");
                $("#col-8").removeClass("col-lg-12");
                $("#col-4").removeClass("col-lg-0 d-none");
                $(".button-editor-mode").removeClass("d-none");
                $("#save_and_close").removeClass("d-none");
                $("#apply").removeClass("d-none");
                $("#save_and_close_header").removeClass("d-none");
                $("#apply_header").removeClass("d-none");
                window.dispatchEvent(new Event('resize'));
                openModeEditor();
            }
            else
            {
                view_mode = 'true';
                $(".button-editor-mode").addClass("d-none");
                $("#open").text('Edit Mode');
                $("#col-8").addClass("col-lg-12");
                $("#col-4").addClass("col-lg-0 d-none");
                window.dispatchEvent(new Event('resize'));
                $("#save_and_close").addClass("d-none");
                $("#apply").addClass("d-none");
                $("#save_and_close_header").addClass("d-none");
                $("#apply_header").addClass("d-none");
            }
        });
        
        $("#sidebarToggle").click(function() {
            $("#col-8").toggleClass("col-lg-12");
            $("#col-4").toggleClass("col-lg-0 d-none");
            reRender();
            window.dispatchEvent(new Event('resize'));
        });
    });

    function openModeEditor() {
        var value = $('input[name="editor"]:checked').val();
        if (value=='tynimce')
        {
            if (view_mode)
            {
                $("#content").removeClass("d-none");
                $("#content").addClass("border");
            }
            else
            {
                $('#html_editor').removeClass('d-none');
                $('#sheet_description_sheetjs').addClass('d-none');
                $('#presenter_editor').addClass('d-none');
            }
        }

        if (value=='sheetjs')
        {
            $('#html_editor').addClass('d-none');
            $('#sheet_description_sheetjs').removeClass('d-none');
            $('#presenter_editor').addClass('d-none');
        }

        if (value=='presenter')
        {
            $('#html_editor').addClass('d-none');
            $('#sheet_description_sheetjs').addClass('d-none');
            $('#presenter_editor').removeClass('d-none');
            reRender();
        }
    }
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
        }
        else
        {
            $('#html_editor').addClass('d-none');
            $('#content').addClass('d-none');
            window.dispatchEvent(new Event('resize'));
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
        $('input[name="editor"]').change(function()
        {
            openModeEditor();
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
        $(".button_download_item").click(function() {
            var id = $(this).data('id');
            if (id) {
                $('#form_delete').attr('action', '{$this->link_form_download_attachment}' + id);
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