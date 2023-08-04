<script>
     $(document).ready(function(e) {
        $(".btn-save-close").click(function(e) {
            e.preventDefault();
            $("#save_close").val(1);
            if (!$('input#title').val())
            {
                alert("Please enter a valid Title");
                $('html, body').animate({
                    scrollTop: 0
                });
                $('input#title').focus();
                return false;
            }
            $('#form_submit').submit();
        });

        $(".btn-apply").click(function(e) {
            e.preventDefault();
            $("#save_close").val(0);
            if (!$('input#title').val())
            {
                alert("Please enter a valid Title");
                $('html, body').animate({
                    scrollTop: 0
                });
                $('input#title').focus();
                return false;
            }
            $('#form_submit').submit();
        });
    });
</script>