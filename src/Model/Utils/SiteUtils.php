<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

namespace App\Model\Utils;


use App\Controller\AppController;
use App\Controller\LogsController;
use App\Model\Entity\CategoriasProduto;
use App\Model\Entity\Log;
use App\Model\Entity\Pedido;
use App\Model\Entity\PedidosProduto;
use App\Model\Entity\Produto;
use App\View\AppView;
use Cake\Datasource\ConnectionManager;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\View\Helper\HtmlHelper;

class SiteUtils extends AppController
{
    protected $Html;

    private static $dontImportAdminScripts;

    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, \Cake\Event\EventManager $eventManager = null, ComponentRegistry $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $appView = new AppView();
        $this->Html = new HtmlHelper($appView, []);
    }

    /**
     * @return mixed
     */
    public static function getDontImportAdminScripts()
    {
        return self::$dontImportAdminScripts;
    }

    /**
     * @param mixed $dontImportAdminScripts
     */
    public static function setDontImportAdminScripts($dontImportAdminScripts)
    {
        self::$dontImportAdminScripts = $dontImportAdminScripts;
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
        $anos[$anoHomologacao] = $anoHomologacao;
        $anoAtual = $anoHomologacao;
        $diferenca = (intval($date) - $anoAtual);
        for ($i = 0; $i < $diferenca; $i++) {
            $anos[$anoAtual+1] = $anoAtual + 1;
            $anoAtual += 1;
        }
        return $anos;
    }

    public static function getColorGraphs(){
        return [
            '#4e73df',
            '#4edf95',
            '#cff114',
            '#28a745',
            '#17a2b8',
            '#dc3545',
            '#FF4500',
            '#006400',
            '#7FFFD4',
            '#4169E1',
            '#EE82EE',
        ];
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
        echo $this->Html->css('banner.css' . $cacheVersion);
        echo $this->Html->css('bootstrap.css' . $cacheVersion);
        echo $this->Html->css('font-awesome-all.css' . $cacheVersion);
        echo $this->Html->css('bootstrap-select.css' . $cacheVersion);
        echo $this->Html->css('bloq.css'. $cacheVersion);
        echo $this->Html->script('jquery.js' . $cacheVersion);
        echo $this->Html->script('popper.js' . $cacheVersion);
        echo $this->Html->script('jquery-mask.min.js' . $cacheVersion);
        echo $this->Html->script('angular.js' . $cacheVersion);
        echo $this->Html->script('bootstrap.js' . $cacheVersion);
        // echo $this->Html->script('font-awesome-all.js'.$cacheVersion);
        echo $this->Html->script('bootstrap-select.js' . $cacheVersion);
        echo $this->Html->script('site-utils.js' . $cacheVersion);
        echo $this->Html->script('masks.js' . $cacheVersion);
    }

    public function createQuadrosKanbanPedidosProdutos(PedidosProduto $pedidosProduto)
    {
        $tipo = 'Pedido';
        if ($pedidosProduto->pedido->tipo_pedido == Pedido::TIPO_PEDIDO_COMANDA) {
            $tipo = 'Comanda';
        }
        echo '<article class="kanban-entry grab" id="' . $pedidosProduto->id . '" draggable="true">
                  <div class="kanban-entry-inner">
                      <div class="kanban-label">
                          <h2><a href="#">#Item: ' . $pedidosProduto->id . '</a> <span>#' . $tipo . ': ' . $pedidosProduto->pedido_id . '</span></h2>
                          <p>Produto: ' . $pedidosProduto->produto->nome_produto . '</p>
                          <p>Quantidade: ' . $pedidosProduto->quantidade . '</p>
                          <p>Produzidos: ' . $pedidosProduto->quantidade_produzida . '</p>
                          <p>Observação: ' . $pedidosProduto->observacao . '</p>
                          <br/>
                          ' . $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')) . '', array('controller' => 'PedidosProdutos', 'action' => 'view', $pedidosProduto->id), array('escape' => false, 'class' => 'btn btn-sm btn-info')) . '
                          ' . $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-exchange-alt')) . ' Quantidade Produzida', array('controller' => 'PedidosProdutos', 'action' => 'quantidadeProduzida', $pedidosProduto->id), array('escape' => false, 'class' => 'btn btn-sm btn-danger')) . '
                      </div>
                  </div>
              </article>';
    }

    public final function mensagemLogarParaComprar()
    {
        echo '<div style="padding-left: 10px!important; padding-right: 10px!important;" class="row">
            <div style="width: 100%" class="alert alert-info">
                <h4 style="">Para poder adicionar ao seu carrinho, por favor entre com sua conta! ' . $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-sign-in-alt')) . ' Entre Agora', array('controller' => 'Users', 'action' => 'login'), array('escape' => false, 'class' => '')) . '</h4>
            </div>
        </div>';
    }

    public final function mensagemPedidoAberto()
    {
        echo '<div style="padding-left: 10px!important; padding-right: 10px!important;" class="row">
               <div style="width: 100%" class="alert alert-info">
                <h4>Você possui pedidos aguardando sua confirmação ou cancelamento, certifique-se de concluir primeiro este pedido antes de iniciar um novo!' . $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-shopping-basket')) . ' Ver Pedido', array('controller' => 'pages', 'action' => 'confirmar'), array('escape' => false, 'class' => '')) . '</h4>
                </div>
              </div>';
    }

    public final function mensagemEmpresaFechada()
    {
        echo '<div style="padding-left: 10px!important; padding-right: 10px!important;" class="row">
                  <div style="width: 100%" class="alert alert-danger">
                      <h4>Olá, ainda não estamos abertos, ou seja não é possível realizar pedidos novos  <i class="fas fa-sad-cry fa-2x"></i></h4>
                  </div>
              </div>';
    }

    public final function createFormAdicionarProduto($setUser = false, $diretoAoPedido = false)
    {
        $empresaUtils = new EmpresaUtils();
        $utilsPedido = new SiteUtilsPedido();
        $user = false;
        if ($setUser) {
            $user = $empresaUtils->getUserId();
        }
        echo '<button id="openModal" style="display: none" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false">Abre</button>';
        echo '<div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo '<div class="modal-dialog" role="document">';
        echo '<div style="min-height: 95%" class="modal-content">';
        echo '<div class="modal-header">';

        if ($empresaUtils->getUserId() && $utilsPedido->empresaAberta()) {
            echo '<h5 class="modal-title" id="exampleModalLabel">Adicionar ao carrinho</h5>';
        } else {
            echo '<h5 class="modal-title" id="exampleModalLabel">Visualizar Produto</h5>';
        }
        echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        echo '</div>';
        echo '<div class="modal-body">';
        echo '<div class="tab">';
        echo '<button id="initialTabModal" class="tablinks" onclick="openTab(event, \'geral\')">Geral</button>';
        echo '<button id="opcoesTabModal" class="tablinks" onclick="openTab(event, \'opcoes\')">Opções</button>';
        echo '</div>';
        echo '<div id="geral" class="tabcontent">
                        <div class="form-horizontal">
                            <div style="display: none" class="form-group">
                                <label for="exampleFormControlInput1">#Produto</label>
                                <input type="text" readonly class="form-control" id="idProduto">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Produto</label>
                                <input type="text" readonly class="form-control" id="nomeProduto">
                            </div>
                            <div style="display: none" class="form-group">
                                <label for="exampleFormControlInput1">Preço Produto Original</label>
                                <input type="text" readonly class="form-control" id="precoProdutoOriginal">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Preço</label>
                                <input type="text" readonly class="form-control" id="precoProduto">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Descrição</label>
                                <textarea class="form-control" readonly id="descricaoProduto" rows="2"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Quantidade</label>
                                <input class="form-control" type="number" onkeyup="verificaQuantidadeIsInt(event)" id="quantidadeProduto" min="1" max="100" step="1" value="1">
                            </div>';
        if ($empresaUtils->getUserId() && $utilsPedido->empresaAberta()) {
            echo '<div class="form-group">
                    <label for="exampleFormControlTextarea1">Observação</label>
                    <textarea placeholder="Digite observações, por exemplo, retirar pepino." class="form-control" id="observacaoDigitada" rows="2"></textarea>
                  </div>';
        }
        echo '</div>';
        echo '</div>';
        echo '<div id="opcoes" class="tabcontent">
                        <div id="contentOptions">
                        <!--      SERVE PARA PODER APENDAR A LISTAS CRIADAS DOS PRODUTOS        -->
                        </div>
                    </div>';
        echo '</div>';
        if ($empresaUtils->getUserId() && $utilsPedido->empresaAberta()) {
            if (!$diretoAoPedido) {
                echo '<div class="modal-footer">
                        <button type="button" id="closeModal" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" onclick="addItemToCart(' . $user . ')" class="btn btn-primary">Confirmar</button>
                    </div>';
            } else {
                echo '<div class="modal-footer">
                        <button type="button" id="closeModal" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" onclick="addItemToPedido(' . $diretoAoPedido . ')" class="btn btn-primary">Confirmar</button>
                    </div>';
            }
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function montaContatos($contatos){
        $iconsContato = \App\Model\Entity\Empresa::getTipoContatoIconList();
        foreach ($contatos as $contato) {
            switch ($contato['tipo_contato']){
                case \App\Model\Entity\Empresa::TIPO_CONTATO_FACEBOOK:
                    ?> <h5><a target="_blank" href="https://<?= $contato['valor_contato']?>"><i class="<?= $iconsContato[$contato['tipo_contato']]?>"></i> <?= $contato['valor_contato']?></a></h5><?php
                    break;
                case \App\Model\Entity\Empresa::TIPO_CONTATO_TELEFONE:
                    ?> <h5><i class="<?= $iconsContato[$contato['tipo_contato']]?>"></i> <?= $contato['valor_contato']?></h5><?php
                    break;
                case \App\Model\Entity\Empresa::TIPO_CONTATO_EMAIL:
                    ?> <h5><a target="_blank" href="mailto:<?=$contato['valor_contato']?>"><i class="<?= $iconsContato[$contato['tipo_contato']]?>"></i> <?= $contato['valor_contato']?></a></h5><?php
                    break;
                case \App\Model\Entity\Empresa::TIPO_CONTATO_WPP:
                    ?> <h5><a target="_blank" href="https://wa.me/55<?= preg_replace("/[^0-9]/", "", $contato['valor_contato'])?>?text=Olá,%20poderia%20me%20tirar%20uma%20dúvida?"><i class="<?= $iconsContato[$contato['tipo_contato']]?>"></i> <?= $contato['valor_contato']?></a></h5><?php
                    break;
            }
        }
    }

    public final function createProdutosCategoria($categoria, $showStars = true, $isAdmin = false, $showFoto = true, $titleButtonComprar = false, $ambienteVenda = Produto::VENDA_DELIVERY)
    {
        if (!$titleButtonComprar) {
            $titleButtonComprar = 'Comprar';
        }
        $siteUtilsPedido = new SiteUtilsPedido();
        $condicao = ['ativo_produto' => true];
        if ($categoria) {
            $condicao['categorias_produto_id'] = intval($categoria);
        }
        $condicao['ambiente_venda in'] = [$ambienteVenda, Produto::VENDA_AMBOS];
        $produtos = $this->getTableLocator()->get('Produtos')->find()->where($condicao);
        $produtoscount = 0;
        foreach ($produtos as $produto) {
            echo '<div style="cursor: pointer!important;" class="col-lg-3 col-md-4 col-sm-6 portfolio-item">';
            echo '<div class="card" style="margin-bottom: 5px">';
            if ($showFoto) {
                $midiaTable = $this->getTableLocator()->get('Midias');
                $existMidia = $midiaTable->find();
                $existMidia->where(['id' => $produto->midia_id]);
                /** @var $existMidia \App\Model\Entity\Midia */
                $existMidia = $existMidia->first();
                echo '<a onclick="openModalAddCart(' . $produto->id . ',' . $isAdmin . ')">';
                if ($existMidia !== null) {
                    echo $this->Html->image($existMidia->path_midia, ['class' => 'img-fluid']);
                } else {
                    echo $this->Html->image(EmpresaUtils::IMAGE_PADRAO_PRODUTOS_SEM_IMAGEM, ['class' => 'img-fluid']);
                }
                echo '</a>';
            }
            echo '<div onclick="openModalAddCart(' . $produto->id . ',' . $isAdmin . ')" class="card-body">';
            echo '<h4 class="card-title">';
            echo '<span>' . $produto->nome_produto . '</span>';
            echo '<br/>';
            echo '<span>R$' . $produto->preco_produto . '</span>';
            echo '</h4>';
            echo '<p style="height: 120px; overflow-y: auto; overflow-x: hidden;" class="card-text">' . $produto->descricao_produto . '</p>';
            echo '</div>';
            echo '<div class="card-footer">';
            if ($this->Auth->user('id') && $siteUtilsPedido->empresaAberta()) {
                echo '<button title="Adicionar ao carrinho" class="btn btn-sm btn-success" style="width: 45%" onclick="openModalAddCart(' . $produto->id . ',' . $isAdmin . ')"> <i class="fas fa-cart-plus"></i> ' . $titleButtonComprar . ' <i style="display: none" id="loading-' . $produto->id . '" class="fa fa-spinner fa-spin"></i> </button>';
            } else {
                echo '<button title="Adicionar ao carrinho" disabled class="btn btn-sm btn-success" style="width: 45%"><i class="fas fa-cart-plus"></i> ' . $titleButtonComprar . ' <i style="display: none" id="loading-' . $produto->id . '" class="fa fa-spinner fa-spin"></i> </button>';
            }
            if ($showStars) {
                echo '<a style="text-decoration-line: none;color: black; margin-left: 5px;" title="Avaliar Produto" href="../ProdutosAvaliacoes/listAvaliacoes/' . $produto->id . '">';
                echo '<i class="far fa-clipboard"></i>&nbsp;';
                $this->getStarsProduto($produto->id);
                echo '</a>';
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
            $produtoscount++;
        }
        if ($produtoscount < 1) {
            echo '<div style="width: 100%" class="alert alert-danger" role="alert"> <i class="far fa-grin-beam-sweat fa-3x" style="color: #000000"></i>&nbsp;<span>Está categoria ainda não possui nenhum item cadastrado, mas não deixe de visitar para encontrar novidades!</span></div>';
        }
        echo '</div>';
        echo '<br>';
    }

    public final function menuAdmin($menus)
    {
        echo '<div class="nav-side-menu">';
        echo '<a href="/pages/blank" class="brand">LADelivery</a>';
        echo '<i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>';
        echo '<i class="fa fa-bars fa-fw toggle-btn-pc" onclick="closeMenu()"></i>';
        echo '<div class="menu-list">';
        echo '<ul id="menu-content" class="menu-content collapse out">';
        foreach ($menus as $key => $menu) {
            echo '<li data-toggle="collapse" data-target="#' . $key . '" class="collapsed">';
            echo '<a href="#"><i class="' . $menu['icon'] . '"></i> ' . $menu['nome'] . '</a>';
            echo '</li>';
            echo '<ul class="sub-menu collapse" id="' . $key . '">';
            foreach ($menu['childrens'] as $children) {
                echo '<li>' . $this->Html->link(__($children['nome']), ['controller' => $children['controller'], 'action' => $children['action']]) . '</li>';
            }
            echo '</ul>';
        }
        echo '</ul>';
        echo '</div>';
        echo '</div>';
    }

    public final function menuSitePretty(){

    }

    public final function menuSite()
    {
        $userId = $this->Auth->user('id');
        /** @var $categorias CategoriasProduto[] */
        $categorias = $this->getTableLocator()->get('CategoriasProdutos')->find();
        $itensCarrinhos = $this->getTableLocator()->get('ItensCarrinhos')->find()->where(['user_id' => $this->Auth->user('id')])->count();
        $notificacoes = $this->getTableLocator()->get('Logs')->find()->where(['user_id' => $this->Auth->user('id'), 'situacao' => Log::SITUACAO_PENDENTE])->count();
        echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">';
        echo $this->Html->link(
            $this->Html->image( EmpresaUtils::IMAGE_SITE_PATH ,array('height' => '30', 'width' => '30')). ' '.EmpresaUtils::NOME_EMPRESA_LOJA,
            [
                'controller' => 'pages',
                'action' => ''
            ],
            [
                'class' => 'navbar-brand',
                'escape' => false
            ]
        );
        echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>';
        echo '<div class="collapse navbar-collapse" id="navbarResponsive">';
        echo '<ul class="navbar-nav ml-auto">';
        echo '<li class="nav-item active">';
        echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-home')) . ' Início', array('controller' => 'pages', 'action' => ''), array('escape' => false, 'class' => 'nav-link'));
        echo '</li>';
        echo '<li class="dropdown nav-item active">';
        echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-utensils')) . ' Produtos', '#', array('escape' => false, 'class' => 'nav-link dropdown-toggle'));
        echo '<div class="dropdown-menu menu-site">';
        foreach ($categorias as $categoria) {
            echo $this->Html->link($this->Html->tag('i', '', array('class' => '')) . ' ' . $categoria->nome_categoria, array('controller' => 'pages', 'action' => 'produtos?categoria=' . $categoria->id . '&categoriaNome=' . $categoria->nome_categoria), array('escape' => false, 'class' => 'dropdown-item menu-site-item'));
        }
        echo $this->Html->link($this->Html->tag('i', '', array('class' => '')) . ' Todas Categorias', array('controller' => 'pages', 'action' => 'categorias'), array('escape' => false, 'class' => 'dropdown-item menu-site-item'));
        echo '</div>';
        echo '</li>';
        echo '<li class="nav-item active">';
        echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-address-card')) . ' Sobre Nós', array('controller' => 'pages', 'action' => 'empresa'), array('escape' => false, 'class' => 'nav-link'));
        echo '</li>';
        if ($this->Auth->user('id')) {
            echo '<li class="nav-item active">';
            echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-bell')) . ' Notificações' . $this->Html->tag('div', $notificacoes, array('class' => 'icon-notify-number')), array('controller' => 'pages', 'action' => 'notificacao'), array('escape' => false, 'class' => 'nav-link'));
            echo '</li>';
            echo '<li class="nav-item active">';
            echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-user-circle')) . ' Minha Conta', array('controller' => 'users', 'action' => 'profile'), array('escape' => false, 'class' => 'nav-link'));
            echo '</li>';
            echo '<li class="nav-item active">';
            echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-shopping-cart')) . ' Carrinho' . $this->Html->tag('div', $itensCarrinhos, array('class' => 'icon-cart-number')), array('controller' => 'pages', 'action' => 'carrinho'), array('escape' => false, 'class' => 'nav-link'));
            echo '</li>';
            echo '<li class="nav-item active">';
            echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-sign-out-alt')) . ' Sair', array('controller' => 'users', 'action' => 'logout'), array('escape' => false, 'class' => 'nav-link'));
            echo '</li>';
        } else {
            echo '<li class="nav-item active">';
            echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fas fa-sign-in-alt')) . ' Entrar', array('controller' => 'users', 'action' => 'login'), array('escape' => false, 'class' => 'nav-link'));
            echo '</li>';
        }
        echo '</div>';
        echo '</nav>';
    }

    public function createStatusPedido(Pedido $pedido, $showLegends = true)
    {
        $entrega = $pedido->getEntrega();
        if ($entrega) {
            $this->createStatusEntrega($pedido);
            if ($showLegends) {
                $this->createLegendsEntrega($pedido);
            }
        } else {
            $this->createStatusColeta($pedido);
            if ($showLegends) {
                $this->createLegendsColeta($pedido);
            }
        }
    }

    private function createStatusEntrega(Pedido $pedido)
    {
        switch ($pedido->status_pedido) {
            case Pedido::STATUS_AGUARDANDO_CONFIRMACAO_EMPRESA:
                echo '<div class="container width-vinte">
                          <ul class="progressbar">
                              <li class="active atual"><i class="fas fa-hourglass-half fa-2x"></i></li>
                              <li><i class="fas fa-pizza-slice fa-2x"></i></li>
                              <li><i class="fas fa-motorcycle fa-2x"></i></li>
                              <li><i class="fas fa-route fa-2x"></i></li>
                              <li><i class="far fa-smile-beam fa-2x"></i></li>
                          </ul>
                      </div>';
                break;
            case Pedido::STATUS_REJEITADO:
                echo '<div class="container">
                          <ul class="progressbar width-vinte">
                              <li class="active danger"><i class="far fa-times-circle fa-2x"></i></li>
                              <li><i class="fas fa-pizza-slice fa-2x"></i></li>
                              <li><i class="fas fa-motorcycle fa-2x"></i></li>
                              <li><i class="fas fa-route fa-2x"></i></li>
                              <li><i class="far fa-smile-beam fa-2x"></i></li>
                          </ul>
                      </div>';
                break;
            case Pedido::STATUS_EM_PRODUCAO:
                echo '<div class="container">
                          <ul class="progressbar width-vinte">
                              <li class="active"><i class="fas fa-hourglass-half fa-2x"></i></li>
                              <li class="active atual"><i class="fas fa-pizza-slice fa-2x"></i></li>
                              <li><i class="fas fa-motorcycle fa-2x"></i></li>
                              <li><i class="fas fa-route fa-2x"></i></li>
                              <li><i class="far fa-smile-beam fa-2x"></i></li>
                          </ul>
                      </div>';
                break;
            case Pedido::STATUS_AGUARDANDO_ENTREGADOR:
                echo '<div class="container">
                          <ul class="progressbar width-vinte">
                              <li class="active"><i class="fas fa-hourglass-half fa-2x"></i></li>
                              <li class="active"><i class="fas fa-pizza-slice fa-2x"></i></li>
                              <li class="active atual"><i class="fas fa-motorcycle fa-2x"></i></li>
                              <li><i class="fas fa-route fa-2x"></i></li>
                              <li><i class="far fa-smile-beam fa-2x"></i></li>
                          </ul>
                      </div>';
                break;
            case Pedido::STATUS_SAIU_PARA_ENTREGA:
                echo '<div class="container">
                          <ul class="progressbar width-vinte">
                              <li class="active"><i class="fas fa-hourglass-half fa-2x"></i></li>
                              <li class="active"><i class="fas fa-pizza-slice fa-2x"></i></li>
                              <li class="active"><i class="fas fa-motorcycle fa-2x"></i></li>
                              <li class="active atual"><i class="fas fa-route fa-2x"></i></li>
                              <li><i class="far fa-smile-beam fa-2x"></i></li>
                          </ul>
                      </div>';
                break;
            case Pedido::STATUS_ENTREGUE:
                echo '<div class="container">
                          <ul class="progressbar width-vinte">
                              <li class="active"><i class="fas fa-hourglass-half fa-2x"></i></li>
                              <li class="active"><i class="fas fa-pizza-slice fa-2x"></i></li>
                              <li class="active"><i class="fas fa-motorcycle fa-2x"></i></li>
                              <li class="active"><i class="fas fa-route fa-2x"></i></li>
                              <li class="active atual"><i class="far fa-smile-beam fa-2x"></i></li>
                          </ul>
                      </div>';
                break;
        }
    }

    private function createStatusColeta(Pedido $pedido)
    {
        switch ($pedido->status_pedido) {
            case Pedido::STATUS_AGUARDANDO_CONFIRMACAO_EMPRESA:
                echo '<div class="container">
                          <ul class="progressbar">
                              <li class="active atual"><i class="fas fa-hourglass-half fa-2x"></i></li>
                              <li><i class="fas fa-pizza-slice fa-2x"></i></li>
                              <li><i class="fas fa-hand-holding-heart fa-2x"></i></li>
                              <li><i class="far fa-smile-beam fa-2x"></i></li>
                          </ul>
                      </div>';
                break;
            case Pedido::STATUS_REJEITADO:
                echo '<div class="container">
                          <ul class="progressbar">
                              <li class="active danger"><i class="far fa-times-circle fa-2x"></i></li>
                              <li><i class="fas fa-pizza-slice fa-2x"></i></li>
                              <li><i class="fas fa-hand-holding-heart fa-2x"></i></li>
                              <li><i class="far fa-smile-beam fa-2x"></i></li>
                          </ul>
                      </div>';
                break;
            case Pedido::STATUS_EM_PRODUCAO:
                echo '<div class="container">
                          <ul class="progressbar">
                              <li class="active"><i class="fas fa-hourglass-half fa-2x"></i></li>
                              <li class="active atual"><i class="fas fa-pizza-slice fa-2x"></i></li>
                              <li><i class="fas fa-hand-holding-heart fa-2x"></i></li>
                              <li><i class="far fa-smile-beam fa-2x"></i></li>
                          </ul>
                      </div>';
                break;
            case Pedido::STATUS_AGUARDANDO_COLETA_CLIENTE:
                echo '<div class="container">
                          <ul class="progressbar">
                              <li class="active"><i class="fas fa-hourglass-half fa-2x"></i></li>
                              <li class="active"><i class="fas fa-pizza-slice fa-2x"></i></li>
                              <li class="active atual"><i class="fas fa-hand-holding-heart fa-2x"></i></li>
                              <li><i class="far fa-smile-beam fa-2x"></i></li>
                          </ul>
                      </div>';
                break;
            case Pedido::STATUS_ENTREGUE:
                echo '<div class="container">
                          <ul class="progressbar">
                              <li class="active"><i class="fas fa-hourglass-half fa-2x"></i></li>
                              <li class="active"><i class="fas fa-pizza-slice fa-2x"></i></li>
                              <li class="active"><i class="fas fa-hand-holding-heart fa-2x"></i></li>
                              <li class="active atual"><i class="far fa-smile-beam fa-2x"></i></li>
                          </ul>
                      </div>';
                break;

        }
    }

    private function createProgressEntrega(Pedido $pedido)
    {
        echo '<div class="col-sm-12">';
        switch ($pedido->status_pedido) {
            case Pedido::STATUS_AGUARDANDO_CONFIRMACAO_EMPRESA:
                echo '<div class="col-sm-12">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                 style="width: 20%"></div>
                        </div>
                    </div>';
                break;
            case Pedido::STATUS_REJEITADO:
                echo '<div class="col-sm-12">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                 style="width: 20%"></div>
                        </div>
                    </div>';
                break;
            case Pedido::STATUS_EM_PRODUCAO:
                echo '<div class="col-sm-12">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                 style="width: 40%"></div>
                        </div>
                    </div>';
                break;
            case Pedido::STATUS_AGUARDANDO_ENTREGADOR:
                echo '<div class="col-sm-12">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                 style="width: 60%"></div>
                        </div>
                    </div>';
                break;
            case Pedido::STATUS_SAIU_PARA_ENTREGA:
                echo '<div class="col-sm-12">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                 style="width: 80%"></div>
                        </div>
                    </div>';
                break;
            case Pedido::STATUS_ENTREGUE:
                echo '<div class="col-sm-12">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                 style="width: 100%"></div>
                        </div>
                    </div>';
                break;
        }
        echo '</div>';
    }

    private function createLegendsEntrega(Pedido $pedido)
    {
        if ($pedido->status_pedido == Pedido::STATUS_REJEITADO){
            $this->createMessagePedidoRejeitado($pedido);
        }else{
            echo '<div class="col-sm-12 alert">
            <div class="form-group '.$this->addClassActive($pedido, Pedido::STATUS_AGUARDANDO_CONFIRMACAO_EMPRESA).'">
                <b><i class="fas fa-hourglass-half fa-fw"></i></b> Seu pedido foi enviado para a empresa e está aguardando a confirmação de produção.
            </div>
            <div class="form-group '.$this->addClassActive($pedido, Pedido::STATUS_EM_PRODUCAO).'">
                <b><i class="fas fa-pizza-slice fa-fw"></i></b> Seu pedido foi aceito pela empresa e está em produção.
            </div>
            <div class="form-group '.$this->addClassActive($pedido, Pedido::STATUS_AGUARDANDO_ENTREGADOR).'">
                <b><i class="fas fa-motorcycle fa-fw"></i></b> Seu pedido foi totalmente produzido e está aguardando um dos entregadores busca-lo para entregar à você.
            </div>
            <div class="form-group '.$this->addClassActive($pedido, Pedido::STATUS_SAIU_PARA_ENTREGA).'">
                <b><i class="fas fa-route fa-fw"></i></b> Seu pedido foi coletado pelo entregador e está indo em direção ao endereço de entrega.
            </div>
            <div class="form-group '.$this->addClassActive($pedido, Pedido::STATUS_ENTREGUE).'">
                <b><i class="far fa-smile-beam fa-fw"></i></b> Seu pedido foi entregue.
            </div>
        </div>';
        }
    }

    private function createLegendsColeta(Pedido $pedido)
    {
        if ($pedido->status_pedido == Pedido::STATUS_REJEITADO){
            $this->createMessagePedidoRejeitado($pedido);
        }else{
            echo '<div class="col-sm-12 alert">
            <div class="form-group '.$this->addClassActive($pedido, Pedido::STATUS_AGUARDANDO_CONFIRMACAO_EMPRESA).'">
                <b><i class="fas fa-hourglass-half fa-fw"></i></b> Seu pedido foi enviado para a empresa e está aguardando a confirmação de produção.
            </div>
            <div class="form-group '.$this->addClassActive($pedido, Pedido::STATUS_EM_PRODUCAO).'">
                <b><i class="fas fa-pizza-slice fa-fw"></i></b> Seu pedido foi aceito pela empresa e está em produção.
            </div>
            <div class="form-group '.$this->addClassActive($pedido, Pedido::STATUS_AGUARDANDO_COLETA_CLIENTE).'">
                <b><i class="fas fa-hand-holding-heart fa-fw"></i></b> Seu pedido foi totalmente produzido e está aguardando você busca-lo na empresa.
            </div>
            <div class="form-group '.$this->addClassActive($pedido, Pedido::STATUS_ENTREGUE).'">
                <b><i class="far fa-smile-beam fa-fw"></i></b>&nbsp;Você já coletou seu pedido na empresa.
            </div>
        </div>';
        }
    }

    private function addClassActive(Pedido $pedido, $situacao){
        return ($pedido->status_pedido == $situacao) ? 'active-group': '';
    }

    private function createMessagePedidoRejeitado(Pedido $pedido){
        if($pedido->motivo_rejeicao){
            echo '<div class="alert alert-danger ">Seu pedido foi rejeitado pela empresa e não será mais produzido, o motivo da rejeição é: '.$pedido->motivo_rejeicao.'.</div>';
        }else{
            echo '<div class="alert alert-danger ">Seu pedido foi rejeitado pela empresa e não será mais produzido.</div>';
        }
    }

    public function countNewPedidos(){
        return $this->getTableLocator()->get('Pedidos')->find()->where(['status_pedido' => Pedido::STATUS_AGUARDANDO_CONFIRMACAO_EMPRESA])->count();
    }

}