<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LeaveDetail Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $leave_type_id
 * @property string $year
 * @property float $carried_over
 * @property float $max_carry_over
 * @property float $entitled
 * @property float $balance
 * @property float $earned
 *
 * @property \App\Model\Entity\User $user
 */
class LeaveDetail extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'user_id' => true,
        'leave_type_id' => true,
        'year' => true,
        'carried_over' => true,
        'max_carry_over' => true,
        'entitled' => true,
        'balance' => true,
        'earned' => true,
        'user' => true,
    ];
}
