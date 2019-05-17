<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<button id="openModal" style="display: none" type="button" class="btn btn-primary" data-toggle="modal"
        data-target="#modal">OPEN
</button>
<div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog alert alert-info" role="document">
        <div style="background-color: #fff0;" class="modal-content">
            <div style="border-bottom: 0px;" class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informação!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $message ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#openModal').click();
    });
</script>