<div class="main">
	<main class="content p-0 ">
		<div class="container-fluid p-0">
			<div class="row justify-content-center mx-auto">
				<div class="col-12 p-0">
					<div class="card border-0 shadow-none">
						<div class="card-body">
						<?php echo $this->render('message');?>
                        <div class="row align-items-center">
								<?php echo $this->render('backend.user.list.filter');?>
							</div>
							<form action="<?php echo $this->link_list ?>" method="POST" id="formList">
								<input type="hidden" value="<?php echo $this->token ?>" name="token">
            					<input type="hidden" value="DELETE" name="_method">
								<table id="datatables-buttons" class="table table-striped border-top border-1" style="width:100%">
									<thead>
										<tr>
											<th width="10px">
												<input type="checkbox" id="select_all">
											</th>
											<th>User Name</th>
											<th>Name</th>
											<th>Email</th>
											<th>Status</th>
											<th>Created At</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php while($this->list->hasRow()) $this->render('backend.user.list.row'); ?> 
									</tbody>
								<?php
								?>
								</table>
							</form>
							<div class="row g-3 align-items-center">
								<?php echo $this->render('pagination'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</main>


</div>
</div>