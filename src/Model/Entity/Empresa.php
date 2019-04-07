<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Empresa Entity
 *
 * @property int $id
 * @property string $nome_fantasia
 * @property string|null $cnpj
 * @property string|null $ie
 * @property bool $ativa
 * @property int $user_id
 * @property int $tipo_empresa
 *
 * @property \App\Model\Entity\TemposMedio[] $tempos_medios
 */
class Empresa extends Entity
{

    const TIPO_EMPRESA_SOFTWARE = 1;
    const TIPO_EMPRESA_PARCEIRA = 2;

    public static function getTipoList(){
        return [
            self::TIPO_EMPRESA_SOFTWARE => 'Software',
            self::TIPO_EMPRESA_PARCEIRA => 'Loja Parceira',
        ];
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
        'nome_fantasia' => true,
        'cnpj' => true,
        'ie' => true,
        'tipo_empresa' => true,
        'ativa' => true,
        'tempos_medios' => true
    ];
}
