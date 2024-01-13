<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Models\Order;
use Eduka\Services\OrderCreatedEvent;

class OrderObserver
{
    use CanValidateObserverAttributes;

    public function saving(Order $order)
    {
        $validationRules = [
            'user_id' => ['nullable', 'exists:users,id'],
            'variant_id' => ['required', 'exists:variants,id'],
            'response_body' => ['required'],
            'custom_data' => ['nullable'],
            'event_name' => ['nullable', 'string'],
            'store_id' => ['nullable', 'string'],
            'customer_id' => ['nullable', 'string'],
            'order_number' => ['nullable', 'string'],
            'user_name' => ['nullable', 'string'],
            'user_email' => ['nullable', 'string'],
            'subtotal_usd' => ['nullable', 'string'],
            'discount_total_usd' => ['nullable', 'string'],
            'tax_usd' => ['nullable', 'string'],
            'total_usd' => ['nullable', 'string'],
            'tax_name' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
            'refunded' => ['nullable', 'boolean'],
            'refunded_at' => ['nullable', 'string'],
            'order_id' => ['nullable', 'string'],
            'lemon_squeezy_product_id' => ['required', 'string'],
            'lemon_squeezy_variant_id' => ['required', 'string'],
            'lemon_squeezy_product_name' => ['required', 'string'],
            'lemon_squeezy_variant_name' => ['required', 'string'],
            'price' => ['required', 'string'],
            'receipt' => ['nullable', 'string'],
        ];

        $this->validate($order, $validationRules);
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
