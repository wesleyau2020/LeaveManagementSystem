<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LeaveRequest Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $leave_type_id
 * @property \Cake\I18n\FrozenDate $start_of_leave
 * @property \Cake\I18n\FrozenDate $end_of_leave
 * @property int $num_days
 * @property string $year
 * @property string $description
 * @property string $status
 * @property string $remark
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\LeaveType $leave_type
 */
class LeaveRequest extends Entity
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
        'start_of_leave' => true,
        'end_of_leave' => true,
        'num_days' => true,
        'year' => true,
        'description' => true,
        'status' => true,
        'remark' => true,
        'user' => true,
        'leave_type' => true,
    ];
}
