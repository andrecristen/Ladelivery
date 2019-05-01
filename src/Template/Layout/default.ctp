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
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <link rel="stylesheet" href="/css/base.css<?= h($cacheControl) ?>">
    <link rel="stylesheet" href="/css/style.css<?= h($cacheControl) ?>">
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <!--    BOOTSTRAP CSS -->
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css<?= h($cacheControl) ?>"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <!--    JQUERY JS -->
    <script src="https://code.jquery.com/jquery-3.1.0.min.js<?= h($cacheControl) ?>"></script>
    <!--    AJAX JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js<?= h($cacheControl) ?>9"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous"></script>
    <!--    BOOTSTRAP JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js<?= h($cacheControl) ?>"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous"></script>
    <!--    ANGULARJS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js<?= h($cacheControl) ?>"></script>
    <!--    FONTAWESOME CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css<?= h($cacheControl) ?>"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!--  BOOTSTRAP SELECT  -->
    <script src="/ladev/bootstrap-select/dist/js/bootstrap-select.min.js<?= h($cacheControl) ?>"></script>
    <link rel="stylesheet" href="/ladev/bootstrap-select/dist/css/bootstrap-select.min.css<?= h($cacheControl) ?>">
    <!--  MENU  -->
    <link rel="stylesheet" href="/css/menu.css<?= h($cacheControl) ?>">
    <script src="/js/menu.js<?= h($cacheControl) ?>"></script>
    <!--  PLUGIN RESIZE  -->
    <script src="/ladev/colresizable/colResizable-1.6.js<?= h($cacheControl) ?>"></script>
    <!--  INICIA RESIZE  -->
    <?= $this->Html->script('resizetable.js') ?>
    <!--  ANGULAR DIRECTIVES  -->
    <script src="/js/web-app/directives/ui-grid-form.js<?= h($cacheControl) ?>"></script>
    <script src="/js/web-app/directives/ui-input-star.js<?= h($cacheControl) ?>"></script>
    <link rel="stylesheet" href="/css/input-star-directive.css<?= h($cacheControl) ?>">
    <?php echo $this->Html->script('tabs.js'); ?>
    <?php echo $this->Html->css('tabs.css'); ?>
</head>
<body>
<?= $this->Flash->render() ?>
<?php if ($login && ($_SESSION['Auth']['User']['tipo'] == \App\Model\Entity\User::TIPO_ADMINISTRADOR || $_SESSION['Auth']['User']['tipo'] == \App\Model\Entity\User::TIPO_MASTER)) : ?>
    <div class="nav-side-menu">
        <div class="brand">LADelivery - LADev</div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
        <i class="fa fa-bars fa-fw toggle-btn-pc" onclick="closeMenu()"></i>
        <div class="menu-list">
            <ul id="menu-content" class="menu-content collapse out">
                <li data-toggle="collapse" data-target="#financeiro" class="collapsed">
                    <a href="#"><i class="fas fa-chart-area"></i> Financeiro</a>
                </li>
                <ul class="sub-menu collapse" id="financeiro">
                    <li><?= $this->Html->link(__('Painel'), ['controller' => 'Financeiro', 'action' => 'painel']) ?></li>
                    <li><?= $this->Html->link(__('Caixa'), ['controller' => 'Financeiro', 'action' => 'painel']) ?></li>
                    <li><?= $this->Html->link(__('Produtos'), ['controller' => 'Financeiro', 'action' => 'painel']) ?></li>
                    <li><?= $this->Html->link(__('Pagamentos'), ['controller' => 'Financeiro', 'action' => 'painel']) ?></li>
                    <li><?= $this->Html->link(__('Entregas'), ['controller' => 'Financeiro', 'action' => 'painel']) ?></li>
                </ul>

                <li data-toggle="collapse" data-target="#delivery" class="collapsed">
                    <a href="#"><i class="fas fa-motorcycle"></i> Delivery</a>
                </li>
                <ul class="sub-menu collapse" id="delivery">
                    <li><?= $this->Html->link(__('Pedidos'), ['controller' => 'Pedidos', 'action' => 'listAll']) ?></li>
                    <li><?= $this->Html->link(__('Entregas'), ['controller' => 'PedidosEntregas', 'action' => 'index']) ?></li>
                </ul>
                <li data-toggle="collapse" data-target="#interno" class="collapsed">
                    <a href="#"><i class="fas fa-home"></i> Interno</a>
                </li>
                <ul class="sub-menu collapse" id="interno">
                    <li><?= $this->Html->link(__('Comandas'), ['controller' => 'Pedidos', 'action' => 'comandas']) ?></li>
                    <li><?= $this->Html->link(__('Bar'), ['controller' => 'PedidosProdutos', 'action' => 'bar']) ?></li>
                    <li><?= $this->Html->link(__('Cozinha'), ['controller' => 'PedidosProdutos', 'action' => 'cozinha']) ?></li>
                </ul>

                <li data-toggle="collapse" data-target="#produto" class="collapsed">
                    <a href="#"><i class="fas fa-box"></i> Produto</a>
                </li>
                <ul class="sub-menu collapse" id="produto">
                    <li><?= $this->Html->link(__('Categorias'), ['controller' => 'CategoriasProdutos', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Produtos'), ['controller' => 'Produtos', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Listas'), ['controller' => 'Listas', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Adicionais'), ['controller' => 'OpcoesExtras', 'action' => 'index']) ?></li>
                </ul>

                <li data-toggle="collapse" data-target="#midia" class="collapsed">
                    <a href="#"><i class="fas fa-images"></i> Mídias</a>
                </li>
                <ul class="sub-menu collapse" id="midia">
                    <li><?= $this->Html->link(__('Midias'), ['controller' => 'Midias', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Banners'), ['controller' => 'Banners', 'action' => 'index']) ?></li>
                </ul>

                <li data-toggle="collapse" data-target="#marketing" class="collapsed">
                    <a href="#"><i class="fas fa-mail-bulk"></i> Marketing</a>
                </li>
                <ul class="sub-menu collapse" id="marketing">
                    <li><?= $this->Html->link(__('Propaganda Email'), ['controller' => 'Marketing', 'action' => 'email']) ?></li>
                    <li><?= $this->Html->link(__('Notificação APP'), ['controller' => 'Marketing', 'action' => 'notificar']) ?></li>
                </ul>

                <li data-toggle="collapse" data-target="#unico" class="collapsed">
                    <a href="#"><i class="fas fa-cogs"></i> Unico</a>
                </li>
                <ul class="sub-menu collapse" id="unico">
                    <li><?= $this->Html->link(__('Usuários'), ['controller' => 'Users', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Endereços'), ['controller' => 'Enderecos', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Carrinhos'), ['controller' => 'ItensCarrinhos', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Cupom'), ['controller' => 'CupomSite', 'action' => 'index']) ?></li>
                </ul>

                <li data-toggle="collapse" data-target="#sistema" class="collapsed">
                    <a href="#"><i class="fab fa-windows"></i> Administrador</a>
                </li>
                <ul class="sub-menu collapse" id="sistema">
                    <li><?= $this->Html->link(__('Taxas Entregas'), ['controller' => 'TaxasEntregasCotacao', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Tempo Produção'), ['controller' => 'TemposMedios', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Formas Pagamento'), ['controller' => 'FormasPagamentos', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Horários Atendimento'), ['controller' => 'HorariosAtendimentos', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Dias Fechados'), ['controller' => 'DiasFechados', 'action' => 'index']) ?></li>
                </ul>
                <li data-toggle="collapse" data-target="#engine" class="collapsed">
                    <a href="#"><i class="fas fa-sitemap"></i> Engine</a>
                </li>
                <ul class="sub-menu collapse" id="engine">
                    <li><?= $this->Html->link(__('Empresas'), ['controller' => 'Empresas', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('API Google Maps Key'), ['controller' => 'GoogleMapsApiKey', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Controllers'), ['controller' => 'Controllers', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Actions'), ['controller' => 'Actions', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Perfils'), ['controller' => 'Perfils', 'action' => 'index']) ?></li>
                </ul>
            </ul>
        </div>
    </div>
    <?php $empresaUtils = new \App\Model\Utils\EmpresaUtils() ?>
    <div class="system-info">
        <i title="Usuário" class="fas fa-user-circle">&nbsp;</i><span><?= $this->Html->link(__($empresaUtils->getUserName()), ['controller' => 'Users', 'action' => 'edit', $empresaUtils->getUserId()]) ?></span>
        &nbsp;
        <i title="Empresa" class="fas fa-building"></i>&nbsp;<span><?= $this->Html->link(__($empresaUtils->getUserEmpresaModel()->nome_fantasia), ['controller' => 'Empresas', 'action' => 'view', $empresaUtils->getUserEmpresaId()]) ?></span>
        &nbsp;
        <i title="Tipo Privilegios" class="fas fa-crown">&nbsp;</i><span><?= $this->Html->link(__(\App\Model\Entity\User::getTipoListAll()[$empresaUtils->getUserTipo()]), '#') ?></span>
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
    <footer>
    </footer>
</body>
</html>
