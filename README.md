# php-notification-center
Little implementation of a Notification center in PHP.

## Description
The library can be used to notify classes that something in the code has happen. For example, it can be used to notify a login error or success.

The structure of the classes is:
- oz\\NotificationInterface: Functions a class must have to be notified in the notification center.
- oz\\NotificationReceiverInterface: Functions a class must have to be able to receive notifications.
- oz\\Notification: A simple implementation of the NotificationInterface. The notification can store data that can be accessed using array syntax.
- oz\\NotificationCenter: The class manage the notifications and notifications receivers. It has a default instance (Singleton pattern), but more instances can be created if needed.

### Basic setup
Adding dependencies and creating a notification center:
```php
use oz\NotificationInterface;
use oz\NotificationReceiverInterface;
use oz\Notification;
use oz\NotificationCenter;

$notificationCenter = NotificationCenter::getDefaultCenter();
```

Creating a class that implements the oz\\NotificationReceiverInterface:
```php
class LoginManager implements NotificationReceiverInterface
{
    public function getNotificationName()
    {
        return 'login';
    }

    public function didReceiveNotification(NotificationInterface $notification)
    {
        if ($notification['success'] === true) {
            $userId = $notification['userId'];

            # Lot of code here
        } else {
            $error = $notification['error'];
            # Lot of stuff
        }
    }
}
```

### Adding a observer
```php
$notificationCenter->addObserver(new LoginManager());
```

### Pushing a notification
```php
function login($email, $password)
{
    # Some checks and boring stuff

    $notification = new Notification('login');

    if ($success) {
        $notification['success'] = true;
        $notification['userId'] = $userId;
    } else {
        $notification['success'] = false;
        $notification['error'] = 'Hey mate, wrong password, be careful next time!';
    }

    $notificationCenter->pushNotification($notification);
}
```

### Result
You can split the code in several classes, adding several observers for a same notification. Furthermore, a class can change the notification name dynamically and be an observer of different notifications in different occasions.

If the oz\\Notification class is not enough, you can create custom notification classes, and the process will work anyway.

Be careful! You can have several instance of the NotificationCenter, but in most cases you'll only need one.

### That's all
Have fun ;)
