<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pedido Entity
 *
 * @property int $id
 * @property int $user_id
 * @property float $valor_total_cobrado
 * @property int|null $tempo_producao_aproximado_minutos
 * @property float $troco_para
 * @property float $valor_desconto
 * @property float $valor_acrescimo
 * @property int $tipo_pedido
 * @property int $status_pedido
 * @property int $formas_pagamento_id
 * @property int $empresa_id
 * @property string $cupom_usado
 * @property string $cliente
 * @property \Cake\I18n\FrozenTime $data_pedido
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\PedidosEntrega[] $pedidos_entregas
 * @property \App\Model\Entity\Produto[] $produtos
 * @property \App\Model\Entity\Empresa $empresa
 */
class Pedido extends Entity
{
    //Tipos de pedidos
    const TIPO_PEDIDO_DELIVERY = 1;
    const TIPO_PEDIDO_COMANDA = 2;

    //Status para Lists pedidos tipo Delivery
    const STATUS_AGUARDANDO_CONFIRMACAO_CLIENTE = 1;
    const STATUS_AGUARDANDO_CONFIRMACAO_EMPRESA = 2;
    const STATUS_EM_SEPARACAO_PARA_PRODUCAO = 3;
    const STATUS_EM_PRODUCAO = 4;
    const STATUS_EM_PRODUCAO_CONCLUIDA = 5;
    const STATUS_AGUARDANDO_ENTREGADOR = 6;
    const STATUS_SAIU_PARA_ENTREGA = 7;
    const STATUS_AGUARDANDO_COLETA_CLIENTE = 8;
    const STATUS_ENTREGUE = 9;
    const STATUS_REJEITADO = 10;
    const STATUS_CANCELADO_CLIENTE = 11;
    const STATUS_EM_ABERTURA = 12;

    //Status para Lists pedidos tipo Comanda
    const  STATUS_ABERTA = 11;
    const  STATUS_FECHADA = 12;

    public static function getTipoList(){
        return [
            self::TIPO_PEDIDO_DELIVERY => 'Delivery',
            self::TIPO_PEDIDO_COMANDA => 'Comanda',
        ];
    }

    public static function getDeliveryStatusList(){
        return [
            self::STATUS_AGUARDANDO_CONFIRMACAO_CLIENTE => 'Aguardando Confirmação Cliente',
            self::STATUS_AGUARDANDO_CONFIRMACAO_EMPRESA => 'Aguardando Confirmação',
            self::STATUS_EM_SEPARACAO_PARA_PRODUCAO => 'Em Separação',
            self::STATUS_EM_PRODUCAO => 'Em Produção',
            self::STATUS_EM_PRODUCAO_CONCLUIDA => 'Produção Concluida',
            self::STATUS_AGUARDANDO_ENTREGADOR => 'Aguardando Entregador',
            self::STATUS_SAIU_PARA_ENTREGA => 'Saiu para entrega',
            self::STATUS_AGUARDANDO_COLETA_CLIENTE => 'Aguardando Coleta Cliente',
            self::STATUS_ENTREGUE => 'Entregue',
            self::STATUS_REJEITADO => 'Rejeitado',
            self::STATUS_CANCELADO_CLIENTE => 'Cancelado',
            self::STATUS_EM_ABERTURA => 'Em Abertura',
        ];
    }

    public static function getDeliveryAlterStatusList(){
        return [
            self::STATUS_EM_PRODUCAO => 'Em Produção',
            self::STATUS_AGUARDANDO_COLETA_CLIENTE => 'Aguardando Coleta Cliente',
            self::STATUS_AGUARDANDO_ENTREGADOR => 'Aguardando Entregador',
            self::STATUS_SAIU_PARA_ENTREGA => 'Saiu para entrega',
            self::STATUS_ENTREGUE => 'Entregue',
        ];
    }

    public static function getComandaStatusList(){
        return [
            self::STATUS_ABERTA  => 'Aberta',
            self::STATUS_FECHADA => 'Paga',
            self::STATUS_EM_ABERTURA => 'Em Abertura',
        ];
    }

    public static function getComandaAlterStatusList(){
        return [
            self::STATUS_ABERTA  => 'Aberta',
            self::STATUS_FECHADA => 'Paga',
        ];
    }

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'id',
        'user_id' => true,
        'valor_total_cobrado' => true,
        'tempo_producao_aproximado_minutos' => true,
        'troco_para' => true,
        'tipo_pedido' => true,
        'status_pedido' => true,
        'data_pedido' => true,
        'user' => true,
        'pedidos_entregas' => true,
        'produtos' => true,
        'cupom_usado' => true,
        'valor_desconto' => true,
        'valor_acrescimo' => true,
        'formas_pagamento_id' => true,
        'formas_pagamentos' => true,
        'empresa_id' => true,
        'empresa' => true,
        'cliente' => true,
    ];
}
