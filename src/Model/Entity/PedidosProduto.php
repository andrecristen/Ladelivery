<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PedidosProduto Entity
 *
 * @property int $id
 * @property int $pedido_id
 * @property int $produto_id
 * @property int $quantidade
 * @property int $quantidade_produzida
 * @property float $valor_total_cobrado
 * @property string|null $observacao
 * @property array|null $opcionais
 * @property int $ambiente_producao_responsavel
 * @property int $status
 *
 * @property \App\Model\Entity\Pedido $pedido
 * @property \App\Model\Entity\Produto $produto
 */
class PedidosProduto extends Entity
{

    const RESPONSAVEL_COZINHA = 1;
    const RESPONSAVEL_BAR = 2;

    const STATUS_AGUARDANDO_RECEBIMENTO_PEDIDO = 1;
    const STATUS_EM_SEPARACAO_PARA_PRODUCAO = 2;
    const STATUS_EM_FILA_PRODUCAO = 3;
    const STATUS_EM_PRODUCAO = 4;
    const STATUS_PRODUCAO_CONCLUIDA = 5;
    const STATUS_PEDIDO_REJEITADO = 6;
    const STATUS_PRODUCAO_CANCELADA = 7;
    //So para comandas
    const STATUS_ITEM_PAGO = 8;

    public static function getAmbienteResponsavel(){
        return [
            self::RESPONSAVEL_COZINHA => 'Cozinha',
            self::RESPONSAVEL_BAR => 'Bar',
        ];
    }

    public static function getAllStatusList(){
        return [
            self::STATUS_AGUARDANDO_RECEBIMENTO_PEDIDO => 'Aguardando Confirmação Cliente',
            self::STATUS_EM_SEPARACAO_PARA_PRODUCAO => 'Em Separação',
            self::STATUS_EM_FILA_PRODUCAO => 'Aguardando Produção',
            self::STATUS_EM_PRODUCAO => 'Em Produção',
            self::STATUS_PRODUCAO_CONCLUIDA => 'Produção Concluida',
            self::STATUS_PEDIDO_REJEITADO => 'Pedido Rejeitado',
            self::STATUS_PRODUCAO_CANCELADA => 'Produção Cancelada',
            self::STATUS_ITEM_PAGO => 'Item Pago',

        ];
    }

    public static function getStatusList(){
        return [
            self::STATUS_AGUARDANDO_RECEBIMENTO_PEDIDO => 'Aguardando Confirmação Cliente',
            self::STATUS_EM_SEPARACAO_PARA_PRODUCAO => 'Em Separação',
            self::STATUS_EM_FILA_PRODUCAO => 'Aguardando Produção',
            self::STATUS_EM_PRODUCAO => 'Em Produção',
            self::STATUS_PRODUCAO_CONCLUIDA => 'Produção Concluida',
            self::STATUS_PEDIDO_REJEITADO => 'Pedido Rejeitado',
            self::STATUS_PRODUCAO_CANCELADA => 'Produção Cancelada',
        ];
    }

    public static function getStatusComandaList(){
        return [
            self::STATUS_EM_FILA_PRODUCAO => 'Aguardando Produção',
            self::STATUS_EM_PRODUCAO => 'Em Produção',
            self::STATUS_PRODUCAO_CONCLUIDA => 'Produção Concluida',
            self::STATUS_PRODUCAO_CANCELADA => 'Produção Cancelada',
            self::STATUS_ITEM_PAGO => 'Item Pago',
        ];
    }

    public static function getStatusGridList(){
        return [
            self::STATUS_EM_FILA_PRODUCAO => 'Aguardando Produção',
            self::STATUS_EM_PRODUCAO => 'Em Produção',
            self::STATUS_PRODUCAO_CONCLUIDA => 'Produção Concluida',
        ];
    }

    public static function getAlterStatusList(){
        return [
            self::STATUS_EM_FILA_PRODUCAO => 'Aguardando Produção',
            self::STATUS_EM_PRODUCAO => 'Em Produção',
            self::STATUS_PRODUCAO_CONCLUIDA => 'Produção Concluida',
        ];
    }

    public static function getAlterStatusComandaList(){
        $list = self::getAlterStatusList();
        $list [self::STATUS_ITEM_PAGO] = 'Item Pago';
        return $list;
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
        'id' => true,
        'pedido_id' => true,
        'produto_id' => true,
        'quantidade' => true,
        'quantidade_produzida' => true,
        'valor_total_cobrado' => true,
        'observacao' => true,
        'opcionais' => true,
        'ambiente_producao_responsavel' => true,
        'status' => true,
        'pedido' => true,
        'produto' => true
    ];
}
