<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Models\Domain;

class DomainObserver
{
    use CanValidateObserverAttributes;

    public function saving(Domain $domain)
    {
        $this->validate($domain, [
            'name' => 'required',
        ]);
    }
}
