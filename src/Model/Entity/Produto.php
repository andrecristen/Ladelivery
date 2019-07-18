<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Produto Entity
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $ambiente_producao_responsavel
 * @property int $ambiente_venda
 * @property int $midia_id
 * @property string $nome_produto
 * @property int $categorias_produto_id
 * @property string|null $descricao_produto
 * @property float|null $preco_produto
 * @property bool|null $ativo_produto
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\CategoriasProduto $categorias_produto
 * @property \App\Model\Entity\Empresa $empresa
 * @property \App\Model\Entity\Midia $midia
 */
class Produto extends Entity
{
    const VENDA_AMBOS = 1;
    const VENDA_COMANDA = 2;
    const VENDA_DELIVERY = 3;

    public static function getAmbienteVendaList(){
        return [
          self::VENDA_AMBOS => 'Ambos',
          self::VENDA_COMANDA => 'Somente Comanda',
          self::VENDA_DELIVERY => 'Somente Delivery',
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
        'nome_produto' => true,
        'midia_id' => true,
        'empresa_id' => true,
        'ambiente_producao_responsavel' => true,
        'ambiente_venda' => true,
        'categorias_produto_id' => true,
        'descricao_produto' => true,
        'preco_produto' => true,
        'ativo_produto' => true,
        'created' => true,
        'modified' => true,
        'empresa' => true,
        'midia' => true,
        'categorias_produto' => true
    ];
}
