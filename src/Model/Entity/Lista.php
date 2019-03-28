<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lista Entity
 *
 * @property int $id
 * @property int $empresa_id
 * @property string $nome_lista
 * @property string $descricao_lista
 * @property string $titulo_lista
 * @property int|null $max_opcoes_selecionadas_lista
 *
 * @property \App\Model\Entity\OpcoesExtra[] $opcoes_extras
 * @property \App\Model\Entity\Empresa $empresa
 */
class Lista extends Entity
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
        'nome_lista' => true,
        'empresa_id' => true,
        'descricao_lista' => true,
        'titulo_lista' => true,
        'max_opcoes_selecionadas_lista' => true,
        'min_opcoes_selecionadas_lista' => true,
        'opcoes_extras' => true,
        'empresa' => true,
    ];
}
