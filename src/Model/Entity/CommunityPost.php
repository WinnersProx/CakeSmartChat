<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Community Entity
 *
 * @property int $community_id
 * @property int $creater_id
 * @property string $community_name
 * @property \Cake\I18n\FrozenTime $created_time
 *
 * @property \App\Model\Entity\Community $community
 * @property \App\Model\Entity\User $user
 */
class CommunityPost extends Entity
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
        '*' => true,
        'id' => false
    ];
}
