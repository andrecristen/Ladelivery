<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Action Entity
 *
 * @property int $id
 * @property int $controller_id
 * @property string $nome_action
 * @property string $descricao_action
 *
 * @property \App\Model\Entity\Controller $controller
 */
class Action extends Entity
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
        'controller_id' => true,
        'nome_action' => true,
        'descricao_action' => true,
        'controller' => true
    ];
}
