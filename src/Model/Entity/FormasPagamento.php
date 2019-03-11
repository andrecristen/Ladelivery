<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FormasPagamento Entity
 *
 * @property int $id
 * @property int $empresa_id
 * @property string $nome
 * @property float $aumenta_valor
 * @property bool $necesista_maquina_cartao
 * @property bool $necessita_troco
 *
 * @property \App\Model\Entity\Empresa $empresa
 */
class FormasPagamento extends Entity
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
        'empresa_id' => true,
        'nome' => true,
        'necesista_maquina_cartao' => true,
        'necessita_troco' => true,
        'empresa' => true,
        'aumenta_valor' => true
    ];
}
