<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AlteracaoSenhas Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\AlteracaoSenha get($primaryKey, $options = [])
 * @method \App\Model\Entity\AlteracaoSenha newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AlteracaoSenha[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AlteracaoSenha|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AlteracaoSenha|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AlteracaoSenha patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AlteracaoSenha[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AlteracaoSenha findOrCreate($search, callable $callback = null, $options = [])
 */
class AlteracaoSenhasTable extends Table
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

        $this->setTable('alteracao_senhas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

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
            ->scalar('token')
            ->maxLength('token', 300)
            ->requirePresence('token', 'create')
            ->allowEmptyString('token', false);

        $validator
            ->dateTime('validade')
            ->requirePresence('validade', 'create')
            ->allowEmptyDateTime('validade', false);

        $validator
            ->boolean('usado')
            ->allowEmptyString('usado');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
