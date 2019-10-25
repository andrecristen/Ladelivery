<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SituacaoPedidoNotificacao Model
 *
 * @method \App\Model\Entity\SituacaoPedidoNotificacao get($primaryKey, $options = [])
 * @method \App\Model\Entity\SituacaoPedidoNotificacao newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SituacaoPedidoNotificacao[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SituacaoPedidoNotificacao|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SituacaoPedidoNotificacao|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SituacaoPedidoNotificacao patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SituacaoPedidoNotificacao[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SituacaoPedidoNotificacao findOrCreate($search, callable $callback = null, $options = [])
 */
class SituacaoPedidoNotificacaoTable extends Table
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

        $this->setTable('situacao_pedido_notificacao');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->integer('situacao_pedido')
            ->requirePresence('situacao_pedido', 'create')
            ->allowEmptyString('situacao_pedido', false)
            ->add('situacao_pedido', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('template_titulo')
            ->requirePresence('template_titulo', 'create')
            ->allowEmptyString('template_titulo', false);

        $validator
            ->scalar('template_mensagem')
            ->requirePresence('template_mensagem', 'create')
            ->allowEmptyString('template_mensagem', false);

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
        $rules->add($rules->isUnique(['situacao_pedido']));

        return $rules;
    }
}
