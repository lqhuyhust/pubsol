<?php echo $this->render('notification'); ?>
<div class="main" id="version_link">
	<main class="content p-0 ">
		<div class="container-fluid p-0">
			<div class="row justify-content-center mx-auto">
				<div class="col-12 p-0">
					<div class="card border-0 shadow-none">
						<div class="card-body">
						<h2 class="pb-4 border-bottom"><i class="fa-solid fa-code-branch pe-2"></i><?php echo $this->title_page_version ?></h2>
							<?php if ($this->version_latest['id']) { ?>
							<div class="row align-items-center justify-content-center pt-3">
								<div class="col-lg-8 col-12" id="listChangeLog">
									<?php foreach ($this->list as $item) : ?>
										<form class="form_changelog" action="<?php echo $this->link_form . '/' . $item['id']; ?>" method="post">
											<input type="hidden" value="<?php echo $this->token ?>" name="token">
											<input type="hidden" id="method_<?php echo $item['id'] ?>" value="PUT" name="_method">
											<div class="input-group mb-3">
												<input class="form-control rounded-0 border border-1" name="log" value="<?php echo $item['log'] ?>"></input>
												<button class="btn btn-outline-secondary" type="submit">Apply</button>
												<button class="btn btn-outline-secondary button-remove" data-id-remove="<?php echo $item['id'];?>">Remove</button>
											</div>
										</form>
									<?php endforeach; ?>
									<form class="form_changelog" action="<?php echo $this->link_form . '/0' ?>" method="post">
										<input type="hidden" value="<?php echo $this->token ?>" name="token">
										<input type="hidden" value="POST" name="_method">
										<div class="input-group mb-3">
											<input class="form-control rounded-0 border border-1" name="log" ></input>
											<button class="btn btn-outline-secondary" type="submit">Add</button>
										</div>
									</form>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>

			</div>
	</main>


</div>
</div>
<script>
	function listChangeLog(data)
    {
        $.ajax({
            url: '<?php echo $this->url.'request-versions/'. $this->request_id ?>',
            type: 'POST',
            data: data,
            success: function(resultData)
            {
                var list = '';
                if (Array.isArray(resultData))
                {
                    
                    resultData.forEach(function(item)
                    {
                        list += `
						<form class="form_changelog" action="<?php echo $this->link_form . '/'?>${item['id']}" method="post">
							<input type="hidden" value="<?php echo $this->token ?>" name="token">
							<input type="hidden" id="method_${item['id']}" value="PUT" name="_method">
							<div class="input-group mb-3">
								<input class="form-control rounded-0 border border-1" name="log" value="${item['log']}"></input>
								<button class="btn btn-outline-secondary" type="submit">Apply</button>
								<button class="btn btn-outline-secondary button-remove" data-id-remove="${item['id']}">Remove</button>
							</div>
						</form>
                        `
                    });
					list += `
					<form class="form_changelog" action="<?php echo $this->link_form . '/0' ?>" method="post">
						<input type="hidden" value="<?php echo $this->token ?>" name="token">
						<input type="hidden" value="POST" name="_method">
						<div class="input-group mb-3">
							<input class="form-control rounded-0 border border-1" name="log" ></input>
							<button class="btn btn-outline-secondary" type="submit">Add</button>
						</div>
					</form>
					`;
                    $("#listChangeLog").html(list);
					$('.form_changelog').on('submit', formChangeLogSubmit);
                }
            }
        });

    }
	function formChangeLogSubmit(e)
	{
		console.log();
		if (e)
		{
			e.preventDefault();
		}
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			success: function (result) {
				showMessage(result.result, result.message);
				listChangeLog();
			}
		});
		return false;
	}
	$('.form_changelog').on('submit', formChangeLogSubmit);

    $(document).ready(function() {
        $(".button-remove").click( function(){
            var id = $(this).data('id-remove');
			$("#method_" + id).val('DELETE');
        });
    });
</script>