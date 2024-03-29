<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Empresas Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\TemposMediosTable|\Cake\ORM\Association\HasMany $TemposMedios
 *
 * @method \App\Model\Entity\Empresa get($primaryKey, $options = [])
 * @method \App\Model\Entity\Empresa newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Empresa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Empresa|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Empresa|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Empresa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Empresa[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Empresa findOrCreate($search, callable $callback = null, $options = [])
 */
class EmpresasTable extends Table
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

        $this->setTable('empresas');
        $this->setDisplayField('nome_fantasia');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('TemposMedios', [
            'foreignKey' => 'empresa_id'
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
            ->scalar('nome_fantasia')
            ->maxLength('nome_fantasia', 250)
            ->requirePresence('nome_fantasia', 'create')
            ->allowEmptyString('nome_fantasia', false);

        $validator
            ->scalar('cnpj')
            ->maxLength('cnpj', 100)
            ->allowEmptyString('cnpj')
            ->add('cnpj', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('ie')
            ->maxLength('ie', 100)
            ->allowEmptyString('ie');

        $validator
            ->integer('tipo_empresa')
            ->requirePresence('tipo_empresa', 'create')
            ->allowEmptyString('tipo_empresa', false);

        $validator
            ->integer('tipo_frete')
            ->requirePresence('tipo_frete', 'create')
            ->allowEmptyString('tipo_frete', false);

        $validator
            ->boolean('ativa')
            ->requirePresence('ativa', 'create')
            ->allowEmptyString('ativa', false);

        $validator
            ->allowEmptyString('contatos');

        $validator
            ->decimal('valor_base_erro_frete')
            ->requirePresence('valor_base_erro_frete', 'create')
            ->allowEmptyString('valor_base_erro_frete', false);

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
        $rules->add($rules->isUnique(['cnpj'], 'Este CNPJ já está em uso.'));

        return $rules;
    }
}
