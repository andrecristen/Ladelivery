<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CupomSite Entity
 *
 * @property int $id
 * @property string $nome_cupom
 * @property int|null $vezes_usado
 * @property int $maximo_vezes_usar
 * @property int $valor_desconto
 * @property bool $porcentagem
 */
class CupomSite extends Entity
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
        'nome_cupom' => true,
        'vezes_usado' => true,
        'maximo_vezes_usar' => true,
        'valor_desconto' => true,
        'porcentagem' => true
    ];
}
