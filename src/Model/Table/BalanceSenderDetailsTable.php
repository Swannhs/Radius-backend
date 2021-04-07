<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BalanceSenderDetails Model
 *
 * @property \App\Model\Table\SenderUsersTable&\Cake\ORM\Association\BelongsTo $SenderUsers
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\RealmsTable&\Cake\ORM\Association\BelongsTo $Realms
 * @property \App\Model\Table\ProfilesTable&\Cake\ORM\Association\BelongsTo $Profiles
 *
 * @method \App\Model\Entity\BalanceSenderDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\BalanceSenderDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BalanceSenderDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BalanceSenderDetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BalanceSenderDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BalanceSenderDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BalanceSenderDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BalanceSenderDetail findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BalanceSenderDetailsTable extends Table
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

        $this->setTable('balance_sender_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SenderUsers', [
            'foreignKey' => 'sender_user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Realms', [
            'foreignKey' => 'realm_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Profiles', [
            'foreignKey' => 'profile_id',
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

        $validator
            ->scalar('transaction')
            ->maxLength('transaction', 50)
            ->requirePresence('transaction', 'create')
            ->notEmptyString('transaction');

        $validator
            ->integer('payable')
            ->allowEmptyString('payable');

        $validator
            ->integer('receivable')
            ->allowEmptyString('receivable');

        $validator
            ->integer('received')
            ->allowEmptyString('received');

        $validator
            ->integer('sent')
            ->allowEmptyString('sent');

        $validator
            ->boolean('status')
            ->allowEmptyString('status');

        $validator
            ->integer('reference')
            ->allowEmptyString('reference');

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
        $rules->add($rules->existsIn(['sender_user_id'], 'SenderUsers'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['realm_id'], 'Realms'));
        $rules->add($rules->existsIn(['profile_id'], 'Profiles'));

        return $rules;
    }
}
