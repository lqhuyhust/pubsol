<?php echo $this->render('notification');?>
<div class="pt-2" id="relate_note_link">
	<div class="container-fluid">
		<div class="row justify-content-center mx-auto">
			<div class="col-12">
				<a class="w-100 request-collapse text-decoration-none d-flex border-bottom" data-bs-toggle="collapse" type="button" data-bs-target="#collapseRelateNote" aria-expanded="true" aria-controls="collapseRelateNote">
					<h2 class="pb-1" >
						<i class="fa-solid fa-link pe-2 "></i>
						<?php echo $this->title_page_relate_note ?>
					</h2>
					<h2 class="ms-auto">
						<i class=" icon-collapse fa-solid fa-caret-down"></i>
					</h2>
				</a>
				<div class="collapse" id="collapseRelateNote">
					<div class=" row align-items-center pt-3">
						<?php echo $this->render('backend.relate_note.list.filter');?>
					</div>
					<div class="row align-items-center">
						<?php echo $this->render('backend.relate_note.form');?>
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
								</tr>
							</thead>
							<tbody id="listRelateNote">
								<?php while($this->list->hasRow()) $this->render('backend.relate_note.list.row'); ?> 
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
