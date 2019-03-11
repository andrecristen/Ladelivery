<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pedidos Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\PedidosEntregasTable|\Cake\ORM\Association\HasMany $PedidosEntregas
 * @property \App\Model\Table\ProdutosTable|\Cake\ORM\Association\BelongsToMany $Produtos
 *
 * @method \App\Model\Entity\Pedido get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pedido newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Pedido[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pedido|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pedido|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pedido patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pedido[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pedido findOrCreate($search, callable $callback = null, $options = [])
 */
class PedidosTable extends Table
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

        $this->setTable('pedidos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('FormasPagamentos', [
            'foreignKey' => 'formas_pagamento_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('PedidosEntregas', [
            'foreignKey' => 'pedido_id'
        ]);
        $this->belongsToMany('Produtos', [
            'foreignKey' => 'pedido_id',
            'targetForeignKey' => 'produto_id',
            'joinTable' => 'pedidos_produtos'
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
            ->decimal('valor_total_cobrado')
            ->requirePresence('valor_total_cobrado', 'create')
            ->allowEmptyString('valor_total_cobrado', false);

        $validator
            ->integer('tempo_producao_aproximado_minutos')
            ->allowEmptyString('tempo_producao_aproximado_minutos');

        $validator
            ->numeric('troco_para')
            ->requirePresence('troco_para', 'create')
            ->allowEmptyString('troco_para', false);

        $validator
            ->numeric('valor_desconto')
            ->requirePresence('valor_desconto', 'create')
            ->allowEmptyString('valor_desconto', false);

         $validator
             ->numeric('valor_acrescimo')
             ->requirePresence('valor_acrescimo', 'create')
             ->allowEmptyString('valor_acrescimo', false);

        $validator
            ->integer('tipo_pedido')
            ->requirePresence('tipo_pedido', 'create')
            ->allowEmptyString('tipo_pedido', false);

        $validator
            ->integer('status_pedido')
            ->requirePresence('status_pedido', 'create')
            ->allowEmptyString('status_pedido', false);

        $validator
            ->dateTime('data_pedido')
            ->requirePresence('data_pedido', 'create')
            ->allowEmptyDateTime('data_pedido', false);
        $validator
            ->scalar('cupom_usado')
            ->maxLength('cupom_usado', 200)
            ->allowEmptyString('cupom_usado');

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
        $rules->add($rules->existsIn(['formas_pagamento_id'], 'FormasPagamentos'));

        return $rules;
    }
}
