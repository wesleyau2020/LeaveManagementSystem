<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\IdentityInterface;

/**
 * User policy
 */
class UserPolicy
{

    /**
     * Check if $user can access templates/Users/index.php
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canIndex(IdentityInterface $user, User $resource)
    {
        return $this->isAdmin($user, $resource);
    }


    /**
     * Check if $user can add User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canAdd(IdentityInterface $user, User $resource)
    {
        return $this->isAdmin($user, $resource);
    }

    /**
     * Check if $user can edit User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, User $resource)
    {
        return $this->isOwner($user, $resource);
    }

    /**
     * Check if $user can delete User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, User $resource)
    {
        return $this->isAdmin($user, $resource);
    }

    /**
     * Check if $user can view User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, User $resource)
    {
        return $this->isOwner($user, $resource);
    }

    protected function isAdmin(IdentityInterface $user, User $resource)
    {
        return $user->is_admin === true;
    }

    protected function isOwner(IdentityInterface $user, User $resource)
    // Checks if user is owner of the resource
    // User can view his own leave details
    // User can edit his own username and password
    {
        return $resource->id === $user->getIdentifier();
    }
}
