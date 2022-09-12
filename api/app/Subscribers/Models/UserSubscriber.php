<?php
namespace App\Subscribers\Models;

use App\Events\user\userCreated;
use App\Events\user\userDeleted;
use App\Events\user\userUpdated;
use App\Listeners\SendWelcomeEMail;
use Illuminate\Events\Dispatcher;

class UserSubscriber 
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen(userCreated::class, SendWelcomeEMail::class);
        $events->listen(userUpdated::class, SendWelcomeEMail::class);
        $events->listen(userDeleted::class, SendWelcomeEMail::class);

    }
}