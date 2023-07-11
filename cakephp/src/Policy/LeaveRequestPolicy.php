<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\LeaveRequest;
use Authorization\IdentityInterface;

/**
 * LeaveRequest policy
 */
class LeaveRequestPolicy
{
    /**
     * Check if $user can add LeaveRequest
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveRequest $leaveRequest
     * @return bool
     */
    public function canAdd(IdentityInterface $user, LeaveRequest $leaveRequest)
    {
        return $this->isAdmin($user, $leaveRequest);
    }

    /**
     * Check if $user can edit LeaveRequest
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveRequest $leaveRequest
     * @return bool
     */
    public function canEdit(IdentityInterface $user, LeaveRequest $leaveRequest)
    {
        return $this->isAdmin($user, $leaveRequest);
    }

    /**
     * Check if $user can delete LeaveRequest
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveRequest $leaveRequest
     * @return bool
     */
    public function canDelete(IdentityInterface $user, LeaveRequest $leaveRequest)
    {
        return $this->isAdmin($user, $leaveRequest);
    }

    /**
     * Check if $user can view LeaveRequest
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveRequest $leaveRequest
     * @return bool
     */
    public function canView(IdentityInterface $user, LeaveRequest $leaveRequest)
    {
        return $this->isAdmin($user, $leaveRequest);
    }

    public function canSearch(IdentityInterface $user, LeaveRequest $leaveRequest)
    {
        return $this->isAdmin($user, $leaveRequest);
    }

    public function canDisplayApprovedRequests(IdentityInterface $user, LeaveRequest $leaveRequest)
    {
        return $this->isAdmin($user, $leaveRequest);
    }

    public function canDisplayRejectedRequests(IdentityInterface $user, LeaveRequest $leaveRequest)
    {
        return $this->isAdmin($user, $leaveRequest);
    }

    public function canApprove(IdentityInterface $user, LeaveRequest $leaveRequest)
    {
        return $this->isAdmin($user, $leaveRequest);
    }

    public function canReject(IdentityInterface $user, LeaveRequest $leaveRequest)
    {
        return $this->isAdmin($user, $leaveRequest);
    }

    protected function isAdmin(IdentityInterface $user, LeaveRequest $leaveRequest)
    {
        return $user->is_admin === TRUE;
    }
}
