<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PedidosEntrega Entity
 *
 * @property int $id
 * @property int $pedido_id
 * @property float $valor_entrega
 * @property string|null $cotacao_maps
 * @property int $endereco_id
 *
 * @property \App\Model\Entity\Pedido $pedido
 * @property \App\Model\Entity\Endereco $endereco
 */
class PedidosEntrega extends Entity
{

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
        'pedido_id' => true,
        'valor_entrega' => true,
        'cotacao_maps' => true,
        'endereco_id' => true,
        'pedido' => true,
        'endereco' => true
    ];
}
