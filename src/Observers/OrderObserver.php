<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Models\Order;
use Eduka\Services\OrderCreatedEvent;

class OrderObserver
{
    public function saving(Order $order)
    {
        $order->validate();
    }

    public function created(Order $order)
    {
        /**
         * Verify the event name.
         */
        switch ($order->event_name) {
            case 'order_created':
                event(new OrderCreatedEvent($order));
                break;

            case 'order_refunded':
                // TODO
                break;
        }
    }
}
