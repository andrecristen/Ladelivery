<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FormasPagamentos Model
 *
 * @property \App\Model\Table\EmpresasTable|\Cake\ORM\Association\BelongsTo $Empresas
 *
 * @method \App\Model\Entity\FormasPagamento get($primaryKey, $options = [])
 * @method \App\Model\Entity\FormasPagamento newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FormasPagamento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FormasPagamento|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FormasPagamento|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FormasPagamento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FormasPagamento[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FormasPagamento findOrCreate($search, callable $callback = null, $options = [])
 */
class FormasPagamentosTable extends Table
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

        $this->setTable('formas_pagamentos');
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
            ->maxLength('nome', 200)
            ->requirePresence('nome', 'create')
            ->allowEmptyString('nome', false)
            ->add('nome', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->boolean('necesista_maquina_cartao')
            ->requirePresence('necesista_maquina_cartao', 'create')
            ->allowEmptyString('necesista_maquina_cartao', false);

        $validator
            ->boolean('necessita_troco')
            ->requirePresence('necessita_troco', 'create')
            ->allowEmptyString('necessita_troco', false);

        $validator
            ->decimal('aumenta_valor')
            ->requirePresence('aumenta_valor', 'create')
            ->allowEmptyString('aumenta_valor', false);

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
        $rules->add($rules->isUnique(['nome']));
        $rules->add($rules->existsIn(['empresa_id'], 'Empresas'));

        return $rules;
    }
}
