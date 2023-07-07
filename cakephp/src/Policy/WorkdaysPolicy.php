<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Workdays;
use Authorization\IdentityInterface;

/**
 * Workdays policy
 */
class WorkdaysPolicy
{
    /**
     * Check if $user can add Workdays
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Workdays $workdays
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Workdays $workdays)
    {
        return $this->isAdmin($user, $resource);
    }

    /**
     * Check if $user can edit Workdays
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Workdays $workdays
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Workdays $workdays)
    {
        return $this->isAdmin($user, $resource);
    }

    /**
     * Check if $user can delete Workdays
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Workdays $workdays
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Workdays $workdays)
    {
        return $this->isAdmin($user, $resource);
    }

    /**
     * Check if $user can view Workdays
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Workdays $workdays
     * @return bool
     */
    public function canView(IdentityInterface $user, Workdays $workdays)
    {
        return $this->isAdmin($user, $resource);
    }

    protected function isAdmin(IdentityInterface $user, User $resource)
    {
        return $user->is_admin === TRUE;
    }
}
