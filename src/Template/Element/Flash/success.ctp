<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div id="success-div" class="alert alert-success alert-dismissible fade show success-modal">
    <h5>Sucesso na Operação!</h5>
    <span><?= $message ?></span>
<button type="button" onclick="onClose()" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>

<script>
    setTimeout(function () {
        $('#success-div').remove();
    }, 5000)
</script>