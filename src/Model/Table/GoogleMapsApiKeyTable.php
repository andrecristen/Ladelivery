<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GoogleMapsApiKey Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\GoogleMapsApiKey get($primaryKey, $options = [])
 * @method \App\Model\Entity\GoogleMapsApiKey newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GoogleMapsApiKey[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GoogleMapsApiKey|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GoogleMapsApiKey|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GoogleMapsApiKey patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GoogleMapsApiKey[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GoogleMapsApiKey findOrCreate($search, callable $callback = null, $options = [])
 */
class GoogleMapsApiKeyTable extends Table
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

        $this->setTable('google_maps_api_key');
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
            ->scalar('api_key')
            ->maxLength('api_key', 500)
            ->requirePresence('api_key', 'create')
            ->allowEmptyString('api_key', false);

        $validator
            ->integer('ativa')
            ->requirePresence('ativa', 'create')
            ->allowEmptyString('ativa', false);

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
