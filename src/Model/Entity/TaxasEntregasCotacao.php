<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TaxasEntregasCotacao Entity
 *
 * @property int $id
 * @property int $empresa_id
 * @property float $valor_km
 * @property int|null $arredondamento_tipo
 * @property bool $ativo
 * @property float|null $valor_base_erro
 *
 * @property \App\Model\Entity\Empresa empresa
 */
class TaxasEntregasCotacao extends Entity
{
    const TIPO_CENTRAL = 1;
    const TIPO_INFERIOR = 2;
    const TIPO_SUPERIOR = 3;

    public function getListTipoArredondamento()
    {
        return [1 => 'Central (Exemplo: 2,3 = 2,5)', 2 => 'Inferior (Exemplo: 2,3 = 2)', 3 => 'Superior (Exemplo: 2,3 = 3)'];
    }

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
        'valor_km' => true,
        'arredondamento_tipo' => true,
        'ativo' => true,
        'valor_base_erro' => true,
        'empresa_id' => true,
        'empresa' => true,
    ];
}
