<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Events\Subscribers\SubscriberCreated;
use Eduka\Cube\Models\Subscriber;

class SubscriberObserver
{
    use CanValidateObserverAttributes;

    public function saving(Subscriber $subscriber)
    {
        $validationRules = [
            'course_id' => ['required', 'exists:courses,id'],
            'email' => ['required', 'string'],
        ];

        $this->validate($subscriber, $validationRules);
    }

    public function created(Subscriber $subscriber)
    {
        event(new SubscriberCreated($subscriber));
    }
}
