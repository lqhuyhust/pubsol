
<?php echo $this->render('layouts.backend.relate_note.list'); ?>
<?php echo $this->render('layouts.backend.document.form'); ?>
<?php echo $this->render('layouts.backend.task.list'); ?>
<?php echo $this->render('layouts.backend.version_latest.list'); ?>
<div class="toast message-toast" id="message_ajax">
    <div id="message_form" class="d-flex message-body ">
        <div class="toast-body">
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
<script>
	
	$(document).on("scroll", onScroll);
	$("#sidebar .sidebar-content").addClass('position-fixed');
	function showMessage(status, message)
    {
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
	function onScroll(event){
		var scrollPos = $(document).scrollTop() +1;
		$('a.sidebar-link').each(function () {
			var currLink = $(this);
			var href = currLink.attr("href");
			var refElement = $('#' + href.split('#')[1]);
			if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() >= scrollPos) {
				$('li.sidebar-item  a.sidebar-link').removeClass("active");
				currLink.parent('li.sidebar-item').addClass("active");
			}
			else{
				currLink.parent('li.sidebar-item').removeClass("active");
			}
		});
        var first = $('a.sidebar-link').first();
        if (scrollPos < first.position().top)
        {
            $('li.sidebar-item  a.sidebar-link').removeClass("active");
            first.parent('li.sidebar-item').addClass('active');
        }
	}
	
	$(document).ready(function() {
		$('a.sidebar-link').each(function () {
			var currLink = $(this);
			var href = currLink.attr("href");
			var refElement = $('#' + href.split('#')[1]);
			var hash = window.location.hash.substring(1);
			if (!hash)
			{
				hash = 'relate_note_link';
			}
			if (href.split('#')[1] == hash) {
				$('li.sidebar-item  a.sidebar-link').removeClass("active");
				currLink.parent('li.sidebar-item').addClass("active");
			}
			else{
				currLink.parent('li.sidebar-item').removeClass("active");
			}
		});
	});
</script>

<div class="modal fade" id="formModalToggle" aria-labelledby="formModalToggleLabel" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered " style="max-width: 600px;">
        <div class="modal-content container px-5 pt-5">
            <form action="<?php echo $this->link_form_request;?>" method="post" id="form_request">
                <div class="row">
                    <div class="mb-3 col-12 mx-auto pt-3">
                        <input name="title" type="text" id="title" required="" placeholder="Request" value="<?php echo $this->request['title'];?>" class="form-control h-50-px fw-bold rounded-0 fs-3">
                    </div>
                </div>
                <input type="hidden" name="detail_request" value="1">
                <div class="row mb-3">
                    <div class="col-12 d-flex align-items-center">
                        <label class="form-label fw-bold mb-2">Description</label>
                    </div>
                    <div class="col-12">
                        <textarea name="description" type="text" id="description" placeholder="Enter description" class="form-control rounded-0 border border-1 py-1 fs-4-5"><?php echo $this->request['description'];?></textarea>                        
                    </div>
                </div>
                <div class="row g-3 align-items-center m-0">
                    <div class="modal-footer">
                        <input name="token" type="hidden" id="token" value="91e0f6584395a6a937615717605e92c7">                            <input class="form-control rounded-0 border border-1" id="request" type="hidden" name="_method" value="PUT">
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
            </form>
        </div>
    </div>
</div>
