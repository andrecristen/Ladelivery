<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Perfils Model
 *
 * @method \App\Model\Entity\Perfil get($primaryKey, $options = [])
 * @method \App\Model\Entity\Perfil newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Perfil[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Perfil|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Perfil|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Perfil patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Perfil[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Perfil findOrCreate($search, callable $callback = null, $options = [])
 */
class PerfilsTable extends Table
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

        $this->setTable('perfils');
        $this->setDisplayField('nome_perfil');
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
            ->scalar('nome_perfil')
            ->maxLength('nome_perfil', 300)
            ->requirePresence('nome_perfil', 'create')
            ->allowEmptyString('nome_perfil', false);

        $validator
            ->boolean('padrao_novos_users')
            ->requirePresence('padrao_novos_users', 'create')
            ->allowEmptyString('padrao_novos_users', false);

        return $validator;
    }
}
