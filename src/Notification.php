<?php

namespace oz;

/**
 * Class Notification base class that can be used to be pushed in the notification center.
 * @package oz
 */
class Notification implements NotificationInterface, \ArrayAccess
{
    /**
     * The name of the notification.
     * @var string
     */
    private $notificationName;

    /**
     * Additional data in the notification.
     * @var array
     */
    private $data;

    /**
     * Notification constructor.
     * @param string $notificationName Name of the notification.
     */
    public function __construct($notificationName)
    {
        $this->notificationName = (string) $notificationName;
        $this->data = array();
    }

    /**
     * @return string
     */
    public function getNotificationName()
    {
        return $this->notificationName;
    }

    /**
     * @param string $notificationName
     */
    public function setNotificationName($notificationName)
    {
        $this->notificationName = $notificationName;
    }

    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }
}