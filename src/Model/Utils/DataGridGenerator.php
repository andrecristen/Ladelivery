<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

namespace App\Model\Utils;


use Cake\Datasource\Paginator;
use Cake\Event\EventManager;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\View\View;

class DataGridGenerator extends View implements TypeFields
{

    protected $filtersValues = [];


    protected $callBackActionLimpar = false;

    /** Contem o array com todos os campos que serao mostrados */
    /** @var GridField[] */
    protected $fields = [];

    /** Contem o array com todos o models */
    protected $model;

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

        echo '<div class="content-filter">';
        echo $this->Form->create(null, ['type' => 'get']);
        foreach ($this->fields as $field){
            if($field->getFilter()){
                if($field->getType() == self::TYPE_TEXT || $field->getType() == self::TYPE_NUMBER){
                    echo $this->Form->input($field->getAlias(), ['class' => 'form-control' , 'autocomplete' => 'off', 'label' => false,'placeholder' => 'Pesquisar '.$field->getTitulo(), 'value' => $this->request->getQuery($field->getAlias())]);
                }else{
                    if($field->getType() == self::TYPE_LIST){
                        $list[''] = 'Selecione uma opção';
                        foreach ($field->getList() as $key => $option){
                            $list[$key] = $option;
                        }
                        echo $this->Form->select($field->getAlias(), $list ,['label' => false, 'value' => $this->request->getQuery($field->getAlias())]);
                        echo '<br/>';
                    }else{
                        if($field->getType() == self::TYPE_BOOLEAN){
                            echo $this->Form->select($field->getAlias(), ['' => 'Selecione uma opção para o filtro '.$field->getTitulo(), 1 => 'Sim', 0 => 'Não'] ,['label' => false, 'value' => $this->request->getQuery($field->getAlias())]);
                        }
                    }
                }
            }
        }
        echo $this->Form->button('Pesquisar', ['class' => 'btn btn-sm btn-success']);
        if(!$this->getCallBackActionLimpar()){
            echo $this->Html->link('Limpar', ['action' => 'index'], ['class' => 'btn btn-sm btn-danger']);
        }else{
            echo $this->Html->link('Limpar', ['action' => $this->getCallBackActionLimpar()], ['class' => 'btn btn-sm btn-danger']);
        }
        echo $this->Form->end();
        echo '</div>';
        ?>
        <br>
        <?php if (!$this->noAdd) { ?>
        <?= $this->Html->link('Adicionar', ['action' => 'add'], array('class' => 'btn btn-primary')); ?>
    <?php } ?>
        <?php foreach ($this->actions as $action) { ?>
        <?= $this->Html->link($action['titulo'], ['controller' => $action['controller'], 'action' => $action['action']], ['class' => $action['class']]) ?>
    <?php } ?>
        <?php
        echo '<br/>';
        echo '<br/>';
        echo '<table cellpadding="0" cellspacing="0">';
        echo '<colgroup>';
        foreach ($this->fields as $col) {
            if($col->getWidth()){
                echo '<col width="'.$col->getWidth().'">';
            }else{
                echo '<col width="auto">';
            }
        }
        echo '</colgroup>';
        echo '<thead>';
        foreach ($this->fields as $th) {
            echo '<th scope="col"><span>' . $th->getTitulo() . '</span></th>';
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
                $parts = explode('/', $td->getPath(), 100);
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
                if ($td->getType() == self::TYPE_NUMBER) {
                    echo '<td>'; ?><?= $this->Number->format($entidadeWithPath) ?><?php echo '</td>';
                } else if ($td->getType() == self::TYPE_TEXT) {
                    echo '<td>'; ?><?= h($entidadeWithPath) ?><?php echo '</td>';
                } else if ($td->getType() == self::TYPE_BOOLEAN) {
                    echo '<td>';
                    if ($entidadeWithPath == 1) {
                        echo('Sim');
                    } else {
                        echo('Não');
                    }
                    echo '</td>';
                } else if ($td->getType() == self::TYPE_DATE) {
                    $d = new \DateTime($entidadeWithPath);
                    $timestamp = $d->getTimestamp();
                    $formatted_date = $d->format('d/m/Y');
                    echo '<td>'; ?><?= h($formatted_date) ?><?php echo '</td>';
                } else if ($td->getType() == self::TYPE_DATE_TIME) {
                    $d = new \DateTime($entidadeWithPath);
                    $timestamp = $d->getTimestamp();
                    $formatted_date = $d->format('d/m/Y H:i:s');
                    echo '<td>'; ?><?= h($formatted_date) ?><?php echo '</td>';
                } else if ($td->getType() == self::TYPE_USER) {
                    echo '<td>';
                    if ($entidadeWithPath == 1) {
                        echo('Cliente');
                    } else {
                        echo('Administrador');
                    }
                    echo '</td>';
                } else if ($td->getType() == self::TYPE_JSON) {
                    echo '<td>'; ?><?= h(json_encode($entidadeWithPath)) ?><?php echo '</td>';
                } else if ($td->getType() == self::TYPE_LIST) {
                    echo '<td>'; ?><?= h($td->getList()[$entidadeWithPath]) ?><?php echo '</td>';
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
        if(count($this->model) == 0){
            echo '<div class="paginator">';
             echo '<span style="text-align: center">Não localizado nenhum registro</span>';
            echo '</div>';
        }
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
        echo '<div class="container-max-options">';
        echo $this->paginator ->limitControl ([ 10  =>  10 ,  15  =>  15, 20 => 20, 50 => 50 , 100 => 100 ], null, ['label' => 'Registros por página:']);
        echo '</div>';
        echo '</p>';
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

    /**
     * @return GridField[]
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param GridField[] $fields
     */
    public function addField($field)
    {
        $this->fields[] = $field;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return bool
     */
    public function isDebbugMode()
    {
        return $this->debbugMode;
    }

    /**
     * @param bool $debbugMode
     */
    public function setDebbugMode($debbugMode)
    {
        $this->debbugMode = $debbugMode;
    }

    /**
     * @return mixed
     */
    public function getNoEdit()
    {
        return $this->noEdit;
    }

    /**
     * @param mixed $noEdit
     */
    public function setNoEdit($noEdit)
    {
        $this->noEdit = $noEdit;
    }

    /**
     * @return bool
     */
    public function isNoAdd()
    {
        return $this->noAdd;
    }

    /**
     * @param bool $noAdd
     */
    public function setNoAdd($noAdd)
    {
        $this->noAdd = $noAdd;
    }

    /**
     * @return bool
     */
    public function isNoView()
    {
        return $this->noView;
    }

    /**
     * @param bool $noView
     */
    public function setNoView($noView)
    {
        $this->noView = $noView;
    }

    /**
     * @return bool
     */
    public function isNoDelete()
    {
        return $this->noDelete;
    }

    /**
     * @param bool $noDelete
     */
    public function setNoDelete($noDelete)
    {
        $this->noDelete = $noDelete;
    }

    /**
     * @return array
     */
    public function getWidths()
    {
        return $this->widths;
    }

    /**
     * @param array $widths
     */
    public function setWidths($widths)
    {
        $this->widths = $widths;
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
     * @return Paginator
     */
    public function getPaginator()
    {
        return $this->paginator;
    }

    /**
     * @param Paginator $paginator
     */
    public function setPaginator($paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * @return mixed
     */
    public function getHiddenActionsColumn()
    {
        return $this->hiddenActionsColumn;
    }

    /**
     * @param mixed $hiddenActionsColumn
     */
    public function setHiddenActionsColumn($hiddenActionsColumn)
    {
        $this->hiddenActionsColumn = $hiddenActionsColumn;
    }

    /**
     * @return mixed
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @param mixed $actions
     */
    public function setActions($actions)
    {
        $this->actions = $actions;
    }

    /**
     * @return mixed
     */
    public function getActionsTable()
    {
        return $this->actionsTable;
    }

    /**
     * @param mixed $actionsTable
     */
    public function setActionsTable($actionsTable)
    {
        $this->actionsTable = $actionsTable;
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

    /**
     * @return bool
     */
    public function getCallBackActionLimpar()
    {
        return $this->callBackActionLimpar;
    }

    /**
     * @param bool $callBackActionLimpar
     */
    public function setCallBackActionLimpar($callBackActionLimpar)
    {
        $this->callBackActionLimpar = $callBackActionLimpar;
    }

}