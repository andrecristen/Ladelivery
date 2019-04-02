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

$cakeDescription = 'LaDelivery - LaDev';
$cacheControl = '?v=06-02-2019-01'
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
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <!--    BOOTSTRAP CSS -->
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css<?= h($cacheControl) ?>"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <!--    JQUERY JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js<?= h($cacheControl) ?>"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <!--    AJAX JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js<?= h($cacheControl) ?>9"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous"></script>
    <!--    BOOTSTRAP JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js<?= h($cacheControl) ?>"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous"></script>
    <!--    SELECT 2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css<?= h($cacheControl) ?>"
          rel="stylesheet"/>
    <!--    SELECT 2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js<?= h($cacheControl) ?>"></script>
    <!--    FONTAWESOME CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css<?= h($cacheControl) ?>"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <?= $this->Html->css('menu.css') ?>
    <?= $this->Html->script('menu.js') ?>
    <script src="/ladev/colresizable/colResizable-1.6.js<?= h($cacheControl) ?>"></script>
    <?= $this->Html->script('resizetable.js') ?>
</head>
<body>
<?= $this->Flash->render() ?>
<?php if ($login && $_SESSION['Auth']['User']['tipo'] == \App\Model\Entity\User::TIPO_ADMINISTRADOR) : ?>
<div class="nav-side-menu">
    <div class="brand">LADelivery - LADev</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
    <i class="fa fa-bars fa-2x toggle-btn-pc" onclick="closeMenu()"></i>
    <div class="menu-list">
        <ul id="menu-content" class="menu-content collapse out">
            <li class="collapsed active">
                <a href="#">
                    <i class="fas fa-chart-area"></i> Painel
                </a>
            </li>

            <li data-toggle="collapse" data-target="#unico" class="collapsed">
                <a href="#"><i class="fas fa-cogs"></i> Unico</a>
            </li>
            <ul class="sub-menu collapse" id="unico">
                <li><?= $this->Html->link(__('Usuários'), ['controller' => 'Users', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('Endereços'), ['controller' => 'Enderecos', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('Carrinhos'), ['controller' => 'ItensCarrinhos', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('Cupom'), ['controller' => 'CupomSite', 'action' => 'index']) ?></li>
            </ul>
            <li data-toggle="collapse" data-target="#delivery" class="collapsed">
                <a href="#"><i class="fas fa-motorcycle"></i> Delivery</a>
            </li>
            <ul class="sub-menu collapse" id="delivery">
                <li><?= $this->Html->link(__('Pedidos'), ['controller' => 'Pedidos', 'action' => 'index']) ?></li>
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
                <li><?= $this->Html->link(__('Listas X Adicionais'), ['controller' => 'ListasOpcoesExtras', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('Listas X Produtos'), ['controller' => 'ListasProdutos', 'action' => 'index']) ?></li>
            </ul>
            <li data-toggle="collapse" data-target="#midia" class="collapsed">
                <a href="#"><i class="fas fa-images"></i> Mídias</a>
            </li>
            <ul class="sub-menu collapse" id="midia">
                <li><?= $this->Html->link(__('Midias'), ['controller' => 'Midias', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('Banners'), ['controller' => 'Banners', 'action' => 'index']) ?></li>
            </ul>
            <li data-toggle="collapse" data-target="#sistema" class="collapsed">
                <a href="#"><i class="fab fa-windows"></i> Administrador</a>
            </li>
            <ul class="sub-menu collapse" id="sistema">
                <li><?= $this->Html->link(__('Empresas'), ['controller' => 'Empresas', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('API Google Maps Key'), ['controller' => 'GoogleMapsApiKey', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('Taxas Entregas'), ['controller' => 'TaxasEntregasCotacao', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('Tempo Produção'), ['controller' => 'TemposMedios', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('Formas Pagamento'), ['controller' => 'FormasPagamentos', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('Horários Atendimento'), ['controller' => 'HorariosAtendimentos', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('Dias Fechados'), ['controller' => 'DiasFechados', 'action' => 'index']) ?></li>
            </ul>
            <br>
            <li>
                <a href="#">
                    <i class="fas fa-sign-out-alt"></i> <?= $this->Html->link(__('Sair'), ['controller' => 'Users', 'action' => 'logout']) ?>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</div>
<?php if ($login && $_SESSION['Auth']['User']['tipo'] == \App\Model\Entity\User::TIPO_ADMINISTRADOR) : ?>
<div class="content-next-menu content">
    <?php else:; ?>
    <div style="overflow-y: scroll; height:auto;" class="content">
        <?php endif; ?>
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
