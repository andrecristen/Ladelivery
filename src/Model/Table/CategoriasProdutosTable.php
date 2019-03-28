<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CategoriasProdutos Model
 *
 * @property \App\Model\Table\ProdutosTable|\Cake\ORM\Association\HasMany $Produtos
 * @property \App\Model\Table\EmpresasTable|\Cake\ORM\Association\BelongsTo $Empresas
 *
 * @method \App\Model\Entity\CategoriasProduto get($primaryKey, $options = [])
 * @method \App\Model\Entity\CategoriasProduto newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CategoriasProduto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CategoriasProduto|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CategoriasProduto|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CategoriasProduto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CategoriasProduto[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CategoriasProduto findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CategoriasProdutosTable extends Table
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

        $this->setTable('categorias_produtos');
        $this->setDisplayField('nome_categoria');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Empresas', [
            'foreignKey' => 'empresa_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Produtos', [
            'foreignKey' => 'categorias_produto_id'
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
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('nome_categoria')
            ->maxLength('nome_categoria', 200)
            ->requirePresence('nome_categoria', 'create')
            ->allowEmptyString('nome_categoria', false);

        $validator
            ->scalar('descricao_categoria')
            ->allowEmptyString('descricao_categoria');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['empresa_id'], 'Empresas'));

        return $rules;
    }
}
