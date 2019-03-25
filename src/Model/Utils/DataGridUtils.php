<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 * @var \App\View\AppView $this
 */

namespace App\Model\Utils;


use Cake\Datasource\Paginator;
use Cake\View\View;

/**
 * Class DataGridUtils
 * @package App\Model\Utils
 * @deprecated
 * Usar DataGridGenerator and GridField
 */
class DataGridUtils extends View
{
    //Para campos de tipo numerico
    const TYPE_NUMBER = 0;

    //Para campos de tipo de texto
    const TYPE_TEXT = 1;

    //Para campos booleanos/ Verdadeiro e Falso/ Sim e Nao
    const TYPE_BOOLEAN = 2;

    //Para campos data
    const TYPE_DATE = 3;

    //Para campos data e hora
    const TYPE_DATE_TIME = 4;

    //Para campos User cliente/Admin
    const TYPE_USER = 5;

    //Para campos que tem-se de retorno um josn
    const TYPE_JSON = 6;

    //Para campos que temos uma lista de possibilidades.

    const TYPE_LIST = 7;

    const TYPE_WIDTH_PX = 1;
    const TYPE_WIDTH_PORCENT = 2;

    /** Contem o array com todos o models */
    protected $model;

    /** Contem o array com todos os campos que serao mostrados */
    protected $fields = [];

    protected $debbugMode = false;

    /** Contem o o bloqueio de acoes */
    protected $noEdit = false;
    protected $noAdd = false;
    protected $noView = false;
    protected $noDelete = false;

    protected $widths = [];

    protected $idRow;

    /** @var $paginator Paginator */
    protected $paginator;
    /** Define se escondemos ou nao as acoes contidas nas linhas*/
    protected $hiddenActionsColumn = false;

    /** Ações no topo da consulta */
    protected $actions = [];

    /** Ações na linha para a consulta */
    protected $actionsTable = [];

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    public function bloqActionEdit()
    {
        $this->noEdit = true;
    }

    public function bloqActionAdd()
    {
        $this->noAdd = true;
    }

    public function bloqActionView()
    {
        $this->noView = true;
    }

    public function bloqActionDelete()
    {
        $this->noDelete = true;
    }

    public function hiddeActionsRows()
    {
        $this->hiddenActionsColumn = true;
    }

    public function alterWidth($path, $width, $typeWidth = self::TYPE_WIDTH_PX){
        $format = 'px';
        if($typeWidth == self::TYPE_WIDTH_PORCENT){
            $format = '%';
        }
       $this->widths[$path] = $width.''.$format;
    }

    /**
     * @param mixed $paginator
     */
    public function setPaginator($paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * @return mixed
     */
    public function getIdRow()
    {
        return $this->idRow;
    }

    /**
     * @param mixed $idRow
     */
    public function setIdRow($idRow)
    {
        $this->idRow = $idRow;
    }



    /**
     * @param array $fields
     * $list deve ser usado quando temos um campo TYPE_LIST, e a lista deve seguir o padrão:
     *
     * $arrayList = ['valor_que_identifica_obejto' => 'Mostraremos este valor para quando ser aceitavel o condicional'];
     * $arrayList = ['tipo_produto' => 'PRODUTO', 'tipo_item' => 'ITEM', 'tipo_bem' => 'BEM'];
     *
     */
    public function addField($titulo, $path, $type, $list = null, $filter = false)
    {
        $this->fields[] = ['titulo' => $titulo, 'path' => $path, 'type' => $type, 'list' => $list, 'filter'];
    }

    /**
     * @param array $fields
     */
    public function addAction($controller, $action, $titulo, $class = 'btn btn-primary')
    {
        $this->actions[] = ['titulo' => $titulo, 'action' => $action, 'controller' => $controller, 'class' => $class];
    }

    /**
     * @param array $fields
     */
    public function addActionRow($title, $url = null, array $options = [], $isPostLink = false, $paramIdentificador)
    {
        $this->actionsTable[] = ['titulo' => $title, 'url' => $url, 'options' => $options, 'isPost' => $isPostLink, 'id' => $paramIdentificador];
    }

    /** Ajudantes para visualizacao das informacoes que compoem a table
     * - active and disable debbug mode
     */
    public function activeDebuggMode()
    {
        $this->debbugMode = true;
    }

    public function disableDebuggMode()
    {
        $this->debbugMode = false;
    }

    public function display()
    {
        if ($this->debbugMode) {
            echo 'MODEL TABLE CONTENT TO RENDER FIELDS:';
            var_dump($this->model);
            echo 'ACTIONS ADDED AT THE TOP OF THE TABLE:';
            var_dump($this->actionsTable);
            echo 'DIRECT ACTIONS FOR THE TABLE LINES:';
            var_dump($this->actions);
        }
        ?>
        <?php if (!$this->noAdd) { ?>
        <?= $this->Html->link('Adicionar', ['action' => 'add'], array('class' => 'btn btn-primary')); ?>
    <?php } ?>
        <?php foreach ($this->actions as $action) { ?>
        <?= $this->Html->link($action['titulo'], ['controller' => $action['controller'], 'action' => $action['action']], ['class' => $action['class']]) ?>
    <?php } ?>
        <?php
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<table cellpadding="0" cellspacing="0">';
        echo '<colgroup>';
        foreach ($this->fields as $col) {
            if($this->widths[$col['path']]){
                echo '<col width="'.$this->widths[$col['path']].'">';
            }else{
                echo '<col width="auto">';
            }
        }
        echo '</colgroup>';
        echo '<thead>';
        foreach ($this->fields as $th) {
            echo '<th scope="col"><span>' . $th['titulo'] . '</span></th>';
        }
        if (!$this->hiddenActionsColumn) {
            echo '<th scope="col" class="actions"> Ações </th>';
        }
        echo '</thead>';
        echo '<tbody>';
        foreach ($this->model as $entidade) {
            $this->setIdRow($entidade['id']);
            echo '<tr>';
            foreach ($this->fields as $td) {
                $entidadeWithPath = '';
                $parts = explode('/', $td['path'], 100);
                if ($parts) {
                    if (count($parts) == 1) {
                        $entidadeWithPath = $entidade[$parts[0]];
                    }
                    if (count($parts) == 2) {
                        $entidadeWithPath = $entidade[$parts[0]][$parts[1]];
                    }
                    if (count($parts) == 3) {
                        $entidadeWithPath = $entidade[$parts[0]][$parts[1]][$parts[2]];
                    }
                    if (count($parts) == 4) {
                        $entidadeWithPath = $entidade[$parts[0]][$parts[1]][$parts[2]][$parts[3]];;
                    }
                    if (count($parts) == 5) {
                        $entidadeWithPath = $entidade[$parts[0]][$parts[1]][$parts[2]][$parts[3]][$parts[4]];;
                    }
                }
                if ($td['type'] == self::TYPE_NUMBER) {
                    echo '<td>'; ?><?= $this->Number->format($entidadeWithPath) ?><?php echo '</td>';
                } else if ($td['type'] == self::TYPE_TEXT) {
                    echo '<td>'; ?><?= h($entidadeWithPath) ?><?php echo '</td>';
                } else if ($td['type'] == self::TYPE_BOOLEAN) {
                    echo '<td>';
                    if ($entidadeWithPath == 1) {
                        echo('Sim');
                    } else {
                        echo('Não');
                    }
                    echo '</td>';
                } else if ($td['type'] == self::TYPE_DATE) {
                    $d = new \DateTime($entidadeWithPath);
                    $timestamp = $d->getTimestamp();
                    $formatted_date = $d->format('d/m/Y');
                    echo '<td>'; ?><?= h($formatted_date) ?><?php echo '</td>';
                } else if ($td['type'] == self::TYPE_DATE_TIME) {
                    $d = new \DateTime($entidadeWithPath);
                    $timestamp = $d->getTimestamp();
                    $formatted_date = $d->format('d/m/Y H:i:s');
                    echo '<td>'; ?><?= h($formatted_date) ?><?php echo '</td>';
                } else if ($td['type'] == self::TYPE_USER) {
                    echo '<td>';
                    if ($entidadeWithPath == 1) {
                        echo('Cliente');
                    } else {
                        echo('Administrador');
                    }
                    echo '</td>';
                } else if ($td['type'] == self::TYPE_JSON) {
                    echo '<td>'; ?><?= h(json_encode($entidadeWithPath)) ?><?php echo '</td>';
                } else if ($td['type'] == self::TYPE_LIST) {
                    echo '<td>'; ?><?= h($td['list'][$entidadeWithPath]) ?><?php echo '</td>';
                }
            }
            if (!$this->hiddenActionsColumn) {
                echo '<td class="actions">';
                ?>
                <?php if (!$this->noView) { ?>
                    <?= $this->Html->link(__(''), ['action' => 'view', $entidade->id], ['class' => 'fas fa-eye btn btn-info btn-sm', 'title' => 'Visualizar']) ?>
                <?php } ?>

                <?php if (!$this->noEdit) { ?>
                    <?= $this->Html->link(__(''), ['action' => 'edit', $entidade->id], ['class' => 'far fa-edit btn btn-success btn-sm', 'title' => 'Editar']) ?>
                <?php } ?>

                <?php if (!$this->noDelete) { ?>
                    <?= $this->Form->postLink(__(''), ['action' => 'delete', $entidade->id], ['class' => 'fas fa-trash-alt btn btn-danger btn-sm', 'title' => 'Excluir', 'confirm' => __('Tem certeza que deseja excluir este registro?')]) ?>
                <?php } ?>
                <?php foreach ($this->actionsTable as $actionTable) {
                    if($actionTable['id']){
                        $actionTable['url'][] = $entidade[$actionTable['id']];
                    }
                    if (!$actionTable['isPost']) {
                        ?>
                        <?= $this->Html->link($actionTable['titulo'], $actionTable['url'], $actionTable['options']) ?>
                    <?php } else {
                        ?>
                        <?= $this->Form->postLink($actionTable['titulo'], $actionTable['url'], $actionTable['options']) ?>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
            <?php
            echo '</td>';
            echo '</tr>';
        }
        //Utilizacao do paginator padrao do cakephp.
        //Para melhor visualizacao da consulta sugiro adicionar  $this->paginate['limit'] = 10; em AppController -> function beforeFilter(){}
        //Para limitar a exibicao de 10 registros por pagina, ja que o padrao e 20.
        echo '<tbody>';
        echo '</table>';
        echo '<div class="paginator">';
        echo '<ul class="pagination">';
        echo $this->paginator->first(__('<< '));
        echo $this->paginator->prev(__('<'));
        echo $this->paginator->numbers();
        echo $this->paginator->next(__('>'));
        echo $this->paginator->last(__('>>'));
        echo '</ul>';
        echo '<p>';
        echo $this->paginator->counter(['format' => __('Página {{page}} de {{pages}}, Exibindo {{current}} registro(s) de {{count}}')]);
        echo '</p>';
        echo '</div>';
    }
}

?>