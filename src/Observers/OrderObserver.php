<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Models\Order;

class OrderObserver
{
    use CanValidateObserverAttributes;

    public function saving(Order $order)
    {
        $this->validate($order, [
            'variant_id' => 'required',
        ]);
    }
}
