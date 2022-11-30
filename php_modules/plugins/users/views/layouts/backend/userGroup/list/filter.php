<form  method="post" class="filterform" id="filterform" action="<?php echo $this->link_user_group_list; ?>">
    <div class="row mb-3 border rounded m-0 d-flex">
        <div class="col-sm-12 col-md-12 d-flex justify-content-between wrap_740">
            <div class="dt-buttons btn-group flex-wrap align-items-center">
                <div class="dropdown mr-2 py-2 order-2-475">
                    <a href="<?php echo $this->link_user_group_form_add ?>">
                        <button class="btn infor-btn input_common fz-16"
                            type="button" aria-expanded="false"
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Add new group">
                            <i class="fas fa-plus"></i>
                        </button>
                    </a>
                </div>
                <div class="dropdown mr-2 py-2 order-2-475">
                    <button
                        class="btn btn-secondary dropdown-toggle input_common"
                        type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Action
                    </button>
                    <ul class="dropdown-menu"
                        aria-labelledby="dropdownMenuButton1">
                        <li class="m-0" id="btn-remove"><a class="dropdown-item" href="#">Remove
                                Selected</a></li>
                        <li class="m-0" id="btn-active"><a class="dropdown-item"
                                href="#">Active</a></li>
                        <li class="m-0" id="btn-unactive"><a class="dropdown-item"
                                href="#">Unactive</a></li>
                    </ul>
                </div>

                <div class="dropdown mr-2 py-2 w_full_475">
                        <?php $this->field('search');  ?>
                </div>
                <div class="dropdown mr-2 py-2 w_full_475 d-none">
                        <?php $this->field('sort');  ?>
                </div>
                <div class="dropdown mr-2 py-2 w_full_475 d-none">
                        <?php $this->field('search_status');  ?>

                </div>

                <div class="d-flex order-2-475">
                    <div class="dropdown mr-2 py-2">
                        <button class="btn infor-btn input_common fz-16"
                            type="submit" aria-expanded="false"
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Apply filter">
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                    <div class="dropdown py-2">
                        <button class="btn infor-btn input_common fz-16" id="clear_filter"
                            type="button" aria-expanded="false"
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Clear filter">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>

            </div>

            <div class="d-flex">
                <div class="py-2" style="width: 100px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Limit record">
                    <select class="w-full input_common" name="limit" id="limit">
                        <option value="10" <?= $this->dataform['limit'] == 10 ? 'selected' : '' ?>>10</option>
                        <option value="20" <?= $this->dataform['limit'] == 20 ? 'selected' : '' ?>>20</option>
                        <option value="50" <?= $this->dataform['limit'] == 50 ? 'selected' : '' ?>>50</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>
