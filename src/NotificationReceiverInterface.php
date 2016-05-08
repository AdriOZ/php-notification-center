<?php

namespace oz;

/**
 * Interface NotificationReceiverInterface that must implement a class to be able to
 * receive a notification.
 * @package oz
 */
interface NotificationReceiverInterface
{
    /**
     * Returns the name of the notification the class is waiting for.
     * @return string
     */
    public function getNotificationName();

    /**
     * The function that will be called when a notification with the correct name is
     * pushed in the notification center.
     * @param NotificationInterface $notification The notification the receiver is waiting
     * for.
     */
    public function didReceiveNotification(NotificationInterface $notification);
}