<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Events\Subscribers\SubscriberCreatedEvent;
use Eduka\Cube\Models\Subscriber;

class SubscriberObserver
{
    public function saving(Subscriber $subscriber)
    {
        $subscriber->validate();
    }

    public function created(Subscriber $subscriber)
    {
        // This needs to be tested later with attention not to send emails.
        // event(new SubscriberCreatedEvent($subscriber));
    }
}
