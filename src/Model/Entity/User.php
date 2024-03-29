<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $nome_completo
 * @property int $tipo
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $apelido
 * @property string $login
 * @property string $password
 * @property string $token
 * @property int $dia_nascimento
 * @property int $mes_nascimento
 * @property int $ano_nascimento
 * @property int $empresa_id
 * @property \App\Model\Entity\Empresa $empresa
 */
class User extends Entity
{
    const TIPO_CLIENTE = 1;
    const TIPO_ADMINISTRADOR = 2;
    const TIPO_MASTER = 3;
    const TIPO_ENTREGADOR = 4;
    const TIPO_EMPRESA = 5;

    public static function getTipoListAll(){
        return [
            self::TIPO_CLIENTE       => 'Cliente',
            self::TIPO_ADMINISTRADOR => 'Administrador',
            self::TIPO_MASTER        => 'Master',
            self::TIPO_ENTREGADOR    => 'Entregador',
            self::TIPO_EMPRESA    => 'Empresa'
        ];
    }

    public static function getTipoListCRUD(){
        return [
            self::TIPO_ADMINISTRADOR => 'Administrador',
            self::TIPO_ENTREGADOR    => 'Entregador',
            self::TIPO_EMPRESA    =>    'Empresa'
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
        'nome_completo' => true,
        'tipo' => true,
        'created' => true,
        'modified' => true,
        'apelido' => true,
        'login' => true,
        'password' => true,
        'token' => true,
        'dia_nascimento' => true,
        'mes_nascimento' => true,
        'ano_nascimento' => true,
        'empresa_id' => true,
        'empresa' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    public static function gerarToken(User $user){
        $dateTime = new \DateTime();
        return md5($user->login. $dateTime->format('ymdhis'). $user->nome_completo);
    }

    public function _setPassword($password){
        if($password){
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
