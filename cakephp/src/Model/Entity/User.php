<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $num_annual_leave
 * @property int $num_medical_leave
 * @property int $num_hospital_leave
 * @property bool $is_admin
 * @property int|null $admin_level
 *
 * @property \App\Model\Entity\LeaveDetail[] $leave_details
 * @property \App\Model\Entity\LeaveRequest[] $leave_requests
 */
class User extends Entity
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
        'username' => true,
        'password' => true,
        'num_annual_leave' => true,
        'num_medical_leave' => true,
        'num_hospital_leave' => true,
        'is_admin' => true,
        'admin_level' => true,
        'leave_details' => true,
        'leave_requests' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
    ];
}
