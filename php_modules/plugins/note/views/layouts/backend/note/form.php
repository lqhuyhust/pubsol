<div class="container-fluid align-items-center row justify-content-center mx-auto pt-3">
    <div class="card shadow-none p-0 col-lg-12">
        <div class="card-body">
            <?php echo $this->render('message'); ?>
            <form action="<?php echo $this->link_form . '/' . $this->id ?>" method="post">
                <div class="row g-3 align-items-center">

                    <div class="row">
                        <div class="mb-3 col-lg-6 col-sm-12 mx-auto">
                            <label class="form-label fw-bold">HTML Editor:</label>
                            <?php $this->field('html_editor'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-6 col-sm-12 mx-auto pt-3">
                            <label class="form-label fw-bold">File:</label>
                            <?php $this->field('file'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-6 col-sm-12 mx-auto pt-3">
                            <label class="form-label fw-bold">Title:</label>
                            <?php $this->field('title'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-6 col-sm-12 mx-auto pt-3">
                            <label class="form-label fw-bold">Tags:</label>
                            <?php $this->field('tags'); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-lg-6 col-sm-12 mx-auto pt-3">
                            <label class="form-label fw-bold">Tags:</label>
                            <select class="js-example-tags" multiple id="select_tags"></select>
                        </div>
                    </div>

                    <div class="row g-3 align-items-center m-0">
                        <?php $this->field('token'); ?>
                        <input class="form-control rounded-0 border border-1" type="hidden" name="_method" value="<?php echo $this->id ? 'PUT' : 'POST' ?>">
                        <div class="col-xl-6 col-sm-6 text-end">
                            <a href="<?php echo $this->link_list ?>">
                                <button type="button" class="btn btn-outline-secondary">Cancel</button>
                            </a>
                        </div>
                        <div class="col-xl-3 col-sm-6 text-start ">
                            <button type="submit" class="btn btn-outline-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    span.select2{
        width: 100% !important;
    }
</style>

<script>
    $(".js-example-tags").select2({
        tags: true,
        createTag:newtag,
        // matcher: matchCustom,
        ajax: {
            url: "http://sdm.local/admin/tag",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term
                };
            },
            processResults: function (data, params) {
                let items = [];
                if (data.data.length > 0) {
                    data.data.forEach( function (item) {
                        items.push({id: item.id, text: item.name})
                    })
                }

                return {
                    results: items,
                    pagination: {
                        more: false
                    }
                };
            },
            cache: true
        },
        placeholder: 'Search tags',
        minimumInputLength: 2,
    });

    function newtag(params, data){
        var term = $.trim(params.term);
        if (term === '') {
            return null;
        }

        return {
            id: term,
            text: term + " (New tag)",
            newTag: true // add additional parameters
        }
    }

    $('.js-example-tags').on('select2:select', function (e) {
        let tag = e.params.data;
        if (tag.newTag === true) {
            console.log('========data', tag);
            // $.post( "http://sdm.local/admin/tag", { name: "tag"})
            //     .done(function( data ) {
            //         console.log('========data', data);
            //     });
        }
        console.log('===1', $('#select_tags').val());
        // if ($('#select_tags').val().length > 0){
        //
        // }
    });

    $('.js-example-tags').on('change', function (e) {
        // let tag = e.params.data;
        // console.log('=====tag', tag);

        console.log('========', $('#select_tags').val());
    })
</script>
