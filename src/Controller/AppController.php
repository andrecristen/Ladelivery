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
use Cake\Controller\ComponentRegistry;
use Cake\Controller\Controller;
use Cake\Core\App;
use Cake\Event\Event;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
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
    }

    public function beforeFilter(Event $event)
    {
        $this->set('login', $this->Auth->user('login'));
        //Funcoes permitidas para quem nao estiver logado.
        $this->Auth->allow(['registrar', 'display', 'getProduto', 'solicitar', 'novaSenha', 'getListas']);
        //Limite de registros por pagina.
        $this->paginate['limit'] = 10;
    }

    /**
     * Valida as acoes com base no tipo de usuario logado.
     * Serve para nao permitir que usuarios cliente entrem no portal.
     */
    public function validateActions()
    {
        return;
        //Acoes como login, registrar e logout devem ser ignoradas.
        $invalid = false;
        //Master acesso total ao sistema
        if ($this->Auth->user('tipo') == User::TIPO_MASTER) {
            return;
        //Administrador acesso somente as rotas dos perfis dele
        }elseif ($this->Auth->user('tipo') == User::TIPO_ADMINISTRADOR){
            $params = ($this->getRequest()->getAttribute('params'));
            $action = $params['action'];
            if (!$action){
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
                $this->Flash->error('Você não possui acesso a ação "'.$actionModel->descricao_action.'", caso necessite desta ação contate suporte para liberar acesso.');
                $anterior = $this->referer();
                return $this->redirect($this->referer());
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

    protected function generateConditionsFind($forceFilterEmpresa = true, $filtersFixed = [])
    {
        $empresaUtils = new EmpresaUtils();
        $finalSearch = [];
        if ($this->getRequest()->getQuery()) {
            $search = $this->getRequest()->getQuery();
            if ($search) {
                foreach ($search as $key => $field) {
                    if ($field !== '' && $key !== 'page' && $key !== 'limit') {
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
                        if (intval($field) || $field == '0' || floatval($field)) {
                            $finalSearch[$key] = $field;
                        } else {
                            if ($field == 'false' || $field == 'true') {
                                $finalSearch[$key] = boolval($field);
                            } else {
                                $finalSearch[$key . ' LIKE'] = '%' . $field . '%';
                            }
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
