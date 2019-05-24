<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Menu Entity
 *
 * @property int $id
 * @property int $modulo_id
 * @property int $action_id
 * @property string $nome_menu
 * @property bool $ativo_menu
 * @property int $ordem_menu
 * @property string|null $icon_menu
 *
 * @property \App\Model\Entity\Modulo $modulo
 * @property \App\Model\Entity\Action $action
 */
class Menu extends Entity
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
        'modulo_id' => true,
        'action_id' => true,
        'nome_menu' => true,
        'ativo_menu' => true,
        'ordem_menu' => true,
        'icon_menu' => true,
        'modulo' => true,
        'action' => true
    ];
}
