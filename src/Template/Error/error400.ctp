<?php

use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'error';

if (Configure::read('debug')) :
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error400.ctp');

    $this->start('file');
    ?>
    <?php if (!empty($error->queryString)) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
        <?= h($error->queryString) ?>
    </p>
<?php endif; ?>
    <?php if (!empty($error->params)) : ?>
    <strong>SQL Query Params: </strong>
    <?php Debugger::dump($error->params) ?>
<?php endif; ?>
    <?= $this->element('auto_table_warning') ?>
    <?php
    if (extension_loaded('xdebug')) :
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>
<?= $this->Html->css('dashboard.css') ?>
<div class="container-fluid">
    <!-- 404 Error Text -->
    <div class="text-center">
        <div class="error mx-auto" data-text="404">
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">404</font>
            </font>
        </div>
        <p class="lead text-gray-800 mb-5">
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">Página não encontrada</font>
            </font>
        </p>
        <p class="text-gray-800 mb-0">
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">
                    Parece que você encontrou está no lugar errado ...
                    <?= __d('cake', 'A requisição para o endereço {0} não teve sucesso no servidor. Retorno recebido "'.h($message).'"', "<strong>'{$url}'</strong>") ?>
                </font>
            </font>
        </p>
    </div>
</div>


