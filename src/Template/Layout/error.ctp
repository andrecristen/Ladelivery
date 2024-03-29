<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
<div class="page-wrap d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <div id="content">
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>
                </div>
                <div id="footer">
                    <?= $this->Html->link(__('← Voltar'), 'javascript:history.back()', ['class' => 'btn btn-primary btn-lg']) ?>
                    <a href="/pages/suporte" class="btn btn-success btn-lg">
                        <span class="glyphicon glyphicon-envelope"></span>
                        <i class="fas fa-headset"></i>&nbsp;Suporte
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
    <div id="container">
    </div>
</body>
</html>
<style>
    body {
        background: #dedede;
    }
    .page-wrap {
        min-height: 100vh;
    }
</style>
