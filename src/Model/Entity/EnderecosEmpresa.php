<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EnderecosEmpresa Entity
 *
 * @property int $id
 * @property int $empresa_id
 * @property string $rua
 * @property int $numero
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property string $cep
 *
 * @property \App\Model\Entity\Empresa $empresa
 */
class EnderecosEmpresa extends Entity
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
        'rua' => true,
        'numero' => true,
        'bairro' => true,
        'cidade' => true,
        'estado' => true,
        'cep' => true,
        'empresa' => true
    ];
}
