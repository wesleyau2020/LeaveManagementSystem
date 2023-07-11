<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Workday;
use Authorization\IdentityInterface;

/**
 * Workday policy
 */
class WorkdayPolicy
{
    /**
     * Check if $user can add Workday
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Workday $workday
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Workday $workday)
    {
        return $this->isAdmin($user, $workday);
    }

    /**
     * Check if $user can edit Workday
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Workday $workday
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Workday $workday)
    {
        return $this->isAdmin($user, $workday);
    }

    /**
     * Check if $user can delete Workday
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Workday $workday
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Workday $workday)
    {
        return $this->isAdmin($user, $workday);
    }

    /**
     * Check if $user can view Workday
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Workday $workday
     * @return bool
     */
    public function canView(IdentityInterface $user, Workday $workday)
    {
        return $this->isAdmin($user, $workday);
    }

    protected function isAdmin(IdentityInterface $user, Workday $workday)
    {
        return $user->is_admin === TRUE;
    }
}
