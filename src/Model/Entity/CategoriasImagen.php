<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CategoriasImagen Entity
 *
 * @property int $categoria_id
 * @property int $nome_imagem
 *
 * @property \App\Model\Entity\Categoria $categoria
 */
class CategoriasImagen extends Entity
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
        'categoria_id' => true,
        'nome_imagem' => true,
        'categoria' => true
    ];
}
