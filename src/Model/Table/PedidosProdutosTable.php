<?php
namespace App\Model\Table;

use App\Model\Entity\Pedido;
use App\Model\Entity\PedidosProduto;
use Cake\ORM\Locator\TableLocator;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PedidosProdutos Model
 *
 * @property \App\Model\Table\PedidosTable|\Cake\ORM\Association\BelongsTo $Pedidos
 * @property \App\Model\Table\ProdutosTable|\Cake\ORM\Association\BelongsTo $Produtos
 *
 * @method Table::afterSave(Event $event, EntityInterface $entity, ArrayObject $options)
 * @method \App\Model\Entity\PedidosProduto get($primaryKey, $options = [])
 * @method \App\Model\Entity\PedidosProduto newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PedidosProduto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PedidosProduto|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PedidosProduto|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PedidosProduto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PedidosProduto[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PedidosProduto findOrCreate($search, callable $callback = null, $options = [])
 */
class PedidosProdutosTable extends Table
{
    /**
     * Verifica se temos todos os itens produzidos, para entao alterar a situacao do pedido
     *
     * @param $event
     * @param $entity
     * @param $options
     */
    public function afterSave($event, $entity, $options) {
        $tableLocator = new TableLocator();
        $pedidosProdutos = $tableLocator->get('PedidosProdutos')->find()->where(['pedido_id' => $entity->pedido_id]);
        $itens = 0;
        $itensProduzidos = 0;
        foreach ($pedidosProdutos as $pedidosProduto){
            if($pedidosProduto->status == PedidosProduto::STATUS_PRODUCAO_CONCLUIDA){
                $itensProduzidos++;
            }
            $itens++;
        }
        if($itens == $itensProduzidos){
            $pedidoTable = $tableLocator->get('Pedidos');
            /** @var $pedido Pedido*/
            $pedido = $pedidoTable->find()->where(['id' => $entity->pedido_id])->first();
            if($pedido->tipo_pedido == Pedido::TIPO_PEDIDO_DELIVERY){
                if($pedido->getEntrega()){
                    $pedido->status_pedido = Pedido::STATUS_AGUARDANDO_ENTREGADOR;
                }else{
                    $pedido->status_pedido = Pedido::STATUS_AGUARDANDO_COLETA_CLIENTE;
                }
                $pedidoTable->save($pedido);
            }
        }
    }

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('pedidos_produtos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Pedidos', [
            'foreignKey' => 'pedido_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Produtos', [
            'foreignKey' => 'produto_id',
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
            ->integer('quantidade')
            ->requirePresence('quantidade', 'create')
            ->allowEmptyString('quantidade', false);

        $validator
            ->requirePresence('quantidade_produzida', 'create')
            ->allowEmptyString('quantidade_produzida', false);

        $validator
            ->decimal('valor_total_cobrado')
            ->requirePresence('valor_total_cobrado', 'create')
            ->allowEmptyString('valor_total_cobrado', false);

        $validator
            ->scalar('observacao')
            ->maxLength('observacao', 500)
            ->allowEmptyString('observacao');

        $validator
            ->allowEmptyString('opcionais');

        $validator
            ->integer('ambiente_producao_responsavel')
            ->requirePresence('ambiente_producao_responsavel', 'create')
            ->allowEmptyString('ambiente_producao_responsavel', false);

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->allowEmptyString('status', false);

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
        $rules->add($rules->existsIn(['pedido_id'], 'Pedidos'));
        $rules->add($rules->existsIn(['produto_id'], 'Produtos'));

        return $rules;
    }
}
