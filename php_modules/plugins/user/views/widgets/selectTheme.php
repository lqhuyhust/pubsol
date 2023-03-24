<?php 

$this->theme->addInline('js', '
$("#chooseTheme").change(function(){
    document.location.href="?theme="+$(this).val();
})');

$arr = [
    'b4' => 'Bootstrap 4',
    'm' => 'Materialize',
    'f6' => 'Foundation 6',
    'w3' => 'W3.css',
]

?>
<select id="chooseTheme">
<?php foreach($arr as $k => $v) {
    echo '<option value="'.$k.'" ' ;
    echo $this->themeName == $k ? 'selected="selected"' : '';
    echo ' >'. $v. '</option>';
} ?>
</select>