<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DiasFechados Model
 *
 * @property \App\Model\Table\EmpresasTable|\Cake\ORM\Association\BelongsTo $Empresas
 *
 * @method \App\Model\Entity\DiasFechado get($primaryKey, $options = [])
 * @method \App\Model\Entity\DiasFechado newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DiasFechado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DiasFechado|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DiasFechado|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DiasFechado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DiasFechado[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DiasFechado findOrCreate($search, callable $callback = null, $options = [])
 */
class DiasFechadosTable extends Table
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

        $this->setTable('dias_fechados');
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
            ->date('dia_fechado')
            ->requirePresence('dia_fechado', 'create')
            ->allowEmptyDate('dia_fechado', false);

        $validator
            ->scalar('motivo_fechado')
            ->maxLength('motivo_fechado', 250)
            ->allowEmptyString('motivo_fechado');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['empresa_id'], 'Empresas'));
        return $rules;
    }
}
