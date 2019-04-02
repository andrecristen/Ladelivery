<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Midia Entity
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $tipo_midia
 * @property string $path_midia
 * @property string $nome_midia
 *
 * @property \App\Model\Entity\Empresa $empresa
 */
class Midia extends Entity
{
    const TIPO_PRODUTO = 1;
    const TIPO_CATEGORIA = 2;
    const TIPO_BANNER = 3;
    //Usadas para adicionar automaticamente
    const TIPO_PERFIL_USER = 4;
    const TIPO_PERFIL_EMPRESA = 5;

    public static function getTipoList(){
        return [
          self::TIPO_PRODUTO => 'Produto',
          self::TIPO_CATEGORIA => 'Categoria',
          self::TIPO_BANNER => 'Banner'
        ];
    }

    public static function getTipoListLojaParceira(){
        return [
            self::TIPO_PRODUTO => 'Produto',
            self::TIPO_CATEGORIA => 'Categoria',
        ];
    }

    public static function getTipoListUploadPath(){
        return [
            self::TIPO_PRODUTO => 'produtos',
            self::TIPO_CATEGORIA => 'categorias',
            self::TIPO_BANNER => 'banners',
            self::TIPO_PERFIL_USER => 'users',
            self::TIPO_PERFIL_EMPRESA => 'empresas',
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
        'tipo_midia' => true,
        'path_midia' => true,
        'nome_midia' => true,
        'empresa' => true,
    ];
}
