<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Models\Subscriber;

class SubscriberObserver
{
    use CanValidateObserverAttributes;

    public function saving(Subscriber $subscriber)
    {
        $this->validate($subscriber, [
            'course_id' => 'required',
            'email' => 'required|email',
        ]);
    }
}
