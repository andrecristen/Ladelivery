<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UsersContato Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $tipo
 * @property string $contato
 *
 * @property \App\Model\Entity\User $user
 */
class UsersContato extends Entity
{

    const TIPO_WHATSAPP = 1;
    const TIPO_TELEFONE_FIXO = 2;
    const TIPO_TELEFONE_CELULAR = 2;

    public static function getTipoList(){
        return [
            self::TIPO_WHATSAPP => 'WhatsApp',
            self::TIPO_TELEFONE_FIXO => 'Fixo',
            self::TIPO_TELEFONE_CELULAR => 'Celular',
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
        'user_id' => true,
        'tipo' => true,
        'contato' => true,
        'user' => true
    ];
}
