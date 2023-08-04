<div class="modal fade" id="selectWidgetType" tabindex="-1" aria-labelledby="selectWidgetTypeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectWidgetTypeLabel">Select Widget Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php $this->ui->field('widgets'); ?>
                <?php $this->ui->field('id'); ?>
                <?php $this->ui->field('position'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createModel">Create</button>
            </div>
        </div>
    </div>
</div>