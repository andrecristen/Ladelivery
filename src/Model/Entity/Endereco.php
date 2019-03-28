<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Endereco Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $rua
 * @property int|null $numero
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property string|null $cep
 * @property string|null $complemento
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\PedidosEntrega[] $pedidos_entregas
 */
class Endereco extends Entity
{
    const TIPO_ENDERECO_CLIENTE = 1;
    const TIPO_ENDERECO_EMPRESA = 2;

    public static function getListTipo(){
        [
            self::TIPO_ENDERECO_CLIENTE => 'Cliente',
            self::TIPO_ENDERECO_EMPRESA => 'Empresa'
        ];
    }

    public static function getEstados(){
        return [
            'AC'=>'Acre',
            'AL'=>'Alagoas',
            'AP'=>'Amapá',
            'AM'=>'Amazonas',
            'BA'=>'Bahia',
            'CE'=>'Ceará',
            'DF'=>'Distrito Federal',
            'ES'=>'Espírito Santo',
            'GO'=>'Goiás',
            'MA'=>'Maranhão',
            'MT'=>'Mato Grosso',
            'MS'=>'Mato Grosso do Sul',
            'MG'=>'Minas Gerais',
            'PA'=>'Pará',
            'PB'=>'Paraíba',
            'PR'=>'Paraná',
            'PE'=>'Pernambuco',
            'PI'=>'Piauí',
            'RJ'=>'Rio de Janeiro',
            'RN'=>'Rio Grande do Norte',
            'RS'=>'Rio Grande do Sul',
            'RO'=>'Rondônia',
            'RR'=>'Roraima',
            'SC'=>'Santa Catarina',
            'SP'=>'São Paulo',
            'SE'=>'Sergipe',
            'TO'=>'Tocantins'
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
        'rua' => true,
        'numero' => true,
        'bairro' => true,
        'cidade' => true,
        'estado' => true,
        'cep' => true,
        'complemento' => true,
        'user' => true,
        'pedidos_entregas' => true
    ];
}
