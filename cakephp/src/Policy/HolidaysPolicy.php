<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Holidays;
use Authorization\IdentityInterface;

/**
 * Holidays policy
 */
class HolidaysPolicy
{
    /**
     * Check if $user can add Holidays
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Holidays $holidays
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Holidays $holidays)
    {
        return $this->isAdmin($user, $resource);
    }

    /**
     * Check if $user can edit Holidays
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Holidays $holidays
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Holidays $holidays)
    {
        return $this->isAdmin($user, $resource);
    }

    /**
     * Check if $user can delete Holidays
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Holidays $holidays
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Holidays $holidays)
    {
        return $this->isAdmin($user, $resource);
    }

    /**
     * Check if $user can view Holidays
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Holidays $holidays
     * @return bool
     */
    public function canView(IdentityInterface $user, Holidays $holidays)
    {
        return $this->isAdmin($user, $resource);
    }

    protected function isAdmin(IdentityInterface $user, User $resource)
    {
        return $user->is_admin === TRUE;
    }
}
