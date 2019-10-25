<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'error';

if (Configure::read('debug')) :
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error500.ctp');

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
<?php if ($error instanceof Error) : ?>
        <strong>Error in: </strong>
        <?= sprintf('%s, line %s', str_replace(ROOT, 'ROOT', $error->getFile()), $error->getLine()) ?>
<?php endif; ?>
<?php
    echo $this->element('auto_table_warning');

    if (extension_loaded('xdebug')) :
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>
<?= $this->Html->css('dashboard.css') ?>
<div class="container-fluid">
    <div class="text-center">
        <div class="error mx-auto" data-text="500">
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">500</font>
            </font>
        </div>
        <p class="lead text-gray-800 mb-5">
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">Ocorreu um erro interno. Lamentamos!</font>
            </font>
        </p>
        <p class="text-gray-800 mb-0">
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">
                    <?= h('Algo de errado aconteceu, verifique o endereço digitado e tente novamente.') ?>
                    <br>
                    <strong><?= __d('cake', 'Error') ?>: </strong>
                    <?= h($message) ?>
                    <br>
                    <br>
                </font>
            </font>
        </p>
    </div>
</div>
