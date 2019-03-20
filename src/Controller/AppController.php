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

use App\Model\Entity\User;
use Cake\Controller\Controller;
use Cake\Core\App;
use Cake\Event\Event;

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

    public function pertmiteAction($action, $actionValue = false)
    {
        $this->validActions[$action] = $actionValue;
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
                    'fields' => ['username' => 'login', 'password' => 'password', 'tipo' => 2]
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
        $invalid = false;
        if ($this->Auth->user('tipo') == User::TIPO_ADMINISTRADOR) {
            return;
        } else if ($this->Auth->user('tipo') == User::TIPO_CLIENTE) {
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
                return $this->redirect('/');
            }
        }
    }

}
