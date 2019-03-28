<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CupomSite Model
 *
 * @property \App\Model\Table\EmpresasTable|\Cake\ORM\Association\BelongsTo $Empresas
 *
 * @method \App\Model\Entity\CupomSite get($primaryKey, $options = [])
 * @method \App\Model\Entity\CupomSite newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CupomSite[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CupomSite|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CupomSite|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CupomSite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CupomSite[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CupomSite findOrCreate($search, callable $callback = null, $options = [])
 */
class CupomSiteTable extends Table
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

        $this->setTable('cupom_site');
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
            ->scalar('nome_cupom')
            ->maxLength('nome_cupom', 200)
            ->requirePresence('nome_cupom', 'create')
            ->allowEmptyString('nome_cupom', false);

        $validator
            ->integer('vezes_usado')
            ->allowEmptyString('vezes_usado');

        $validator
            ->integer('maximo_vezes_usar')
            ->requirePresence('maximo_vezes_usar', 'create')
            ->allowEmptyString('maximo_vezes_usar', false);

        $validator
            ->integer('valor_desconto')
            ->requirePresence('valor_desconto', 'create')
            ->allowEmptyString('valor_desconto', false);

        $validator
            ->boolean('porcentagem')
            ->requirePresence('porcentagem', 'create')
            ->allowEmptyString('porcentagem', false);

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['empresa_id'], 'Empresas'));

        return $rules;
    }
}
