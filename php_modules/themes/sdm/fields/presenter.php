<?php use SPT\Theme;

static $presenter;
if(!isset($presenter))
{
    $this->theme->add($this->url . 'assets/fabric/fabric.min.js', '', 'fabric.min.js', 'top');
    $this->theme->add($this->url . 'assets/fabric/custom.js', '', 'fabric-custom.js');
}
?>
<div class="row">
    <div class="col-12" id="editor-canvas">
        <canvas id="canvas"></canvas>
    </div>
    <div class="col-12">
        <div class="container-fluid text-center my-3">
            <a class="btn btn-primary me-3 previous-button" onclick=""><i class="fa-solid fa-chevron-left"></i>
            </a>
            <a class="btn btn-primary me-3 next-button" onclick=""><i class="fa-solid fa-chevron-right"></i>
            </a>
            <a class="btn btn-primary me-3" onclick=""><i class="fa-solid fa-plus"></i>
            </a>
            <a class="btn btn-danger me-3" onclick=""><i class="fa-solid fa-trash"></i>
            </a>
        </div>
        <div class="container-fluid text-center my-3">
            
            <a class="btn btn-primary me-3" onclick="addText()">Add Text
            </a>
            <a class="btn btn-primary me-3" onclick="addRect()">Add Rectangle
            </a>
            <a class="btn btn-primary me-3" onclick="addCircle()">Add Circle
            </a>
            <a class="btn btn-primary me-3" onclick="addArrow()">Add Arrow
            </a>
            <a class="btn btn-primary me-3" onclick="addImage()">Add Image
            </a>
            <a class="btn btn-danger me-3 selector-remove-button d-none" onclick="remove()">Remove
            </a>
        </div>
        <div class="container-fluid text-center my-3 d-none" id="editPosition">
            <a class="btn btn-primary" onclick="bringForward()">↑
            </a>
            <a class="btn btn-primary" onclick="bringToFront()">⇑
            </a>
            <a class="btn btn-primary" onclick="sendBackwards()">↓
            </a>
            <a class="btn btn-primary" onclick="sendToBack()">⇓
            </a>
            <div class="d-flex justify-content-center mt-3">
                <input class="me-3" type="color" name="fill_color">
                <h3>Fill: <span id="color-fill"></span></h3>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addImageModal" aria-hidden="true" aria-labelledby="addImageModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addImageModalLabel">Add Image</h5>
            <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
        </div>
        <div class="modal-body">
            <input type="text" name="add_image" placeholder="http://imageurl.com" class="form-control">
        </div>
        <div class="modal-footer">
            <a class="btn btn-primary import-image">Add</a>
        </div>
        </div>
    </div>
</div>
<input name="<?php echo $this->field->name ?>" type="hidden" id="<?php echo $this->field->id ?>" value="<?php echo $this->field->value?>" />
<script>
    var data = '<?php echo $this->field->value; ?>';
    $(document).ready(function(){
        if (data)
        {
            data = JSON.parse(data);
            console.log(data);
            Import(data);
        }
    });
</script>