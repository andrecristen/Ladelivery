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

$cakeDescription = \App\Model\Utils\EmpresaUtils::NOME_EMPRESA_LOJA;
$cacheControl = new \App\Model\Utils\CacheControl();
$cacheControl = $cacheControl->getCacheVersion();
$siteUtils = new \App\Model\Utils\SiteUtils();
$menusAdmin = $_SESSION["menus"];
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?> : <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <link rel="stylesheet" href="/css/base.css<?= h($cacheControl) ?>">
    <link rel="stylesheet" href="/css/style.css<?= h($cacheControl) ?>">
    <?php $siteUtils->ambiguousHeadImportsSite() ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <!--  MENU  -->
    <link rel="stylesheet" href="/css/menu.css<?= h($cacheControl) ?>">
    <script src="/js/menu.js<?= h($cacheControl) ?>"></script>
    <!--  PLUGIN RESIZE  -->
    <script src="/ladev/colresizable/colResizable-1.6.js<?= h($cacheControl) ?>"></script>
    <!--  INICIA RESIZE  -->
    <?= $this->Html->script('resizetable.js') ?>
    <!--  ANGULAR DIRECTIVES  -->
    <script src="/js/web-app/directives/ui-grid-form.js<?= h($cacheControl) ?>"></script>
    <link rel="stylesheet" href="/css/input-star-directive.css<?= h($cacheControl) ?>">
    <?php echo $this->Html->script('tabs.js'); ?>
    <?php echo $this->Html->css('tabs.css'); ?>
</head>
<body>
<?= $this->Flash->render() ?>
<?php if ($login && ($_SESSION['Auth']['User']['tipo'] == \App\Model\Entity\User::TIPO_ADMINISTRADOR || $_SESSION['Auth']['User']['tipo'] == \App\Model\Entity\User::TIPO_MASTER)) : ?>
    <?php $siteUtils->menuAdmin($menusAdmin)?>
    <?php $empresaUtils = new \App\Model\Utils\EmpresaUtils() ?>
    <div class="system-info">
        <div class="item-logo">
            <?= $this->Html->image('empresa/logoLaDev.png') ?>
        </div>
        <div class="item-info">
            <i title="Usuário" class="fas fa-user-circle">&nbsp;</i><span><?= $this->Html->link(__($empresaUtils->getUserName()), ['controller' => 'Users', 'action' => 'edit', $empresaUtils->getUserId()]) ?></span>
            &nbsp;
        </div>
        <div class="item-info">
            <i title="Empresa" class="fas fa-building"></i>&nbsp;<span><?= $this->Html->link(__($empresaUtils->getUserEmpresaModel()->nome_fantasia), ['controller' => 'Empresas', 'action' => 'view', $empresaUtils->getUserEmpresaId()]) ?></span>
            &nbsp;
        </div>
        <div class="item-info">
            <i title="Tipo Privilegios" class="fas fa-crown">&nbsp;</i><span><?= $this->Html->link(__(\App\Model\Entity\User::getTipoListAll()[$empresaUtils->getUserTipo()]), '#') ?></span>
        </div>
        <div class="actions-system-info">
            <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-cart-plus')) . ' Abrir Pedido', array('controller' => 'Pedidos', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-sm btn-success')) ?>
            <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-sticky-note')) . ' Abrir Comanda', array('controller' => 'Pedidos', 'action' => 'add/true'), array('escape' => false, 'class' => 'btn btn-sm btn-primary')) ?>
            <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-sign-out-alt')) . ' Sair', array('controller' => 'users', 'action' => 'logout'), array('escape' => false, 'class' => 'btn btn-sm btn-danger')) ?>
        </div>
    </div>
<?php endif; ?>
<?php if ($login && ($_SESSION['Auth']['User']['tipo'] == \App\Model\Entity\User::TIPO_ADMINISTRADOR || $_SESSION['Auth']['User']['tipo'] == \App\Model\Entity\User::TIPO_MASTER)) : ?>
<div class="content-next-menu content">
    <?php else:; ?>
    <div style="height:auto; padding-bottom: 0px!important;" class="content">
        <?php endif; ?>
        <?= $this->fetch('content') ?>
    </div>
</div>
<footer>
</footer>
</body>
</html>
