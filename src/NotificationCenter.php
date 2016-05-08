<?php

namespace oz;

/**
 * Class NotificationCenter where the notifications are pushed.
 * @package oz
 */
class NotificationCenter
{
    /**
     * Instance of the class.
     * @var NotificationCenter
     */
    private static $instance = null;

    /**
     * Returns the default notification where the notifications are pushed.
     * Custom notification centers can be created, but in most cases the default
     * center must be used.
     * @return NotificationCenter
     */
    public static function getDefaultCenter()
    {
        if (is_null(self::$instance)) {
            $className = __CLASS__;
            self::$instance = new $className();
        }

        return self::$instance;
    }

    /**
     * List of classes waiting for the notification.
     * @var NotificationReceiverInterface[]
     */
    private $observers;

    /**
     * NotificationCenter constructor.
     */
    public function __construct()
    {
        $this->observers = array();
    }

    /**
     * Adds a new observer in the notification center.
     * @param NotificationReceiverInterface $observer New observer of the notifications.
     */
    public function addObserver(NotificationReceiverInterface $observer)
    {
        if (!in_array($observer, $this->observers, true)) {
            $this->observers[] = $observer;
        }
    }

    /**
     * Removes an observer of the list of observers.
     * @param NotificationReceiverInterface $observer Observer that will be removed.
     */
    public function removeObserver(NotificationReceiverInterface $observer)
    {
        $index = array_search($observer, $this->observers, true);

        if ($index !== false) {
            unset($this->observers[$index]);
        }
    }

    /**
     * Push a notification in the notification center.
     * @param NotificationInterface $notification Notification to be pushed.
     */
    public function pushNotification(NotificationInterface $notification)
    {
        foreach ($this->observers as $observer) {
            if ($observer->getNotificationName() === $notification->getNotificationName()) {
                $observer->didReceiveNotification($notification);
            }
        }
    }
}