<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CategoriasProduto Entity
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $midia_id
 * @property string $nome_categoria
 * @property string|null $descricao_categoria
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Produto[] $produtos
 * @property \App\Model\Entity\Empresa $empresa
 * @property \App\Model\Entity\Midia $midia
 */
class CategoriasProduto extends Entity
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
        'nome_categoria' => true,
        'empresa_id' => true,
        'midia_id' => true,
        'descricao_categoria' => true,
        'created' => true,
        'modified' => true,
        'produtos' => true,
        'midia' => true,
        'empresa' => true,
    ];
}
