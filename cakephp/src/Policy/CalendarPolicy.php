<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Calendar;
use Authorization\IdentityInterface;

/**
 * Calendar policy
 */
class CalendarPolicy
{
    /**
     * Check if $user can add Calendar
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Calendar $calendar
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Calendar $calendar)
    {
    }

    /**
     * Check if $user can edit Calendar
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Calendar $calendar
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Calendar $calendar)
    {
    }

    /**
     * Check if $user can delete Calendar
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Calendar $calendar
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Calendar $calendar)
    {
    }

    /**
     * Check if $user can view Calendar
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Calendar $calendar
     * @return bool
     */
    public function canView(IdentityInterface $user, Calendar $calendar)
    {
    }
}
