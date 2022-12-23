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
                            <div class="col-6 text-end pe-0">
                                <button type="submit" class="btn btn-outline-success">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
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
                    showMessage(result.result, result.message);
                    listRelateNote();
                }
            });
        });
    });
    function showMessage(status, message)
    {
        console.log(status);
        if (status == 'ok')
        {
            $('#message_form').addClass('alert-success');
            $('#message_form').removeClass('alert-danger');
        }else{
            $('#message_form').removeClass('alert-success');
            $('#message_form').addClass('alert-danger');
        }

        $('#message_form .toast-body').text(message);
        $("#message_ajax").toast('show');
    }
</script>