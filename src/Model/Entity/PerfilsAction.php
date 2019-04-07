<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PerfilsAction Entity
 *
 * @property int $id
 * @property int $action_id
 * @property int $perfil_id
 *
 * @property \App\Model\Entity\Action $action
 * @property \App\Model\Entity\Perfil $perfil
 */
class PerfilsAction extends Entity
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
        'action_id' => true,
        'perfil_id' => true,
        'action' => true,
        'perfil' => true
    ];
}
