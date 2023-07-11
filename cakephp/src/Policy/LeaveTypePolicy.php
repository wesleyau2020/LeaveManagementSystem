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
     * Check if $user can access templates/LeaveTypes/index.php
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveType $leaveType
     * @return bool
     */
    public function canIndex(IdentityInterface $user, LeaveType $leaveType)
    {
        return $this->isAdmin($user, $leaveType);
    }

    /**
     * Check if $user can add LeaveType
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveType $leaveType
     * @return bool
     */
    public function canAdd(IdentityInterface $user, LeaveType $leaveType)
    {
        return $this->isAdmin($user, $leaveType);
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
        return $this->isAdmin($user, $leaveType);
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
        return $this->isAdmin($user, $leaveType);
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
        return $this->isAdmin($user, $leaveType);
    }

    protected function isAdmin(IdentityInterface $user, LeaveType $leaveType)
    {
        return $user->is_admin === TRUE;
    }
}
