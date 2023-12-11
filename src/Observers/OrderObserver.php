<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Events\Courses\OrderCreated;
use Eduka\Cube\Models\Order;

class OrderObserver
{
    use CanValidateObserverAttributes;

    public function saving(Order $order)
    {
        $this->validate($order, [
            'user_id' => ['nullable', 'integer', 'exists:users.id'],
            'variant_id' => ['required', 'integer', 'exists:variants,lemon_squeezy_variant_id'],
            'response_body' => ['required'],
            'remote_reference_order_id' => ['nullable', 'string'],
            'remote_reference_customer_id' => ['nullable', 'string'],
            'remote_reference_order_attribute_id' => ['nullable', 'string'],
            'currency_id' => ['nullable', 'string'],
            'remote_reference_payment_status' => ['nullable', 'string'],
            'refunded_at' => ['nullable', 'date'],
        ]);
    }

    public function created(Order $order)
    {
        event(new OrderCreated($order));
    }
}
