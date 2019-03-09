<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItensCarrinho Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $produto_id
 * @property int $quantidades
 * @property float $valor_total_cobrado
 * @property string|null $observacao
 * @property array|null $opicionais
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Produto $produto
 */
class ItensCarrinho extends Entity
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
        'user_id' => true,
        'produto_id' => true,
        'quantidades' => true,
        'valor_total_cobrado' => true,
        'observacao' => true,
        'opicionais' => true,
        'user' => true,
        'produto' => true
    ];
}
