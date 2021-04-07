<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TweakRealms Model
 *
 * @property \App\Model\Table\TweaksTable&\Cake\ORM\Association\BelongsTo $Tweaks
 * @property \App\Model\Table\RealmsTable&\Cake\ORM\Association\BelongsTo $Realms
 *
 * @method \App\Model\Entity\TweakRealm get($primaryKey, $options = [])
 * @method \App\Model\Entity\TweakRealm newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TweakRealm[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TweakRealm|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TweakRealm saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TweakRealm patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TweakRealm[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TweakRealm findOrCreate($search, callable $callback = null, $options = [])
 */
class TweakRealmsTable extends Table
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

        $this->setTable('tweak_realms');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Tweaks', [
            'foreignKey' => 'tweak_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Realms', [
            'foreignKey' => 'realm_id',
            'joinType' => 'INNER',
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
        $rules->add($rules->existsIn(['tweak_id'], 'Tweaks'));
        $rules->add($rules->existsIn(['realm_id'], 'Realms'));

        return $rules;
    }
}
