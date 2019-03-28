<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Listas Model
 *
 * @property \App\Model\Table\OpcoesExtrasTable|\Cake\ORM\Association\BelongsToMany $OpcoesExtras
 * @property \App\Model\Table\EmpresasTable|\Cake\ORM\Association\BelongsTo $Empresas
 *
 * @method \App\Model\Entity\Lista get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lista newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Lista[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lista|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lista|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lista patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lista[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lista findOrCreate($search, callable $callback = null, $options = [])
 */
class ListasTable extends Table
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

        $this->setTable('listas');
        $this->setDisplayField('nome_lista');
        $this->setPrimaryKey('id');

        $this->belongsToMany('OpcoesExtras', [
            'foreignKey' => 'lista_id',
            'targetForeignKey' => 'opcoes_extra_id',
            'joinTable' => 'listas_opcoes_extras'
        ]);

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
            ->scalar('nome_lista')
            ->maxLength('nome_lista', 200)
            ->requirePresence('nome_lista', 'create')
            ->allowEmptyString('nome_lista', false);

        $validator
            ->scalar('descricao_lista')
            ->requirePresence('descricao_lista', 'create')
            ->allowEmptyString('descricao_lista', false);

        $validator
            ->scalar('titulo_lista')
            ->maxLength('titulo_lista', 50)
            ->requirePresence('titulo_lista', 'create')
            ->allowEmptyString('titulo_lista', false);

        $validator
            ->integer('max_opcoes_selecionadas_lista')
            ->allowEmptyString('max_opcoes_selecionadas_lista');
        $validator
            ->integer('min_opcoes_selecionadas_lista')
            ->allowEmptyString('min_opcoes_selecionadas_lista');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['empresa_id'], 'Empresas'));

        return $rules;
    }
}
