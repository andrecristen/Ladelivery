<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PerfilsActions Model
 *
 * @property \App\Model\Table\ActionsTable|\Cake\ORM\Association\BelongsTo $Actions
 * @property \App\Model\Table\PerfilsTable|\Cake\ORM\Association\BelongsTo $Perfils
 *
 * @method \App\Model\Entity\PerfilsAction get($primaryKey, $options = [])
 * @method \App\Model\Entity\PerfilsAction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PerfilsAction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PerfilsAction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PerfilsAction|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PerfilsAction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PerfilsAction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PerfilsAction findOrCreate($search, callable $callback = null, $options = [])
 */
class PerfilsActionsTable extends Table
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

        $this->setTable('perfils_actions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Actions', [
            'foreignKey' => 'action_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Perfils', [
            'foreignKey' => 'perfil_id',
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
        $rules->add($rules->existsIn(['action_id'], 'Actions'));
        $rules->add($rules->existsIn(['perfil_id'], 'Perfils'));

        return $rules;
    }
}
