
<?php echo $this->renderWidget('core::notification'); ?>
<div class="container-fluid align-items-center row justify-content-center mx-auto pt-3">
    <form enctype="multipart/form-data" action="<?php echo $this->link_form . '/' . $this->id ?>" method="post" id="form_submit">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-sm-12">
                <input id="input_title" type="hidden" name="title" required>
                <input id="_method" type="hidden" name="_method" value="<?php echo $this->id ? 'PUT' : 'POST' ?>">
                <div>
                    <?php $this->ui->field('data'); ?>
                </div>
                <input id="save_close" type="hidden" name="save_close">
            </div>
            <div class="col-lg-4 col-sm-12">
                <div>
                    <?php $this->ui->field('notice'); ?>
                </div>
                <div class="mt-3 widget-tag">
                    <?php echo $this->renderWidget('tag::backend.tags'); ?>
                </div>
                <div class="mt-3 widget-assignee">
                    <?php echo $this->renderWidget('user_assignee::backend.assignee'); ?>
                </div>
                <?php if ($this->history) : ?>
                <div class="mt-3 widget-history">
                    <label for="label">History:</label>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($this->history as $item) : ?>
                            <li class="list-group-item">
                                <a href="<?php echo $this->link_history.'/'. $item['id'] ?>" class="openHistory" data-id="<?php echo $item['id']; ?>" data-modified_at="<?php echo $item['created_at']; ?>">Modified at <?php echo $item['created_at']; ?> by <?php echo $item['user']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <div class="mt-3">
                    <?php echo $this->renderWidget('note2_attachment::backend.attachments'); ?>
                </div>            
            </div>
        </div>
    </form>
</div>
<?php echo $this->render('backend.form.javascript'); ?>

