<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ServerRealm Entity
 *
 * @property int $id
 * @property int $server_id
 * @property int $realm_id
 *
 * @property \App\Model\Entity\Server $server
 * @property \App\Model\Entity\Realm $realm
 */
class ServerRealm extends Entity
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
        'server_id' => true,
        'realm_id' => true,
        'server' => true,
        'realm' => true,
    ];
}
