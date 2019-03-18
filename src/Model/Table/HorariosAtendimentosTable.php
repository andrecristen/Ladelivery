<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HorariosAtendimentos Model
 *
 * @property \App\Model\Table\EmpresasTable|\Cake\ORM\Association\BelongsTo $Empresas
 *
 * @method \App\Model\Entity\HorariosAtendimento get($primaryKey, $options = [])
 * @method \App\Model\Entity\HorariosAtendimento newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HorariosAtendimento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HorariosAtendimento|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HorariosAtendimento|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HorariosAtendimento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HorariosAtendimento[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HorariosAtendimento findOrCreate($search, callable $callback = null, $options = [])
 */
class HorariosAtendimentosTable extends Table
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

        $this->setTable('horarios_atendimentos');
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
            ->integer('dia_semana')
            ->requirePresence('dia_semana', 'create')
            ->allowEmptyString('dia_semana', false);

        $validator
            ->integer('turno')
            ->requirePresence('turno', 'create')
            ->allowEmptyString('turno', false);

        $validator
            ->time('hora_inicio')
            ->requirePresence('hora_inicio', 'create')
            ->allowEmptyTime('hora_inicio', false);

        $validator
            ->time('hora_fim')
            ->requirePresence('hora_fim', 'create')
            ->allowEmptyTime('hora_fim', false);

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
