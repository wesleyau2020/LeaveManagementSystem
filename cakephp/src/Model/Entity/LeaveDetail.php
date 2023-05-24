<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LeaveDetail Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $year
 * @property int $carried_over
 * @property int $max_carry_over
 * @property int $num_AL_given
 * @property int $num_AL_left
 * @property int $num_ML_given
 * @property int $num_ML_left
 * @property int $num_HL_given
 * @property int $num_HL_left
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
        'year' => true,
        'carried_over' => true,
        'max_carry_over' => true,
        'num_AL_given' => true,
        'num_AL_left' => true,
        'num_ML_given' => true,
        'num_ML_left' => true,
        'num_HL_given' => true,
        'num_HL_left' => true,
        'user' => true,
    ];
}
