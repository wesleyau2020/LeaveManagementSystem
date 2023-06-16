<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\LeaveDetails;
use Authorization\IdentityInterface;

/**
 * LeaveDetails policy
 */
class LeaveDetailsPolicy
{
    /**
     * Check if $user can add LeaveDetails
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveDetails $leaveDetails
     * @return bool
     */
    public function canAdd(IdentityInterface $user, LeaveDetails $leaveDetails)
    {
    }

    /**
     * Check if $user can edit LeaveDetails
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveDetails $leaveDetails
     * @return bool
     */
    public function canEdit(IdentityInterface $user, LeaveDetails $leaveDetails)
    {
    }

    /**
     * Check if $user can delete LeaveDetails
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveDetails $leaveDetails
     * @return bool
     */
    public function canDelete(IdentityInterface $user, LeaveDetails $leaveDetails)
    {
    }

    /**
     * Check if $user can view LeaveDetails
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveDetails $leaveDetails
     * @return bool
     */
    public function canView(IdentityInterface $user, LeaveDetails $leaveDetails)
    {
    }
}
