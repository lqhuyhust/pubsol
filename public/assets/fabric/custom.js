var canvas;
var activeObject;
function initCanvas(element)
{
    canvas = this.__canvas = new fabric.Canvas('c');
    canvas.setDimensions({
        width: element.width(),
        height: 600
    });

    canvas.setBackgroundColor('#565656', canvas.renderAll.bind(canvas));
}
initCanvas($('#editor-canvas'));
// create a rect object

function addRect(){
    var rect = new fabric.Rect({
        left: canvas.width / 2,
        top: canvas.height / 2,
        fill: '#ffa726',
        width: 100,
        height: 100,
        originX: 'center',
        originY: 'center',
        strokeWidth: 0
    });
    canvas.add(rect);
    canvas.setActiveObject(rect);
}

function addCircle() {
    var circl = new fabric.Circle({
        left: canvas.width / 2,
        top: canvas.height / 2,
        fill: '#26a69a',
        radius: 50,
        originX: 'center',
        originY: 'center',
        strokeWidth: 0
    });
    canvas.add(circl);
    canvas.setActiveObject(circl);
}

function addArrow(){
    var triangle = new fabric.Triangle({
        width: 10, 
        height: 15, 
        fill: 'red', 
        left: 235, 
        top: 65,
        angle: 90
    });

    var line = new fabric.Line([50, 100, 200, 100], {
        left: 75,
        top: 70,
        stroke: 'red'
    });

    var objs = [line, triangle];

    var alltogetherObj = new fabric.Group(objs);
    canvas.add(alltogetherObj);
    canvas.setActiveObject(alltogetherObj);
}

function deleteObject(eventData, transform) {
    var target = transform.target;
    var canvas = target.canvas;
    canvas.remove(target);
    canvas.requestRenderAll();
}

function renderIcon(ctx, left, top, styleOverride, fabricObject) {
    var size = this.cornerSize;
    ctx.save();
    ctx.translate(left, top);
    ctx.rotate(fabric.util.degreesToRadians(fabricObject.angle));
    ctx.drawImage(img, -size / 2, -size / 2, size, size);
    ctx.restore();
}

function Save() {
    var json = canvas.toJSON();
    localStorage.setItem("data", JSON.stringify(json));
}

function Import() {
    var data = localStorage.getItem('data');
    canvas.loadFromJSON(data, function() {
        canvas.renderAll();
    });
}

function addText()
{
    let text = new fabric.IText('Text', {
        left: canvas.width / 2,
        top: canvas.height / 2,
        fill: '#e0f7fa',
        fontFamily: 'sans-serif',
        hasRotatingPoint: false,
        centerTransform: true,
        originX: 'center',
        originY: 'center',
        lockUniScaling: true
    });
    
    canvas.add(text);
    canvas.setActiveObject(text);
}

function addImage()
{
    $('#addImageModal').modal('show');
}

function remove()
{
    let activeObjects = canvas.getActiveObjects();
    canvas.discardActiveObject();
    if (activeObjects.length) {
        canvas.remove.apply(canvas, activeObjects);
    }
}

canvas.on('selection:updated', updateInfo);
canvas.on('selection:created', updateInfo);
canvas.on('selection:cleared', updateInfo);

function updateInfo()
{
    activeObject = canvas.getActiveObject();
    console.log(activeObject);
    if(activeObject)
    {
        color = activeObject.get('fill');
        opacity = activeObject.get('opacity') * 100;
        $('#editPosition').removeClass('d-none');
        $('#editColor').removeClass('d-none');
    }
    else
    {
        $('#editPosition').addClass('d-none');
        $('#editColor').addClass('d-none');
    }
    
}

function sendToBack()
{
    activeObject = canvas.getActiveObject();
    if (activeObject)
    {
        activeObject.sendToBack();
        return true;
    }
    
    return false
}

function sendBackwards()
{
    activeObject = canvas.getActiveObject();
    if (activeObject)
    {
        activeObject.sendBackwards();
        return true;
    }
    
    return false
}

function bringToFront()
{
    activeObject = canvas.getActiveObject();
    if (activeObject)
    {
        activeObject.bringToFront();
        return true;
    }
    
    return false
}

function bringForward()
{
    activeObject = canvas.getActiveObject();
    if (activeObject)
    {
        activeObject.bringForward();
        return true;
    }
    
    return false
}

$(document).ready(function(){   
    $('.import-image').on('click', function(){
        var image = $('input[name="add_image"]').val();
        fabric.Image.fromURL(image, (img) => {
            canvas.add(img); 
        });
        $('#addImageModal').modal('hide');
    })
});