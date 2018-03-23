<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Message Entity
 *
 * @property int $m_id
 * @property int $m_sender
 * @property int $m_receiver
 * @property string $m_content
 * @property \Cake\I18n\FrozenTime $m_created
 *
 * @property \App\Model\Entity\M $m
 */
class Message extends Entity
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
        'm_id' => false
    ];
}
