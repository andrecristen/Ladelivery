<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

namespace App\Model\Utils;


use App\Model\Entity\Pedido;
use Cake\ORM\Locator\TableLocator;

class ValidaPedidoAbertoCliente
{
    protected $tableLocator;

    public function __construct()
    {
        $this->tableLocator = new TableLocator();
    }

    public function existsPedidoEmAberto($clienteId){
        $pedidoAberto = $this->getTableLocator()->get('Pedidos')->find()->where(['user_id' => $clienteId, 'status_pedido' => Pedido::STATUS_AGUARDANDO_CONFIRMACAO_CLIENTE])->first();
        if($pedidoAberto){
            return $pedidoAberto->id;
        }
        return false;
    }

    /**
     * @return TableLocator
     */
    public function getTableLocator()
    {
        return $this->tableLocator;
    }

    /**
     * @param TableLocator $tableLocator
     */
    public function setTableLocator($tableLocator)
    {
        $this->tableLocator = $tableLocator;
    }


}