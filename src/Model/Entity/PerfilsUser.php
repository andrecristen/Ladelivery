<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PerfilsUser Entity
 *
 * @property int $id
 * @property int $perfil_id
 * @property int $user_id
 *
 * @property \App\Model\Entity\Perfil $perfil
 * @property \App\Model\Entity\User $user
 */
class PerfilsUser extends Entity
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
        'perfil_id' => true,
        'user_id' => true,
        'perfil' => true,
        'user' => true
    ];
}
