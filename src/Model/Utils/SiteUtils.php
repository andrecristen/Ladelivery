<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

namespace App\Model\Utils;


use App\Controller\AppController;
use App\Model\Entity\CategoriasProduto;
use App\View\AppView;
use Cake\Datasource\ConnectionManager;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\View\Helper\HtmlHelper;

class SiteUtils extends AppController
{
    protected $Html;

    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, \Cake\Event\EventManager $eventManager = null, ComponentRegistry $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $appView = new AppView();
        $this->Html = new HtmlHelper($appView, []);
    }

    /**
     * @todo Utilizar mapeamento destas informacoes para gerar relatorios.
     */
    public static function getMesList()
    {
        return [
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'];
    }

    /**
     * @todo Utilizar mapeamento destas informacoes para gerar relatorios.
     */
    public static function getAnoList()
    {
        $anoHomologacao = EmpresaUtils::ANO_HOMOLOGACAO_EMPRESA;
        $date = new \DateTime();
        $date = $date->format('Y');
        $anos = [];
        $anos[] = $anoHomologacao;
        $anoAtual = $anoHomologacao;
        $diferenca = (intval($date) - $anoAtual);
        for ($i = 0; $i < $diferenca; $i++) {
            $anos[] = $anoAtual + 1;
            $anoAtual += 1;
        }
        return $anos;
    }

    public function showStarsByNota($nota)
    {
        switch (intval($nota)) {
            case 0:
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                break;
            case 1:
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                break;
            case 2:
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                break;
            case 3:
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                break;
            case 4:
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star"></span>';
                break;
            case 5:
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                break;
            default:
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                break;

        }
    }

    public function getValueStarsProduto($produtoId)
    {
        $sql = 'SELECT AVG(nota) as stars FROM produtos_avaliacoes WHERE produto_id = ' . $produtoId;
        $connection = ConnectionManager::get('default');
        $results = $connection->execute($sql)->fetchAll('assoc');
        if (isset($results[0]['stars'])) {
            return number_format($results[0]['stars'], 2, ',', '');
        }
        return 0;
    }

    public function getStarsProduto($produtoId)
    {
        $intNota = intval($this->getValueStarsProduto($produtoId));
        $this->showStarsByNota($intNota);
    }

    /**
     * Imports no head html das pages do site que sao
     * compartilhadas entre as pages.
     */
    public final function ambiguousHeadImportsSite()
    {
        $cacheControl = new \App\Model\Utils\CacheControl();
        $cacheVersion = $cacheControl->getCacheVersion();
        echo $this->Html->css('banner.css'.$cacheVersion);
        echo $this->Html->css('bootstrap.css'.$cacheVersion);
        echo $this->Html->css('font-awesome-all.css'.$cacheVersion);
        echo $this->Html->css('bootstrap-select.css'.$cacheVersion);
        echo $this->Html->script('jquery.js'.$cacheVersion);
        echo $this->Html->script('popper.js'.$cacheVersion);
        echo $this->Html->script('angular.js'.$cacheVersion);
        echo $this->Html->script('bootstrap.js'.$cacheVersion);
       // echo $this->Html->script('font-awesome-all.js'.$cacheVersion);
        echo $this->Html->script('bootstrap-select.js'.$cacheVersion);
        echo $this->Html->script('site-utils.js'.$cacheVersion);
    }

    public final function menuAdmin($menus){
        echo '<div class="nav-side-menu">';
            echo '<div class="brand">LADelivery</div>';
            echo '<i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>';
            echo '<i class="fa fa-bars fa-fw toggle-btn-pc" onclick="closeMenu()"></i>';
            echo '<div class="menu-list">';
                echo '<ul id="menu-content" class="menu-content collapse out">';
                foreach ($menus as $key => $menu){
                    echo '<li data-toggle="collapse" data-target="#'.$key.'" class="collapsed">';
                    echo '<a href="#"><i class="'.$menu['icon'].'"></i> '.$menu['nome'].'</a>';
                    echo '</li>';
                    echo '<ul class="sub-menu collapse" id="'.$key.'">';
                        foreach ($menu['childrens'] as $children) {
                            echo '<li>'.$this->Html->link(__($children['nome']), ['controller' => $children['controller'], 'action' => $children['action']]).'</li>';
                        }
                     echo '</ul>';
                }
                echo '</ul>';
            echo '</div>';
        echo '</div>';
    }

    public final function menuSite()
    {
        $cakeDescription = \App\Model\Utils\EmpresaUtils::NOME_EMPRESA_LOJA;
        /** @var $categorias CategoriasProduto[]*/
        $categorias = $this->getTableLocator()->get('CategoriasProdutos')->find();
        $itensCarrinhos = $this->getTableLocator()->get('ItensCarrinhos')->find()->where(['user_id' => $this->Auth->user('id')])->count();
        echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">';
        echo '<div class="container">';
        echo '<a class="navbar-brand" href="#">' . $cakeDescription . '</a>';
        echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>';
        echo '<div class="collapse navbar-collapse" id="navbarResponsive">';
        echo '<ul class="navbar-nav ml-auto">';
        echo '<li class="nav-item active">';
        echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-home')) . ' Início', array('controller' => 'pages', 'action' => ''), array('escape' => false, 'class' => 'nav-link'));
        echo '</li>';
        echo '<li class="dropdown nav-item">';
        echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-th-list')) . ' Categorias', '#', array('escape' => false, 'class' => 'nav-link dropdown-toggle'));
        echo '<div class="dropdown-menu menu-site">';
            foreach ($categorias as $categoria){
                echo $this->Html->link($this->Html->tag('i', '', array('class' => '')) . ' '.$categoria->nome_categoria, array('controller' => 'pages', 'action' => 'produtos?categoria='.$categoria->id.'&categoriaNome='.$categoria->nome_categoria), array('escape' => false, 'class' => 'dropdown-item menu-site-item'));
            }
            echo $this->Html->link($this->Html->tag('i', '', array('class' => '')) . ' Todas', array('controller' => 'pages', 'action' => 'categorias'), array('escape' => false, 'class' => 'dropdown-item menu-site-item'));
        echo '</div>';
        echo '</li>';
        if ($this->Auth->user('id')) {
            echo '<li class="nav-item">';
            echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-user-circle')) . ' Minha Conta', array('controller' => 'users', 'action' => 'profile'), array('escape' => false, 'class' => 'nav-link'));
            echo '</li>';
            echo '<li class="nav-item">';
            echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-shopping-cart')) . ' Carrinho'.$this->Html->tag('div', $itensCarrinhos, array('class' => 'icon-cart-number')), array('controller' => 'pages', 'action' => 'carrinho'), array('escape' => false, 'class' => 'nav-link'));
            echo '</li>';
            echo '<li class="nav-item">';
            echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-sign-out-alt')) . ' Sair', array('controller' => 'users', 'action' => 'logout'), array('escape' => false, 'class' => 'nav-link'));
            echo '</li>';
        } else {
            echo '<li class="nav-item">';
            echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-sign-in-alt')) . ' Entrar', array('controller' => 'users', 'action' => 'login'), array('escape' => false, 'class' => 'nav-link'));
            echo '</li>';
        }
        echo '</div>';
        echo '</div>';
        echo '</nav>';
    }

}