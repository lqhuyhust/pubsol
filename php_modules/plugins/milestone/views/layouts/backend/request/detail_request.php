
<?php echo $this->render('layouts.backend.relate_note.list', []); ?>
<?php echo $this->render('layouts.backend.document.form', []); ?>
<?php echo $this->render('layouts.backend.task.list', []); ?>
<?php //echo $this->render('layouts.backend.version_latest.list', []); ?>
<div class="toast message-toast" id="message_ajax">
    <div id="message_form" class="d-flex message-body ">
        <div class="toast-body">
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
<script>
	function activeMenu(link)
    {
        var link_active = link.split('#')[1];
        if (link_active)
        {
            $('a.sidebar-link').each(function () {
                var currLink = $(this);
                var href = currLink.attr("href");
                var refElement = href.split('#')[1];
                if (refElement == link_active) {
                    $('li.sidebar-item  a.sidebar-link').removeClass("active");
                    currLink.parent('li.sidebar-item').addClass("active");
                }
                else{
                    currLink.parent('li.sidebar-item').removeClass("active");
                }
            });
        }
        

        var toogleMenu = {
            'relate_note_link' : 'collapseRelateNote',
            'document_link' : 'document_form',
            'task_link' : 'collapseTask',
            'version_link' : 'collapseChangeLog',
        };

        if (toogleMenu[link_active])
        {
            $('#' + toogleMenu[link_active]).collapse('show');
            $('#' + toogleMenu[link_active]).parent(".col-12").find('.icon-collapse').toggleClass('fa-caret-down fa-caret-up');
        }
        else
        {
            $('#' + toogleMenu['relate_note_link']).collapse('show');
            $('#' + toogleMenu['relate_note_link']).parent(".col-12").find('.icon-collapse').toggleClass('fa-caret-down fa-caret-up');
        }
        $("#list-discussion").scrollTop($("#list-discussion")[0].scrollHeight);
    }
    
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
	
    $('.request-collapse').on('click', function() {
        $('.icon-collapse', this).toggleClass('fa-caret-down fa-caret-up');
    });

	$(document).ready(function() {
        activeMenu(window.location.href);
        $('a.sidebar-link').on('click', function(){
            var href = $(this).attr('href');
            activeMenu(href);
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
