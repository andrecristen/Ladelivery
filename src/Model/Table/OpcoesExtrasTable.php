<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OpcoesExtras Model
 *
 * @property \App\Model\Table\ListasTable|\Cake\ORM\Association\BelongsToMany $Listas
 *
 * @method \App\Model\Entity\OpcoesExtra get($primaryKey, $options = [])
 * @method \App\Model\Entity\OpcoesExtra newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OpcoesExtra[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OpcoesExtra|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OpcoesExtra|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OpcoesExtra patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OpcoesExtra[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OpcoesExtra findOrCreate($search, callable $callback = null, $options = [])
 */
class OpcoesExtrasTable extends Table
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

        $this->setTable('opcoes_extras');
        $this->setDisplayField('nome_adicional');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Listas', [
            'foreignKey' => 'opcoes_extra_id',
            'targetForeignKey' => 'lista_id',
            'joinTable' => 'listas_opcoes_extras'
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
            ->scalar('nome_adicional')
            ->maxLength('nome_adicional', 200)
            ->requirePresence('nome_adicional', 'create')
            ->allowEmptyString('nome_adicional', false);

        $validator
            ->scalar('descricao_adicional')
            ->requirePresence('descricao_adicional', 'create')
            ->allowEmptyString('descricao_adicional', false);

        $validator
            ->decimal('valor_adicional')
            ->requirePresence('valor_adicional', 'create')
            ->allowEmptyString('valor_adicional', false);

        return $validator;
    }
}
