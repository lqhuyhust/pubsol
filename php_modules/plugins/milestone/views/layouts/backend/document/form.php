<div class="container-fluid align-items-center row justify-content-center mx-auto pt-3">
    <div class="card shadow-none p-0 col-lg-12">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-7 col-6 border-end">
                    <?php echo $this->render('message'); ?>
                    <h4>Document:</h4>
                    <?php if ($this->editor) : ?>
                        <form action="<?php echo $this->link_form ?>" method="post">
                            <div class="row">
                                <div class="mb-3 col-sm-12 mx-auto">
                                    <?php $this->field('description'); ?>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center m-0">
                                <?php $this->field('token'); ?>
                                <input class="form-control rounded-0 border border-1" type="hidden" name="_method" value="<?php echo $this->data ? 'PUT' : 'POST' ?>">
                                <div class="col-xl-12 col-sm-12 text-center">
                                    <a href="<?php echo $this->link_list ?>">
                                        <button type="button" class="btn btn-outline-secondary">Cancel</button>
                                    </a>
                                    <button type="submit" class="btn btn-outline-success">Save</button>
                                </div>
                            </div>
                        </form>
                    <?php else :
                        echo ($this->data['description']);
                    ?>
                        <a href="<?php echo $this->link_form . '?editor=1' ?>" type="submit" class="btn btn-outline-success">Edit</a>
                    <?php
                    endif;
                    ?>
                </div>
                <div class="col-lg-5 col-6">
                    <h4>Discussion:</h4>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between mb-4">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar" class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between p-3">
                                    <p class="fw-bold mb-0">Brad Pitt</p>
                                    <p class="text-muted small mb-0"><i class="far fa-clock"></i> 12 mins ago</p>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                        labore et dolore magna aliqua.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex justify-content-between mb-4">
                            <div class="card w-100">
                                <div class="card-header d-flex justify-content-between p-3">
                                    <p class="fw-bold mb-0">Lara Croft</p>
                                    <p class="text-muted small mb-0"><i class="far fa-clock"></i> 13 mins ago</p>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">
                                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                        laudantium.
                                    </p>
                                </div>
                            </div>
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-5.webp" alt="avatar" class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                        </li>
                        <li class="d-flex justify-content-between mb-4">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar" class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between p-3">
                                    <p class="fw-bold mb-0">Brad Pitt</p>
                                    <p class="text-muted small mb-0"><i class="far fa-clock"></i> 10 mins ago</p>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                        labore et dolore magna aliqua.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="bg-white mb-3">
                            <div class="form-outline">
                                <textarea class="form-control" id="textAreaExample2" rows="4"></textarea>
                                <label class="form-label" for="textAreaExample2" style="margin-left: 0px;">Message</label>
                                <div class="form-notch">
                                    <div class="form-notch-leading" style="width: 9px;"></div>
                                    <div class="form-notch-middle" style="width: 60px;"></div>
                                    <div class="form-notch-trailing"></div>
                                </div>
                            </div>
                        </li>
                        <button type="button" class="btn btn-info btn-rounded float-end">Send</button>
                    </ul>
                </div>
                <div class="col-12 mt-4">
                    <hr class="bg-danger border-2 border-top border-danger">
                    <h4>History:</h4>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($this->history as $item) : ?>
                            <li class="list-group-item">Edited at <?php echo $item['modified_at'];?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>


        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#description").attr('rows', 25);
    });
</script>