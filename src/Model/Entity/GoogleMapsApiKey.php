<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GoogleMapsApiKey Entity
 *
 * @property int $id
 * @property int empresa_id
 * @property string $api_key
 * @property int $ativa
 *
 * @property \App\Model\Entity\Empresa empresa
 */
class GoogleMapsApiKey extends Entity
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
        'api_key' => true,
        'ativa' => true,
        'empresa' => true
    ];
}
