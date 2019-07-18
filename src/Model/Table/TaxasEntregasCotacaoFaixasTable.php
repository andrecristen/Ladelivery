<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TaxasEntregasCotacaoFaixas Model
 *
 * @property \App\Model\Table\EmpresasTable|\Cake\ORM\Association\BelongsTo $Empresas
 *
 * @method \App\Model\Entity\TaxasEntregasCotacaoFaixa get($primaryKey, $options = [])
 * @method \App\Model\Entity\TaxasEntregasCotacaoFaixa newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TaxasEntregasCotacaoFaixa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TaxasEntregasCotacaoFaixa|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TaxasEntregasCotacaoFaixa|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TaxasEntregasCotacaoFaixa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TaxasEntregasCotacaoFaixa[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TaxasEntregasCotacaoFaixa findOrCreate($search, callable $callback = null, $options = [])
 */
class TaxasEntregasCotacaoFaixasTable extends Table
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

        $this->setTable('taxas_entregas_cotacao_faixas');
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
            ->integer('kilometro_inicio')
            ->requirePresence('kilometro_inicio', 'create')
            ->allowEmptyString('kilometro_inicio', false);

        $validator
            ->integer('kilometro_fim')
            ->requirePresence('kilometro_fim', 'create')
            ->allowEmptyString('kilometro_fim', false);

        $validator
            ->decimal('valor')
            ->requirePresence('valor', 'create')
            ->allowEmptyString('valor', false);

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
