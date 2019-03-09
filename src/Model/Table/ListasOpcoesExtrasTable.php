<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ListasOpcoesExtras Model
 *
 * @property \App\Model\Table\ListasTable|\Cake\ORM\Association\BelongsTo $Listas
 * @property \App\Model\Table\OpcoesExtrasTable|\Cake\ORM\Association\BelongsTo $OpcoesExtras
 *
 * @method \App\Model\Entity\ListasOpcoesExtra get($primaryKey, $options = [])
 * @method \App\Model\Entity\ListasOpcoesExtra newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ListasOpcoesExtra[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ListasOpcoesExtra|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ListasOpcoesExtra|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ListasOpcoesExtra patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ListasOpcoesExtra[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ListasOpcoesExtra findOrCreate($search, callable $callback = null, $options = [])
 */
class ListasOpcoesExtrasTable extends Table
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

        $this->setTable('listas_opcoes_extras');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Listas', [
            'foreignKey' => 'lista_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('OpcoesExtras', [
            'foreignKey' => 'opcoes_extra_id',
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
            ->boolean('ativa')
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
        $rules->add($rules->existsIn(['lista_id'], 'Listas'));
        $rules->add($rules->existsIn(['opcoes_extra_id'], 'OpcoesExtras'));

        return $rules;
    }
}
