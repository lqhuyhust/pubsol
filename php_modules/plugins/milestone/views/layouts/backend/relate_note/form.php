<?php echo $this->render('notification'); ?>
<div class="modal fade" id="exampleModalToggle" aria-labelledby="exampleModalToggleLabel" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered " style="max-width: 600px;">
        <div class="modal-content container px-5 pt-5">
            <form method="post" id="form_relate_note">
                <div class="row px-0">
                    <div class="mb-3 col-12 mx-auto">
                        <label class="form-label fw-bold">Note:</label>
                        <?php $this->field('note_id'); ?>
                    </div>
                </div>
                <div class="row g-3 align-items-center m-0">
                    <div class="modal-footer">
                        <?php $this->field('token'); ?>
                        <div class="row">
                            <div class="col-6 text-end pe-0">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            <?php if(!$this->status) {?>
                            <div class="col-6 text-end pe-0">
                                <button type="submit" class="btn btn-outline-success">Save</button>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function listNote(data)
    {
        $.ajax({
            url: '<?php echo $this->url. 'get-notes/'. $this->request_id ?>',
            type: 'POST',
            data: data,
            success: function(resultData)
            {
                var list = '<option value="" selected="selected">Select Note</option>';
                if (Array.isArray(resultData))
                {
                    resultData.forEach(function(item)
                    {
                        list += `<option value="${item['id']}">${item['title']}</option>`;
                    });
                    $("#note_id").html(list);
                }
            }
        })
    }
    listNote();
    $(document).ready(function() {
        $("#form_relate_note").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->link_form .'/0' ?>',
                data: $('#form_relate_note').serialize(),
                success: function (result) {
                    modal = bootstrap.Modal.getInstance($('#exampleModalToggle'))
                    modal.hide();
                    $('#note_id').val('');
                    showMessage(result.result, result.message);
                    listRelateNote($('#filter_form').serialize());
                    listNote();
                }
            });
        });
    });
</script>
<?php
$js = <<<Javascript
$(document).ready(function() {
    $('#note_id').select2({dropdownParent:  "#exampleModalToggle"});
  });
Javascript;

$this->theme->addInline('js', $js);