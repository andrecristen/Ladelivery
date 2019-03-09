<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItensCarrinhos Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ProdutosTable|\Cake\ORM\Association\BelongsTo $Produtos
 *
 * @method \App\Model\Entity\ItensCarrinho get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItensCarrinho newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItensCarrinho[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItensCarrinho|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItensCarrinho|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItensCarrinho patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItensCarrinho[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItensCarrinho findOrCreate($search, callable $callback = null, $options = [])
 */
class ItensCarrinhosTable extends Table
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

        $this->setTable('itens_carrinhos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->integer('quantidades')
            ->requirePresence('quantidades', 'create')
            ->allowEmptyString('quantidades', false);

        $validator
            ->decimal('valor_total_cobrado')
            ->requirePresence('valor_total_cobrado', 'create')
            ->allowEmptyString('valor_total_cobrado', false);

        $validator
            ->scalar('observacao')
            ->maxLength('observacao', 500)
            ->allowEmptyString('observacao');

        $validator
            ->allowEmptyString('opicionais');

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
        $rules->add($rules->existsIn(['produto_id'], 'Produtos'));

        return $rules;
    }
}
