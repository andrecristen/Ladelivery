<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('nome_completo');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('nome_completo')
            ->maxLength('nome_completo', 500)
            ->requirePresence('nome_completo', 'create')
            ->allowEmptyString('nome_completo', false);

        $validator
            ->requirePresence('tipo', 'create')
            ->allowEmptyString('tipo', false);

        $validator
            ->scalar('apelido')
            ->maxLength('apelido', 200)
            ->allowEmptyString('apelido');

        $validator
            ->scalar('login')
            ->maxLength('login', 250)
            ->requirePresence('login', 'create')
            ->allowEmptyString('login', false)
            ->add('login', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Este endereço de email já está em uso.']);

        $validator
            ->scalar('password')
            ->maxLength('password', 500)
            ->requirePresence('password', 'create')
            ->allowEmptyString('password', false);

        $validator
            ->integer('dia_nascimento')
            ->requirePresence('dia_nascimento', 'create')
            ->allowEmptyString('dia_nascimento', false);

        $validator
            ->integer('mes_nascimento')
            ->requirePresence('mes_nascimento', 'create')
            ->allowEmptyString('mes_nascimento', false);

        $validator
            ->integer('ano_nascimento')
            ->requirePresence('ano_nascimento', 'create')
            ->allowEmptyString('ano_nascimento', false);
        $validator
            ->add(
                'confirm_password',
                'compareWith', [
                    'rule' => ['compareWith', 'password'],
                    'message' => 'Senhas diferentes, por favor digite senhas iguais'
                ]
            );
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
        $rules->add($rules->isUnique(['login']));

        return $rules;
    }

}
