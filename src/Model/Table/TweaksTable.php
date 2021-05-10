<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tweaks Model
 *
 * @property &\Cake\ORM\Association\HasMany $TweakRealms
 *
 * @method \App\Model\Entity\Tweak get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tweak newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Tweak[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tweak|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tweak saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tweak patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tweak[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tweak findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TweaksTable extends Table
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

        $this->setTable('tweaks');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('TweakRealms', [
            'foreignKey' => 'tweak_id',
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
            ->scalar('vendor')
            ->maxLength('vendor', 50)
            ->requirePresence('vendor', 'create')
            ->notEmptyString('vendor');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('protocols')
            ->maxLength('protocols', 50)
            ->requirePresence('protocols', 'create')
            ->notEmptyString('protocols');

        $validator
            ->scalar('injection_type')
            ->maxLength('injection_type', 50)
            ->requirePresence('injection_type', 'create')
            ->notEmptyString('injection_type');

        $validator
            ->scalar('payload')
            ->maxLength('payload', 50)
            ->requirePresence('payload', 'create')
            ->notEmptyString('payload');

        $validator
            ->scalar('note')
            ->maxLength('note', 50)
            ->requirePresence('note', 'create')
            ->notEmptyString('note');

        return $validator;
    }
}
