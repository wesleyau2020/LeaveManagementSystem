<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\LeaveDetail;
use Authorization\IdentityInterface;

/**
 * LeaveDetail policy
 */
class LeaveDetailPolicy
{
    /**
     * Check if $user can add LeaveDetail
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveDetail $leaveDetail
     * @return bool
     */
    public function canAdd(IdentityInterface $user, LeaveDetail $leaveDetail)
    {
        return $this->isAdmin($user, $leaveDetail);
    }

    /**
     * Check if $user can edit LeaveDetail
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveDetail $leaveDetail
     * @return bool
     */
    public function canEdit(IdentityInterface $user, LeaveDetail $leaveDetail)
    {
        return $this->isAdmin($user, $leaveDetail);
    }

    /**
     * Check if $user can delete LeaveDetail
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveDetail $leaveDetail
     * @return bool
     */
    public function canDelete(IdentityInterface $user, LeaveDetail $leaveDetail)
    {
        return $this->isAdmin($user, $leaveDetail);
    }

    /**
     * Check if $user can view LeaveDetail
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\LeaveDetail $leaveDetail
     * @return bool
     */
    public function canView(IdentityInterface $user, LeaveDetail $leaveDetail)
    {
        return $this->isAdmin($user, $leaveDetail);
    }

    protected function isAdmin(IdentityInterface $user, Workday $workday)
    {
        return $user->is_admin === TRUE;
    }
}
