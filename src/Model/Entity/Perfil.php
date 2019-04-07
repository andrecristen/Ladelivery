<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Perfil Entity
 *
 * @property int $id
 * @property string $nome_perfil
 * @property bool $padrao_novos_users
 */
class Perfil extends Entity
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
        'nome_perfil' => true,
        'padrao_novos_users' => true
    ];
}
