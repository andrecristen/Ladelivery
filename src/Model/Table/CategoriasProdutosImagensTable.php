<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CategoriasProdutosImagens Model
 *
 * @property \App\Model\Table\CategoriasProdutosTable|\Cake\ORM\Association\BelongsTo $CategoriasProdutos
 *
 * @method \App\Model\Entity\CategoriasProdutosImagen get($primaryKey, $options = [])
 * @method \App\Model\Entity\CategoriasProdutosImagen newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CategoriasProdutosImagen[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CategoriasProdutosImagen|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CategoriasProdutosImagen|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CategoriasProdutosImagen patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CategoriasProdutosImagen[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CategoriasProdutosImagen findOrCreate($search, callable $callback = null, $options = [])
 */
class CategoriasProdutosImagensTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('categorias_produtos_imagens');
        $this->setDisplayField('categorias_produto_id');
        $this->setPrimaryKey('categorias_produto_id');
        $this->belongsTo('CategoriasProdutos', [
            'foreignKey' => 'categorias_produto_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('nome_imagem')
            ->requirePresence('nome_imagem', 'create')
            ->allowEmptyFile('nome_imagem', false);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['categorias_produto_id'], 'CategoriasProdutos'));

        return $rules;
    }
}
