<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TemposMedio Entity
 *
 * @property int $id
 * @property int $empresa_id
 * @property string $nome
 * @property int $tempo_medio_producao_minutos
 * @property int $tipo
 * @property bool $ativo
 */
class TemposMedio extends Entity
{
    const TIPO_PARA_ENTREGA = 1;
    const TIPO_PARA_COLETA = 2;

    public static function getTipoList(){
        return [
            self::TIPO_PARA_ENTREGA => 'Pedidos com Entrega',
            self::TIPO_PARA_COLETA => 'Pedidos com Coleta do Cliente'
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
        'empresa_id' => true,
        'empresa' => true,
        'nome' => true,
        'tipo' => true,
        'tempo_medio_producao_minutos' => true,
        'ativo' => true
    ];
}
