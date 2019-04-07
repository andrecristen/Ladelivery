<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PerfilsUsers Model
 *
 * @property \App\Model\Table\PerfilsTable|\Cake\ORM\Association\BelongsTo $Perfils
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\PerfilsUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\PerfilsUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PerfilsUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PerfilsUser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PerfilsUser|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PerfilsUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PerfilsUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PerfilsUser findOrCreate($search, callable $callback = null, $options = [])
 */
class PerfilsUsersTable extends Table
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

        $this->setTable('perfils_users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Perfils', [
            'foreignKey' => 'perfil_id',
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
        $rules->add($rules->existsIn(['perfil_id'], 'Perfils'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
