<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Events\Orders\OrderCreated;
use Eduka\Cube\Models\Order;

class OrderObserver
{
    use CanValidateObserverAttributes;

    public function saving(Order $order)
    {
        $this->validate($order, [
            'variant_id' => ['required', 'exists:variants,lemon_squeezy_variant_id'],
            'response_body' => ['required'],
            'event_name' => ['required'],
        ]);
    }

    public function created(Order $order)
    {
        /**
         * Verify the event name.
         */
        switch ($order->event_name) {
            case 'order_created':
                event(new OrderCreated($order));
                break;

            case 'order_refunded':
                // TODO
                break;
        }
    }
}
