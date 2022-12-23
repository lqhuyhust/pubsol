<?php echo $this->render('notification');?>
<div class="pt-2" id="task_link">
	<div class="container-fluid">
		<div class="row justify-content-center mx-auto">
			<div class="col-12">
				<a class="w-100 text-decoration-none d-flex border-bottom" data-bs-toggle="collapse" type="button" data-bs-target="#listTask" aria-expanded="true" aria-controls="listTask">
					<h2 class="pb-2"><i class="fa-solid fa-list-check pe-2"></i><?php echo $this->title_page_task ?></h2>
                    <h2 class="ms-auto">
                        <i class="fa-solid fa-caret-down"></i>
                    </h2>
                </a>
				<div class="collapse" id="listTask">
					<div class="row align-items-center pt-3">
						<?php echo $this->render('backend.task.list.filter');?>
					</div>
					<div class="row align-items-center">
						<?php echo $this->render('backend.task.form');?>
					</div>
					<form action="<?php echo $this->link_list ?>" method="POST" id="formListTask">
						<input type="hidden" value="<?php echo $this->token ?>" name="token">
						<input type="hidden" value="DELETE" name="_method">
						<table id="datatables-buttons" class="table table-striped border-top border-1" style="width:100%">
							<thead>
								<tr>
									<th width="10px">
										<input type="checkbox" id="select_all">
									</th>
									<th>Title</th>
									<th>Url</th>
									<th>Created At</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="listTask">
								<?php while($this->list->hasRow()) $this->render('backend.task.list.row'); ?> 
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