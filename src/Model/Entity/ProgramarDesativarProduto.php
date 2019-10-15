<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProgramarDesativarProduto Entity
 *
 * @property int $id
 * @property int $produto_id
 * @property int $dia_semana
 * @property bool $programacao_ativa
 *
 * @property \App\Model\Entity\Produto $produto
 */
class ProgramarDesativarProduto extends Entity
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
        'dia_semana' => true,
        'programacao_ativa' => true,
        'produto' => true
    ];
}
