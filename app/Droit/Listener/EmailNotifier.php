<?php namespace Droit\Listener;

use Laracasts\Commander\Events\EventListener;
use Droit\Event\UserWasSubscribed;

class EmailNotifier extends EventListener {

    public function whenUserWasSubscribed(UserWasSubscribed $subscribe)
    {
        \Log::info('Send a notification email to the user with token.');
    }

}