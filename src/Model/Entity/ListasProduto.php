<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ListasProduto Entity
 *
 * @property int $id
 * @property int $produto_id
 * @property int $lista_id
 *
 * @property \App\Model\Entity\Produto $produto
 * @property \App\Model\Entity\Lista $lista
 */
class ListasProduto extends Entity
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
        'produto_id' => true,
        'lista_id' => true,
        'produto' => true,
        'lista' => true
    ];
}
