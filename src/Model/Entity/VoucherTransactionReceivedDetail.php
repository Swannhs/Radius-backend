<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VoucherTransactionReceivedDetail Entity
 *
 * @property int $id
 * @property string $transaction
 * @property int $receiver_user_id
 * @property int $user_id
 * @property int $realm_id
 * @property int $profile_id
 * @property int|null $credit
 * @property int|null $debit
 * @property int|null $quantity_rate
 * @property int|null $balance
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\ReceiverUser $receiver_user
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Realm $realm
 * @property \App\Model\Entity\Profile $profile
 */
class VoucherTransactionReceivedDetail extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'transaction' => true,
        'receiver_user_id' => true,
        'user_id' => true,
        'realm_id' => true,
        'profile_id' => true,
        'credit' => true,
        'debit' => true,
        'quantity_rate' => true,
        'balance' => true,
        'created' => true,
        'modified' => true,
        'receiver_user' => true,
        'user' => true,
        'realm' => true,
        'profile' => true,
    ];
}
