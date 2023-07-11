<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Holiday;
use Authorization\IdentityInterface;

/**
 * Holiday policy
 */
class HolidayPolicy
{
    /**
     * Check if $user can add Holiday
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Holiday $holiday
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Holiday $holiday)
    {
        return $this->isAdmin($user, $holiday);
    }

    /**
     * Check if $user can edit Holiday
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Holiday $holiday
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Holiday $holiday)
    {
        return $this->isAdmin($user, $holiday);
    }

    /**
     * Check if $user can delete Holiday
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Holiday $holiday
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Holiday $holiday)
    {
        return $this->isAdmin($user, $holiday);
    }

    /**
     * Check if $user can view Holiday
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Holiday $holiday
     * @return bool
     */
    public function canView(IdentityInterface $user, Holiday $holiday)
    {
        return $this->isAdmin($user, $holiday);
    }

    protected function isAdmin(IdentityInterface $user, Workday $workday)
    {
        return $user->is_admin === TRUE;
    }
}
