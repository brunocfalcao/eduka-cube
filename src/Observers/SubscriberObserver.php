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
        event(new SubscriberCreatedEvent($subscriber));
    }
}
