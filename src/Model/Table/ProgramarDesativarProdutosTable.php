<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProgramarDesativarProdutos Model
 *
 * @property \App\Model\Table\ProdutosTable|\Cake\ORM\Association\BelongsTo $Produtos
 *
 * @method \App\Model\Entity\ProgramarDesativarProduto get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProgramarDesativarProduto newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProgramarDesativarProduto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProgramarDesativarProduto|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProgramarDesativarProduto|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProgramarDesativarProduto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProgramarDesativarProduto[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProgramarDesativarProduto findOrCreate($search, callable $callback = null, $options = [])
 */
class ProgramarDesativarProdutosTable extends Table
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

        $this->setTable('programar_desativar_produtos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Produtos', [
            'foreignKey' => 'produto_id',
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
            ->integer('dia_semana')
            ->requirePresence('dia_semana', 'create')
            ->allowEmptyString('dia_semana', false);

        $validator
            ->boolean('programacao_ativa')
            ->requirePresence('programacao_ativa', 'create')
            ->allowEmptyString('programacao_ativa', false);

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
        $rules->add($rules->existsIn(['produto_id'], 'Produtos'));

        return $rules;
    }
}
