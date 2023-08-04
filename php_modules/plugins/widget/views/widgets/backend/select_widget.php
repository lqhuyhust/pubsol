<?php 
$this->theme->add($this->url . 'assets/css/select2.min.css', '', 'select2-css');
$this->theme->add($this->url . 'assets/js/select2.full.min.js', '', 'bootstrap-select2');
?>
<div class="modal fade" id="selectWidgetModal" aria-labelledby="selectWidgetModalTitle" role="dialog">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="selectWidgetModalTypeLabel">Select Widgets</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="form_add_widget">
					<div class="d-flex">
						<select name="select_widgets" class="select-widget" multiple id="select_widgets">
						</select>
						<div class="ms-2">
							<button id="add-widget-position"class="btn btn-primary">Add</button>
						</div>
					</div>
					
					<div class="d-flex justify-content-around">
						<?php $this->ui->field('position'); ?>
					</div>
				</form>
				
			</div>
			<div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createWidget">New Widget</button>
            </div>
		</div>
	</div>
</div>
<?php echo $this->renderWidget('widget::backend.javascript')?>
