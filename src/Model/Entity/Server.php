<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Server Entity
 *
 * @property int $id
 * @property string $type
 * @property string $name
 * @property string $cc
 * @property string $ip
 * @property string $ssl_port
 * @property string $proxy_port
 * @property string $api_server_port
 * @property string $note
 *
 * @property \App\Model\Entity\ServerRealm[] $server_realms
 */
class Server extends Entity
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
        'type' => true,
        'name' => true,
        'cc' => true,
        'ip' => true,
        'ssl_port' => true,
        'proxy_port' => true,
        'api_server_port' => true,
        'note' => true,
        'server_realms' => true,
    ];
}
