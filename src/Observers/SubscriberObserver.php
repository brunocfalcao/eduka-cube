<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Events\Subscribers\SubscriberCreated;
use Eduka\Cube\Models\Subscriber;

class SubscriberObserver
{
    public function saving(Subscriber $subscriber)
    {
        //
    }

    public function saved(Subscriber $subscriber)
    {
        //
    }

    public function created(Subscriber $subscriber)
    {
        event(new SubscriberCreated($subscriber));
    }

    public function updated(Subscriber $subscriber)
    {
        //
    }

    public function deleted(Subscriber $subscriber)
    {
        //
    }

    public function restored(Subscriber $subscriber)
    {
        //
    }

    public function forceDeleted(Subscriber $subscriber)
    {
        //
    }
}
