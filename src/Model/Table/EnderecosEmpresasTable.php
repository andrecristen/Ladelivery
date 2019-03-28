<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EnderecosEmpresas Model
 *
 * @property \App\Model\Table\EmpresasTable|\Cake\ORM\Association\BelongsTo $Empresas
 *
 * @method \App\Model\Entity\EnderecosEmpresa get($primaryKey, $options = [])
 * @method \App\Model\Entity\EnderecosEmpresa newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EnderecosEmpresa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EnderecosEmpresa|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EnderecosEmpresa|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EnderecosEmpresa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EnderecosEmpresa[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EnderecosEmpresa findOrCreate($search, callable $callback = null, $options = [])
 */
class EnderecosEmpresasTable extends Table
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

        $this->setTable('enderecos_empresas');
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
            ->scalar('rua')
            ->maxLength('rua', 500)
            ->requirePresence('rua', 'create')
            ->allowEmptyString('rua', false);

        $validator
            ->integer('numero')
            ->requirePresence('numero', 'create')
            ->allowEmptyString('numero', false);

        $validator
            ->scalar('bairro')
            ->maxLength('bairro', 200)
            ->requirePresence('bairro', 'create')
            ->allowEmptyString('bairro', false);

        $validator
            ->scalar('cidade')
            ->maxLength('cidade', 200)
            ->requirePresence('cidade', 'create')
            ->allowEmptyString('cidade', false);

        $validator
            ->scalar('estado')
            ->maxLength('estado', 50)
            ->requirePresence('estado', 'create')
            ->allowEmptyString('estado', false);

        $validator
            ->scalar('cep')
            ->maxLength('cep', 10)
            ->requirePresence('cep', 'create')
            ->allowEmptyString('cep', false);

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
