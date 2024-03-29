<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TemposMedios Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Empresas
 *
 * @method \App\Model\Entity\TemposMedio get($primaryKey, $options = [])
 * @method \App\Model\Entity\TemposMedio newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TemposMedio[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TemposMedio|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TemposMedio|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TemposMedio patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TemposMedio[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TemposMedio findOrCreate($search, callable $callback = null, $options = [])
 */
class TemposMediosTable extends Table
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

        $this->setTable('tempos_medios');
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
            ->scalar('nome')
            ->maxLength('nome', 150)
            ->requirePresence('nome', 'create')
            ->allowEmptyString('nome', false);

        $validator
            ->requirePresence('tipo', 'create')
            ->allowEmptyString('tipo', false);

        $validator
            ->integer('tempo_medio_producao_minutos')
            ->requirePresence('tempo_medio_producao_minutos', 'create')
            ->allowEmptyString('tempo_medio_producao_minutos', false);

        $validator
            ->boolean('ativo')
            ->requirePresence('ativo', 'create')
            ->allowEmptyString('ativo', false);

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
        $rules->add($rules->existsIn(['empresa_id'], 'Empresas'));

        return $rules;
    }
}
