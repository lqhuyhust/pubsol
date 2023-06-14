<?php echo $this->render('notification', []); ?>
<div class="modal fade" id="relateNoteList" aria-labelledby="relateNoteListTitle" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="relateNoteListTitle">Relate Notes</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div>
					<div class=" row align-items-center pt-3">
						<?php echo $this->render('backend.relate_note.list.filter', []); ?>
					</div>
					<div class="row align-items-center">
						<?php echo $this->render('backend.relate_note.form', []); ?>
					</div>
					<form action="<?php echo $this->link_list ?>" method="POST" id="formListRelateNote">
						<input type="hidden" value="<?php echo $this->token ?>" name="token">
						<input type="hidden" value="DELETE" name="_method">
						<table id="datatables-buttons" class="table table-striped border-top border-1" style="width:100%">
							<thead>
								<tr>
									<th width="10px">
										<input type="checkbox" id="select_all_relate_note">
									</th>
									<th>Title</th>
									<th>Description</th>
									<th>Tags</th>
								</tr>
							</thead>
							<tbody id="listRelateNote">
								<?php while ($this->list->hasRow()) echo $this->render('backend.relate_note.list.row', ['item' => $this->list->getRow(), 'index' => $this->list->getIndex(), 'link_note' => $this->link_note]); ?>
							</tbody>
							<?php
							?>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	 $(document).ready(function(){
        $('.relate-note-popup').on('click', function(e){
            e.preventDefault();
            $('#relateNoteList').modal('show');
        })
	});
</script>