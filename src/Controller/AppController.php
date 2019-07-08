<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use App\Model\Entity\Action;
use App\Model\Entity\PerfilsUser;
use App\Model\Entity\User;
use App\Model\Utils\EmpresaUtils;
use App\Model\Utils\TypeFields;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\Locator\TableLocator;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    protected $validActions = [];

    /**
     * Seta acoes como publicas permitindo que os clientes tambem acessem,
     * usado em poucos casos de funcoes ajax do site que refletem nos controladores
     * dos modelos, acoes nao autorizadas como publicas sao validadas por nivel de
     * acesso do usuario.
     */
    public function setPublicAction($actionName, $actionValue = false)
    {
        $this->validActions[$actionName] = $actionValue;
    }

    public $components = array('RequestHandler');

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'login', 'password' => 'password']
                ],
            ],
            'authError' => __d('cake', 'Você precisa estar logado para ter acesso as funções do sistema.'),
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'display',
            ],
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'display',
            ]
        ]);
        $this->loadComponent('RequestHandler');
        //Funcoes permitidas para quem nao estiver logado.
        $this->Auth->allow(['registrar', 'logout', 'display', 'getProduto', 'solicitar', 'novaSenha', 'getListas', 'listAvaliacoes']);

    }

    public function beforeFilter(Event $event)
    {
        $this->set('login', $this->Auth->user('login'));
        //Limite de registros por pagina.
        $this->paginate['limit'] = 10;
    }

    /**
     * Valida as acoes com base no tipo de usuario logado.
     * Serve para nao permitir que usuarios cliente entrem no portal.
     */
    public function validateActions()
    {
        $publicActions = $this->Auth->allowedActions;
        $params = ($this->getRequest()->getAttribute('params'));
        $action = $params['action'];
        if($action && $publicActions){
            foreach ($publicActions as $publicAction){
                if($publicAction == $action){
                    return true;
                }
            }
        }
        //Acoes como login, registrar e logout devem ser ignoradas.
        $invalid = false;
        //Master acesso total ao sistema
        if ($this->Auth->user('tipo') == User::TIPO_MASTER) {
            return;
        //Administrador acesso somente as rotas dos perfis dele
        }elseif ($this->Auth->user('tipo') == User::TIPO_ADMINISTRADOR || $this->Auth->user('tipo') == User::TIPO_ENTREGADOR){
            if (!$action){
                return;
            }
            if(isset($this->validActions[$action])){
                return;
            }
            $tableLocator = new TableLocator();
            /** @var $controller \App\Model\Entity\Controller*/
            $controller = $tableLocator->get('Controllers')->find()->where(['nome_controlador' => $this->name])->first();
            /** @var $actionModel Action*/
            $actionModel = $tableLocator->get('Actions')->find()->where(['nome_action' => $action, 'controller_id' => $controller->id])->first();
            /** @var $perfilsUser PerfilsUser[]*/
            $perfilsUser = $tableLocator->get('PerfilsUsers')->find()->where(['user_id' => $this->Auth->user('id')]);
            $perfilAction = false;
            $encontrou = false;
            foreach ($perfilsUser as $perfilUser){
                if (!$encontrou){
                    $perfilAction = $tableLocator->get('PerfilsActions')->find()->where(['perfil_id' => $perfilUser->perfil_id, 'action_id' => $actionModel->id])->first();
                    if($perfilAction){
                        $encontrou = true;
                    }
                }
            }
            if($perfilAction){
                return;
            }else{
//                $this->Flash->error('Você não possui acesso a ação "'.$actionModel->descricao_action.'", caso necessite desta ação contate suporte para liberar acesso.');
                $erro = 'Você não possui acesso a ação "'.$actionModel->descricao_action.'", caso necessite desta ação contate suporte para liberar acesso.';
                echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>';
                echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">';
                echo '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">';
                echo '<div class="container">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="error-template">
                                      <h1>
                                          Oops!</h1>
                                      <h2> Você não tem acesso a essa página</h2>
                                      <div class="error-details">
                                          '.$erro.'
                                      </div>
                                      <div class="error-actions">
                                          <a href="javascript:history.back()" class="btn btn-primary btn-lg">
                                          <span class="glyphicon glyphicon-home"></span>
                                              <i class="fas fa-backward"></i>&nbsp;Voltar 
                                          </a>
                                          <a href="/pages/suporte" class="btn btn-success btn-lg">
                                             <span class="glyphicon glyphicon-envelope"></span> 
                                              <i class="fas fa-headset"></i>&nbsp;Suporte
                                          </a>
                                          <a href="/" class="btn btn-success btn-lg">
                                             <span class="glyphicon glyphicon-envelope"></span> 
                                              <i class="fas fa-home"></i>&nbsp;Site
                                          </a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <style>
                      body { 
                        background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABZ0RVh0Q3JlYXRpb24gVGltZQAxMC8yOS8xMiKqq3kAAAAcdEVYdFNvZnR3YXJlAEFkb2JlIEZpcmV3b3JrcyBDUzVxteM2AAABHklEQVRIib2Vyw6EIAxFW5idr///Qx9sfG3pLEyJ3tAwi5EmBqRo7vHawiEEERHS6x7MTMxMVv6+z3tPMUYSkfTM/R0fEaG2bbMv+Gc4nZzn+dN4HAcREa3r+hi3bcuu68jLskhVIlW073tWaYlQ9+F9IpqmSfq+fwskhdO/AwmUTJXrOuaRQNeRkOd5lq7rXmS5InmERKoER/QMvUAPlZDHcZRhGN4CSeGY+aHMqgcks5RrHv/eeh455x5KrMq2yHQdibDO6ncG/KZWL7M8xDyS1/MIO0NJqdULLS81X6/X6aR0nqBSJcPeZnlZrzN477NKURn2Nus8sjzmEII0TfMiyxUuxphVWjpJkbx0btUnshRihVv70Bv8ItXq6Asoi/ZiCbU6YgAAAABJRU5ErkJggg==);
                      }
                      .error-template {
                        padding: 40px 15px;
                        text-align: center;
                      }
                      .error-actions {
                        margin-top:15px;
                        margin-bottom:15px;
                      }
                      .error-actions .btn { 
                        margin-right:10px; 
                      }
                      </style>
                      ';
                die;
            }
        //Cliente acesso apenas as rotas publicas
        }elseif ($this->Auth->user('tipo') == User::TIPO_CLIENTE) {
            $params = ($this->getRequest()->getAttribute('params'));
            //Temos essa acao valida pra cliente
            if (isset($this->validActions[$params['action']])) {
                //Essa acao precisa validar o parametro passado
                if ($this->validActions[$params['action']]) {
                    //Sim precisa validar o parametro
                    if ($this->validActions[$params['action']] == $params['pass'][0]) {
                        //Parametro valido rota validada
                        return;
                    } else {
                        //Parametro invalido rota invalida.
                        $invalid = true;
                    }
                }
                //A acao nao e valida pra clientes
            } else {
                $invalid = true;
            }
            if ($invalid) {
                $this->Flash->error('Você não tem acesso a está parte do sistema');
                return $this->redirect('/');
            }
        }
    }

    public function validateActionView($controller, $action){
        if ($this->Auth->user('tipo') == User::TIPO_MASTER) {
            return true;
            //Administrador acesso somente as rotas dos perfis dele
        }elseif ($this->Auth->user('tipo') == User::TIPO_ADMINISTRADOR || $this->Auth->user('tipo') == User::TIPO_ENTREGADOR){
            $tableLocator = new TableLocator();
            /** @var $controller \App\Model\Entity\Controller*/
            $controller = $tableLocator->get('Controllers')->find()->where(['nome_controlador' => $controller])->first();
            /** @var $actionModel Action*/
            $actionModel = $tableLocator->get('Actions')->find()->where(['nome_action' => $action, 'controller_id' => $controller->id])->first();
            /** @var $perfilsUser PerfilsUser[]*/
            $perfilsUser = $tableLocator->get('PerfilsUsers')->find()->where(['user_id' => $this->Auth->user('id')]);
            $perfilAction = false;
            $encontrou = false;
            foreach ($perfilsUser as $perfilUser){
                if (!$encontrou){
                    $perfilAction = $tableLocator->get('PerfilsActions')->find()->where(['perfil_id' => $perfilUser->perfil_id, 'action_id' => $actionModel->id])->first();
                    if($perfilAction){
                        $encontrou = true;
                    }
                }
            }
            if($perfilAction){
               return true;
            }else{
                return false;
            }
        }elseif ($this->Auth->user('tipo') == User::TIPO_CLIENTE){
            return false;
        }
    }

    protected function generateConditionsFind($forceFilterEmpresa = true, $filtersFixed = [])
    {
        $empresaUtils = new EmpresaUtils();
        $finalSearch = [];
        if ($this->getRequest()->getQuery()) {
            $search = $this->getRequest()->getQuery();
            if ($search) {
                foreach ($search as $key => $field) {
                    if ($field !== '' && $key !== 'page' && $key !== 'limit') {
                        $keyParts = explode('=', $key);
                        $key = $keyParts[0];
                        $typeField = $keyParts[1];
                        //Caso no alias ja tiver o s da entidade
                        $toCamelCase = false;
                        if (strpos($key, 's/')) {
                            $key = str_replace('/', '.', $key);
                            $toCamelCase = true;
                        } elseif (strpos($key, '/')){
                            $key = str_replace('/', 's.', $key);
                            $toCamelCase = true;
                        }
                        if($toCamelCase){
                            //Se precisamos de camel case vamos tranformar so o modelo ou seja primeira parte
                            $model = explode('.', $key);
                            $modelCamelCase = $this->snakeToCamelCase($model[0]);
                            unset($model[0]);
                            $key = $modelCamelCase;
                            foreach ($model as $part){
                                $key .= '.'.$part;
                            }
                        }

                        switch ($typeField){
                            case TypeFields::TYPE_TEXT:
                                $finalSearch[$key . ' LIKE'] = '%' . $field . '%';
                                break;
                            case TypeFields::TYPE_LIST:
                            case TypeFields::TYPE_NUMBER:
                                $finalSearch[$key] = $field;
                                break;
                            case TypeFields::TYPE_BOOLEAN:
                                $finalSearch[$key] = boolval($field);
                                break;
                            case TypeFields::TYPE_DATE_TIME:
                                $dateInicio = date("Y-m-d H:i",strtotime($field));
                                $finalSearch[$key.' LIKE'] = "%".$dateInicio."%";
                                break;
                            case TypeFields::TYPE_DATE:
                                $dateInicio = date("Y-m-d",strtotime($field));
                                $finalSearch[$key.' LIKE'] = "%".$dateInicio."%";
                                break;
                        }
                    }
                }
            }
        }
        if ($forceFilterEmpresa) {
            if (!$empresaUtils->isEmpresaSoftware()) {
                $tableLocalor = new TableLocator();
                $tableModel = $tableLocalor->get($this->name);
                $schema = $tableModel->getSchema();
                if ($schema->getColumn('empresa_id')) {
                    $nameTable = $this->snakeToCamelCase($tableModel->getTable());
                    $finalSearch[$nameTable . '.empresa_id'] = $this->Auth->user('empresa_id');
                } else {
                    foreach ($tableModel->associations() as $association) {
                        $tableAssociation = $tableLocalor->get($association->getName());
                        $schema = $tableAssociation->getSchema();
                        if (($schema->getColumn('empresa_id') && !$empresaUtils->isEmpresaSoftware()) || $forceFilterEmpresa) {
                            $nameTable = $this->snakeToCamelCase($tableAssociation->getTable());
                            $finalSearch[$nameTable. '.empresa_id'] = $this->Auth->user('empresa_id');
                        }
                    }
                }
            }
        }
        $finalSearch = array_merge($finalSearch, $filtersFixed);
        return $finalSearch;
    }

    private function snakeToCamelCase($snakeString){
        $camelString = str_replace('_', '', ucwords($snakeString, '_'));
        return $camelString;
    }
}
