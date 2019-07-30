<?php


namespace App\Controller;

use App\Model\Entity\Pedido;
use App\Model\Entity\User;
use Cake\Event\Event;

/**
 * Classe para requisições API do aplicativo laComanda
 *
 */
class ComandasController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['login', 'allComandas']);
    }

    public function beforeFilter(Event $event)
    {
        $this->viewBuilder()->setLayout(false);
        $this->render(false);
    }

    public function login()
    {
        /** @var $user User*/
        $user = $this->Auth->identify();
        $success = false;
        $token = false;
        if ($user &&  $user['tipo'] != User::TIPO_CLIENTE){
            $success = true;
            $token = md5($user->login);
        }
        echo json_encode([
            'success' => $success,
            'token' => $token,
            ]);
    }

    public function allComandas(){
        $comandas = $this->getTableLocator()->get('Pedidos')->find()->where(['tipo_pedido' => Pedido::TIPO_PEDIDO_COMANDA]);
        $comandasFormat = [];
        foreach ($comandas as $comanda){
            $comandasFormat[] = ['id' => $comanda->id, 'cliente' => $comanda->cliente];
        }
        echo json_encode([
            'comandas' => $comandasFormat,
        ]);
    }
}