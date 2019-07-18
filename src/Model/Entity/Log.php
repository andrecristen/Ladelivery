<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Log Entity
 *
 * @property int $id
 * @property int $tipo
 * @property int|null $user_id
 * @property string|null $descricao
 * @property \Cake\I18n\FrozenTime $data_hora
 * @property int $situacao
 *
 * @property \App\Model\Entity\User $user
 */
class Log extends Entity
{
    const TIPO_NOTIFICACAO_USUARIO = 1;
    const TIPO_REGISTRO_INTERNO = 2;
    const TIPO_ERRO = 3;

    const SITUACAO_LIDA = 1;
    const SITUACAO_PENDENTE = 2;

    public static function getTipoList(){
        return [
            self::TIPO_NOTIFICACAO_USUARIO => 'Notificação',
            self::TIPO_REGISTRO_INTERNO => 'Registro',
            self::TIPO_ERRO => 'Erro',
        ];
    }

    public static function getSituacaoList(){
        return [
            self::SITUACAO_LIDA => 'Lida',
            self::SITUACAO_PENDENTE => 'Pendente'
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
        'tipo' => true,
        'user_id' => true,
        'descricao' => true,
        'data_hora' => true,
        'situacao' => true,
        'user' => true
    ];
}
