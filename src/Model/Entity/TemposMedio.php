<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TemposMedio Entity
 *
 * @property int $id
 * @property int $empresa_id
 * @property string $nome
 * @property int $tempo_medio_producao_minutos
 * @property bool $ativo
 */
class TemposMedio extends Entity
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
        'empresa' => true,
        'nome' => true,
        'tempo_medio_producao_minutos' => true,
        'ativo' => true
    ];
}
