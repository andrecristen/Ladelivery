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
 * @property int $tipo_empresa
 * @property int $tipo_frete
 * @property float $valor_base_erro_frete
 * @property string|null $contatos
 *
 * @property \App\Model\Entity\TemposMedio[] $tempos_medios
 */
class Empresa extends Entity
{

    const TIPO_EMPRESA_SOFTWARE = 1;
    const TIPO_EMPRESA_PARCEIRA = 2;

    const TIPO_CONTATO_FACEBOOK = 1;
    const TIPO_CONTATO_WPP = 2;
    const TIPO_CONTATO_TELEFONE = 3;
    const TIPO_CONTATO_EMAIL = 4;

    const FRETE_TIPO_KM = 1;
    const FRETE_TIPO_FAIXA = 2;

    public static function getTipoList(){
        return [
            self::TIPO_EMPRESA_SOFTWARE => 'Software',
            self::TIPO_EMPRESA_PARCEIRA => 'Loja Parceira',
        ];
    }

    public static function getTipoContatoList(){
        return [
            self::TIPO_CONTATO_FACEBOOK => 'Facebook',
            self::TIPO_CONTATO_WPP => 'WhatsApp',
            self::TIPO_CONTATO_TELEFONE => 'Telefone Fixo',
            self::TIPO_CONTATO_EMAIL => 'Email',
        ];
    }

    public static function getTipoContatoIconList(){
        return [
            self::TIPO_CONTATO_FACEBOOK => 'fab fa-facebook-square fa-fw',
            self::TIPO_CONTATO_WPP => 'fab fa-whatsapp fa-fw',
            self::TIPO_CONTATO_TELEFONE => 'fas fa-phone-square fa-fw',
            self::TIPO_CONTATO_EMAIL => 'fas fa-mail-bulk fa-fw',
        ];
    }

    public static function getTipoFreteList(){
        return [
            self::FRETE_TIPO_KM => 'Valor Por KM',
            self::FRETE_TIPO_FAIXA => 'Valor Por Faixa de Distância',
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
        'tipo_frete' => true,
        'valor_base_erro_frete' => true,
        'ativa' => true,
        'tempos_medios' => true,
        'contatos' => true
    ];
}
