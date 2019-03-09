<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OpcoesExtra Entity
 *
 * @property int $id
 * @property string $nome_adicional
 * @property string $descricao_adicional
 * @property float $valor_adicional
 *
 * @property \App\Model\Entity\Lista[] $listas
 */
class OpcoesExtra extends Entity
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
        'nome_adicional' => true,
        'descricao_adicional' => true,
        'valor_adicional' => true,
        'listas' => true
    ];
}
