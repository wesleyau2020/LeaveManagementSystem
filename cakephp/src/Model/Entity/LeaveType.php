<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LeaveType Entity
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property int|null $leave_type_id
 * @property float $cost
 * @property float|null $entitled
 * @property float|null $earned
 *
 * @property \App\Model\Entity\LeaveType[] $leave_types
 * @property \App\Model\Entity\LeaveDetail[] $leave_details
 * @property \App\Model\Entity\LeaveRequest[] $leave_requests
 */
class LeaveType extends Entity
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
        'name' => true,
        'type' => true,
        'leave_type_id' => true,
        'cost' => true,
        'entitled' => true,
        'earned' => true,
        'leave_types' => true,
        'leave_details' => true,
        'leave_requests' => true,
    ];
}
