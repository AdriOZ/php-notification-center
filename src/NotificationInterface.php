<?php

namespace oz;

/**
 * Interface NotificationInterface, the interface that must fulfill a class to be
 * pushed in the notification center.
 * @package oz
 */
interface NotificationInterface
{
    /**
     * Returns the name of the notification.
     * @return string
     */
    public function getNotificationName();
}