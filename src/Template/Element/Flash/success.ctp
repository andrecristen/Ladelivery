<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div id="success-div" style="position: absolute;right: 5px; width: 80%; top: 10px; z-index: 99999" class="alert alert-success alert-dismissible fade show">
    <span><?= $message ?></span>
<button type="button" onclick="onClose()" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>

<script>
    setTimeout(function () {
        $('#success-div').hide();
    }, 5000)
</script>