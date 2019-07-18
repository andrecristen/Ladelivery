<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TaxasEntregasCotacaoFaixa Entity
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $kilometro_inicio
 * @property int $kilometro_fim
 * @property float $valor
 * @property bool $ativo
 *
 * @property \App\Model\Entity\Empresa $empresa
 */
class TaxasEntregasCotacaoFaixa extends Entity
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
        'kilometro_inicio' => true,
        'kilometro_fim' => true,
        'valor' => true,
        'ativo' => true,
        'empresa' => true
    ];
}
