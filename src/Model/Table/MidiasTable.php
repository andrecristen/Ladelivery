<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Midias Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Empresas
 *
 * @method \App\Model\Entity\Midia get($primaryKey, $options = [])
 * @method \App\Model\Entity\Midia newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Midia[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Midia|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Midia|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Midia patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Midia[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Midia findOrCreate($search, callable $callback = null, $options = [])
 */
class MidiasTable extends Table
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

        $this->setTable('midias');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Empresas', [
            'foreignKey' => 'empresa_id',
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
            ->integer('tipo_midia')
            ->requirePresence('tipo_midia', 'create')
            ->allowEmptyString('tipo_midia', false);

        $validator
            ->scalar('path_midia')
            ->maxLength('path_midia', 600)
            ->requirePresence('path_midia', 'create')
            ->allowEmptyString('path_midia', false)
            ->add('path_midia', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('nome_midia')
            ->maxLength('nome_midia', 600)
            ->requirePresence('nome_midia', 'create')
            ->allowEmptyString('nome_midia', false);

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
        $rules->add($rules->isUnique(['path_midia']));
        $rules->add($rules->existsIn(['empresa_id'], 'Empresas'));

        return $rules;
    }
}
