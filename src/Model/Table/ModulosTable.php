<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Modulos Model
 *
 * @method \App\Model\Entity\Modulo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Modulo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Modulo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Modulo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Modulo|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Modulo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Modulo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Modulo findOrCreate($search, callable $callback = null, $options = [])
 */
class ModulosTable extends Table
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

        $this->setTable('modulos');
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
            ->scalar('nome')
            ->maxLength('nome', 255)
            ->requirePresence('nome', 'create')
            ->allowEmptyString('nome', false);

        $validator
            ->scalar('icon_class')
            ->maxLength('icon_class', 80)
            ->requirePresence('icon_class', 'create')
            ->allowEmptyString('icon_class', false);

        $validator
            ->integer('ordem')
            ->requirePresence('ordem', 'create')
            ->allowEmptyString('ordem', false);

        $validator
            ->boolean('ativo')
            ->requirePresence('ativo', 'create')
            ->allowEmptyString('ativo', false);

        return $validator;
    }
}
