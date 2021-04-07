<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TweakRealm Entity
 *
 * @property int $id
 * @property int $tweak_id
 * @property int $realm_id
 *
 * @property \App\Model\Entity\Tweak $tweak
 * @property \App\Model\Entity\Realm $realm
 */
class TweakRealm extends Entity
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
        'tweak_id' => true,
        'realm_id' => true,
        'tweak' => true,
        'realm' => true,
    ];
}
