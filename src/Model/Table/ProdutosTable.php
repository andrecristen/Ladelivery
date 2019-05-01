<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Produtos Model
 *
 * @property \App\Model\Table\CategoriasProdutosTable|\Cake\ORM\Association\BelongsTo $CategoriasProdutos
 * @property \App\Model\Table\EmpresasTable|\Cake\ORM\Association\BelongsTo $Empresas
 * @property \App\Model\Table\EmpresasTable|\Cake\ORM\Association\BelongsTo $Midias
 *
 * @method \App\Model\Entity\Produto get($primaryKey, $options = [])
 * @method \App\Model\Entity\Produto newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Produto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Produto|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Produto|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Produto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Produto[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Produto findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProdutosTable extends Table
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

        $this->setTable('produtos');
        $this->setDisplayField('nome_produto');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CategoriasProdutos', [
            'foreignKey' => 'categorias_produto_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Empresas', [
            'foreignKey' => 'empresa_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Midias', [
            'foreignKey' => 'midia_id',
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
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('nome_produto')
            ->maxLength('nome_produto', 200)
            ->requirePresence('nome_produto', 'create')
            ->allowEmptyString('nome_produto', false);

        $validator
            ->scalar('descricao_produto')
            ->allowEmptyString('descricao_produto');

        $validator
            ->decimal('preco_produto')
            ->allowEmptyString('preco_produto');

        $validator
            ->integer('ambiente_producao_responsavel')
            ->requirePresence('ambiente_producao_responsavel', 'create')
            ->allowEmptyString('ambiente_producao_responsavel', false);

        $validator
            ->boolean('ativo_produto')
            ->allowEmptyString('ativo_produto');

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
        $rules->add($rules->existsIn(['empresa_id'], 'Empresas'));
        $rules->add($rules->existsIn(['midia_id'], 'Midias'));

        return $rules;
    }
}
