<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Conta Entity
 *
 * @property int $id
 * @property int $tipo
 * @property int|null $user_id
 * @property string|null $pessoa
 * @property float $valor_total
 * @property string $descricao
 * @property \Cake\I18n\FrozenDate|null $data_pagamento
 * @property \Cake\I18n\FrozenDate $data_vencimento
 *
 * @property \App\Model\Entity\User $user
 */
class Conta extends Entity
{
    const CONTA_A_PAGAR = 1;
    const CONTA_A_RECEBER = 2;

    public static function getTipoList(){
        return [
            self::CONTA_A_PAGAR => 'A Pagar',
            self::CONTA_A_RECEBER => 'A Receber',
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
        'id' => true,
        'tipo' => true,
        'user_id' => true,
        'pessoa' => true,
        'valor_total' => true,
        'descricao' => true,
        'data_pagamento' => true,
        'data_vencimento' => true,
        'user' => true
    ];
}
