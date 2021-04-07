<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tweak Entity
 *
 * @property int $id
 * @property string $vendor
 * @property string $name
 * @property string $protocols
 * @property string $injection_type
 * @property string $payload
 * @property string $note
 *
 * @property \App\Model\Entity\Realm[] $realms
 */
class Tweak extends Entity
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
        'vendor' => true,
        'name' => true,
        'protocols' => true,
        'injection_type' => true,
        'payload' => true,
        'note' => true,
        'realms' => true,
    ];
}
