<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProdutosAvaliacoes Model
 *
 * @property \App\Model\Table\ProdutosTable|\Cake\ORM\Association\BelongsTo $Produtos
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\ProdutosAvaliaco get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProdutosAvaliaco newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProdutosAvaliaco[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProdutosAvaliaco|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProdutosAvaliaco|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProdutosAvaliaco patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProdutosAvaliaco[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProdutosAvaliaco findOrCreate($search, callable $callback = null, $options = [])
 */
class ProdutosAvaliacoesTable extends Table
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

        $this->setTable('produtos_avaliacoes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Produtos', [
            'foreignKey' => 'produto_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->integer('nota')
            ->requirePresence('nota', 'create')
            ->allowEmptyString('nota', false);

        $validator
            ->scalar('comentario')
            ->maxLength('comentario', 500)
            ->requirePresence('comentario', 'create')
            ->allowEmptyString('comentario', false);

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
