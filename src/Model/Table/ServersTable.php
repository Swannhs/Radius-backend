<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Servers Model
 *
 * @property \App\Model\Table\ServerRealmsTable&\Cake\ORM\Association\HasMany $ServerRealms
 *
 * @method \App\Model\Entity\Server get($primaryKey, $options = [])
 * @method \App\Model\Entity\Server newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Server[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Server|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Server saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Server patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Server[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Server findOrCreate($search, callable $callback = null, $options = [])
 */
class ServersTable extends Table
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

        $this->setTable('servers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('ServerRealms', [
            'foreignKey' => 'server_id',
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('type')
            ->maxLength('type', 50)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('cc')
            ->maxLength('cc', 50)
            ->requirePresence('cc', 'create')
            ->notEmptyString('cc');

        $validator
            ->scalar('ip')
            ->maxLength('ip', 50)
            ->requirePresence('ip', 'create')
            ->notEmptyString('ip');

        $validator
            ->scalar('ssl_port')
            ->maxLength('ssl_port', 50)
            ->requirePresence('ssl_port', 'create')
            ->notEmptyString('ssl_port');

        $validator
            ->scalar('proxy_port')
            ->maxLength('proxy_port', 50)
            ->requirePresence('proxy_port', 'create')
            ->notEmptyString('proxy_port');

        $validator
            ->scalar('api_server_port')
            ->maxLength('api_server_port', 50)
            ->requirePresence('api_server_port', 'create')
            ->notEmptyString('api_server_port');

        $validator
            ->scalar('note')
            ->maxLength('note', 50)
            ->requirePresence('note', 'create')
            ->notEmptyString('note');

        return $validator;
    }
}
