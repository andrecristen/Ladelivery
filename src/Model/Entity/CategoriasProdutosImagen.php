<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CategoriasProdutosImagen Entity
 *
 * @property int $categorias_produto_id
 * @property int $nome_imagem
 *
 * @property \App\Model\Entity\CategoriasProduto $categorias_produto
 */
class CategoriasProdutosImagen extends Entity
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
        'categorias_produto_id' => true,
        'nome_imagem' => true,
        'categorias_produto' => true
    ];
}
