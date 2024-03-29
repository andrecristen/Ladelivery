<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AlteracaoSenha Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property boolean $usado
 * @property \Cake\I18n\FrozenTime $validade
 *
 * @property \App\Model\Entity\User $user
 */
class AlteracaoSenha extends Entity
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
        'token' => true,
        'validade' => true,
        'usado' => true,
        'user' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'token'
    ];
}
