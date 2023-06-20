<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\LeaveRequests;
use Authorization\IdentityInterface;

/**
 * LeaveRequests policy
 */
class LeaveRequestsPolicy
{
    public function canIndex(IdentityInterface $user, LeaveRequests $leaveRequests)
    {
        return $this->isOwner($user, $resource);
    }

    /**
     * Check if $user can add LeaveRequests
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveRequests $leaveRequests
     * @return bool
     */
    public function canAdd(IdentityInterface $user, LeaveRequests $leaveRequests)
    {
        return $this->isOwner($user, $resource);
    }

    /**
     * Check if $user can edit LeaveRequests
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveRequests $leaveRequests
     * @return bool
     */
    public function canEdit(IdentityInterface $user, LeaveRequests $leaveRequests)
    {
        return $this->isOwner($user, $resource);
    }

    /**
     * Check if $user can delete LeaveRequests
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveRequests $leaveRequests
     * @return bool
     */
    public function canDelete(IdentityInterface $user, LeaveRequests $leaveRequests)
    {
        return $this->isOwner($user, $resource);
    }

    /**
     * Check if $user can view LeaveRequests
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveRequests $leaveRequests
     * @return bool
     */
    public function canView(IdentityInterface $user, LeaveRequests $leaveRequests)
    {
        return $this->isOwner($user, $resource);
    }

    protected function isAdmin(IdentityInterface $user, LeaveRequests $leaveRequests)
    {
        return $user->is_admin === true;
    }

    protected function isOwner(IdentityInterface $user, LeaveRequests $leaveRequests)
    {
        return $leaveRequests->id === $user->getIdentifier();
    }
}
