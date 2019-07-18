<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TaxasEntregasCotacao Model
 *
 * @property \App\Model\Table\EmpresasTable|\Cake\ORM\Association\BelongsTo $Empresas
 *
 * @method \App\Model\Entity\TaxasEntregasCotacao get($primaryKey, $options = [])
 * @method \App\Model\Entity\TaxasEntregasCotacao newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TaxasEntregasCotacao[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TaxasEntregasCotacao|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TaxasEntregasCotacao|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TaxasEntregasCotacao patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TaxasEntregasCotacao[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TaxasEntregasCotacao findOrCreate($search, callable $callback = null, $options = [])
 */
class TaxasEntregasCotacaoTable extends Table
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

        $this->setTable('taxas_entregas_cotacao');
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
            ->decimal('valor_km')
            ->requirePresence('valor_km', 'create')
            ->allowEmptyString('valor_km', false);

        $validator
            ->integer('arredondamento_tipo')
            ->allowEmptyString('arredondamento_tipo');

        $validator
            ->boolean('ativo')
            ->requirePresence('ativo', 'create')
            ->allowEmptyString('ativo', false);

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['empresa_id'], 'Empresas'));

        return $rules;
    }
}
