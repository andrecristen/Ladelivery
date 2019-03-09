<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ListasOpcoesExtra Entity
 *
 * @property int $id
 * @property int $lista_id
 * @property int $opcoes_extra_id
 *
 * @property \App\Model\Entity\Lista $lista
 * @property \App\Model\Entity\OpcoesExtra $opcoes_extra
 */
class ListasOpcoesExtra extends Entity
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
        'lista_id' => true,
        'opcoes_extra_id' => true,
        'lista' => true,
        'opcoes_extra' => true,
        'ativa' => true
    ];
}
