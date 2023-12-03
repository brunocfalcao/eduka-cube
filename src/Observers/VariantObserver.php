<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Models\Variant;

class VariantObserver
{
    use CanValidateObserverAttributes;

    public function saving(Variant $variant)
    {
        $this->validate($variant, [
            'uuid' => 'required',
            'canonical' => 'required',
        ]);
    }
}
