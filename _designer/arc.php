<?php
require_once 'include.php';
$preview_text = $_REQUEST['preview_text'];
$rand = uniqid();
?>
<script type="text/javascript" src="js/jquery.arctext.js"></script>

<span class="preview_text" id="preview_text<?php echo $rand?>"><?php echo $preview_text; ?></span>

<script>
    var preview_text = $('#preview_text<?php echo $rand?>').hide();
    preview_text.show().arctext({radius: 70});
</script>