<?php

namespace Eduka\Cube\Events\Subscribers;

use Eduka\Cube\Models\Subscriber;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * This event is triggered each time a new domain is saved into the database.
 */
class SubscriberCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Subscriber $subscriber;

    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }
}
