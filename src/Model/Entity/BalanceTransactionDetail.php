<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BalanceTransactionDetail Entity
 *
 * @property int $id
 * @property string $transaction
 * @property int $sender_user_id
 * @property int $user_id
 * @property int $realm_id
 * @property int $profile_id
 * @property int|null $payable
 * @property int|null $receivable
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Realm $realm
 * @property \App\Model\Entity\Profile $profile
 */
class BalanceTransactionDetail extends Entity
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
        'sender_user_id' => true,
        'user_id' => true,
        'realm_id' => true,
        'profile_id' => true,
        'payable' => true,
        'receivable' => true,
        'created' => true,
        'modified' => true,
        'sender_user' => true,
        'user' => true,
        'realm' => true,
        'profile' => true,
    ];
}
