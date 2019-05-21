<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

namespace App\Model\Utils;


use App\Controller\AppController;
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

    public function showStarsByNota($nota){
        switch (intval($nota)){
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

    public function getValueStarsProduto($produtoId){
        $sql = 'SELECT AVG(nota) as stars FROM produtos_avaliacoes WHERE produto_id = '.$produtoId;
        $connection = ConnectionManager::get('default');
        $results = $connection->execute($sql)->fetchAll('assoc');
        if(isset($results[0]['stars'])){
            return number_format($results[0]['stars'], 2, ',','');
        }
        return 0;
    }

    public function getStarsProduto($produtoId){
        $intNota = intval($this->getValueStarsProduto($produtoId));
        $this->showStarsByNota($intNota);
    }

    public final function menuSite(){
        $cakeDescription = \App\Model\Utils\EmpresaUtils::NOME_EMPRESA_LOJA;
        echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">';
        echo '<div class="container">';
        echo '<a class="navbar-brand" href="#">'. $cakeDescription .'</a>';
        echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>';
        echo '<div class="collapse navbar-collapse" id="navbarResponsive">';
        echo '<ul class="navbar-nav ml-auto">';
        echo '<li class="nav-item active">';
        echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-home')).' Início', array('controller' => 'pages', 'action' => ''), array('escape' => false , 'class' => 'nav-link'));
        echo '</li>';
        echo '<li class="nav-item">';
        echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-th-list')).' Categorias', array('controller' => 'pages', 'action' => 'categorias'), array('escape' => false , 'class' => 'nav-link'));
        echo '</li>';
        if($this->Auth->user('id')){
            echo '<li class="nav-item">';
            echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-user-circle')).' Minha Conta', array('controller' => 'users', 'action' => 'profile/'.$_SESSION['Auth']['User']['id']), array('escape' => false , 'class' => 'nav-link'));
            echo '</li>';
            echo '<li class="nav-item">';
            echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-shopping-cart')).' Carrinho', array('controller' => 'pages', 'action' => 'carrinho?'.$_SESSION['Auth']['User']['id']), array('escape' => false , 'class' => 'nav-link'));
            echo '</li>';
            echo '<li class="nav-item">';
            echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-sign-out-alt')).' Sair', array('controller' => 'users', 'action' => 'logout'), array('escape' => false , 'class' => 'nav-link'));
            echo '</li>';
        }else{
            echo '<li class="nav-item">';
            echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-sign-in-alt')).' Entrar', array('controller' => 'users', 'action' => 'login'), array('escape' => false , 'class' => 'nav-link'));
        echo '</li>';
        }
        echo '</div>';
        echo '</div>';
        echo '</nav>';
    }

}