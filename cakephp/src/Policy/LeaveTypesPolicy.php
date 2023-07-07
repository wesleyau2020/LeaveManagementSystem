<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\LeaveType;
use Authorization\IdentityInterface;

/**
 * LeaveType policy
 */
class LeaveTypePolicy
{
    /**
     * Check if $user can add LeaveType
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveType $leaveType
     * @return bool
     */
    public function canAdd(IdentityInterface $user, LeaveType $leaveType)
    {
        return $this->isAdmin($user, $resource);
    }

    /**
     * Check if $user can edit LeaveType
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveType $leaveType
     * @return bool
     */
    public function canEdit(IdentityInterface $user, LeaveType $leaveType)
    {
        return $this->isAdmin($user, $resource);
    }

    /**
     * Check if $user can delete LeaveType
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveType $leaveType
     * @return bool
     */
    public function canDelete(IdentityInterface $user, LeaveType $leaveType)
    {
        return $this->isAdmin($user, $resource);
    }

    /**
     * Check if $user can view LeaveType
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveType $leaveType
     * @return bool
     */
    public function canView(IdentityInterface $user, LeaveType $leaveType)
    {
        return $this->isAdmin($user, $resource);
    }

    protected function isAdmin(IdentityInterface $user, User $resource)
    {
        return $user->is_admin === TRUE;
    }
}
