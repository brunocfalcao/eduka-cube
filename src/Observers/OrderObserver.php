<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Events\Orders\OrderCreatedEvent;
use Eduka\Cube\Models\Order;
use Eduka\Cube\Models\Variant;

class OrderObserver
{
    public function saving(Order $order)
    {
        $order->validate();

        if ($order->variant_id) {
            $order->course_id = Variant::find($order->variant_id)->course_id;
        }
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
