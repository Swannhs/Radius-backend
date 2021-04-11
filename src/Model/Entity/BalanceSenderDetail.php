<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BalanceSenderDetail Entity
 *
 * @property int $id
 * @property string $transaction
 * @property int $sender_user_id
 * @property int $user_id
 * @property int $realm_id
 * @property int $profile_id
 * @property int|null $payable
 * @property int|null $receivable
 * @property int|null $sent
 * @property bool|null $status
 * @property int|null $reference
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Realm $realm
 */
class BalanceSenderDetail extends Entity
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
        'received' => true,
        'sent' => true,
        'status' => true,
        'reference' => true,
        'created' => true,
        'modified' => true,
        'sender_user' => true,
        'user' => true,
        'realm' => true,
        'profile' => true,
    ];
}
