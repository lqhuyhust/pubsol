<div class="modal fade" id="formEditTag" aria-labelledby="formEditTagLabel" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered " style="max-width: 600px;">
        <div class="modal-content container px-5 pt-5">
            <form action="" method="post" id="form_tag">
                <div class="row g-3 align-items-center">
                    <div class="row px-0">
                        <div class="mb-3 col-12 mx-auto pt-3">
                            <?php $this->ui->field('name'); ?>
                        </div>
                    </div>
                    <div class="row px-0 mb-3">
                        <div class="col-12 d-flex align-items-center">
                            <label class="form-label fw-bold mb-2">Description</label>
                        </div>
                        <div class="col-12">
                            <?php $this->ui->field('description'); ?>
                        </div>
                    </div>
                    <div class="row px-0 mb-3">
                        <div class="col-12 d-flex align-items-center">
                            <label class="form-label fw-bold mb-2">Parent Tag</label>
                        </div>
                        <div class="col-12">
                            <?php $this->ui->field('parent_id'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center m-0">
                        <div class="modal-footer">
                            <?php $this->ui->field('token'); ?>
                            <input class="form-control rounded-0 border border-1" id="request" type="hidden" name="_method" value="POST">
                            <div class="row">
                                <div class="col-6 text-end pe-0">
                                    <button type="button" class="btn btn-outline-secondary fs-4" data-bs-dismiss="modal">Cancel</button>
                                </div>
                                <div class="col-6 text-end pe-0 ">
                                    <button type="submit" class="btn btn-outline-success fs-4">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.show_data').on('click', function(){
            var id = $(this).data('id') ?? 0;
            var name = $(this).data('name') ?? '';
            var description = $(this).data('description') ?? '';
            var parent_id = $(this).data('parent_id') ?? '';
            var parent_tag = $(this).data('parent_tag')?? '';

            $('#form_tag').attr('action', '<?php echo $this->link_form ?>/' + id);
            $('#form_tag #name').val(name);
            $('#form_tag #description').val(description);
            
            //clear all
            $('#parent_id').val(null).trigger('change');
            $('#parent_id').val(null).trigger('change');
        });
    })
</script>
<?php
$js = <<<Javascript
$(document).ready(function() {
    $('#parent_tag').select2();
  });
Javascript;

$this->theme->addInline('js', $js);