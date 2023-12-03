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
            'uuid' => ['required', 'string', 'min:1', 'max:36'],
            'canonical' => ['required', 'string', 'min:1', 'max:255'],
            'course_id' => ['required', 'exists:courses,id'],
            'description' => ['nullable'],
            'lemon_squeezy_variant_id' => ['nullable', 'string', 'min:1', 'max:255'],
            'lemon_squeezy_price_override' => ['nullable', 'numeric'],
            'is_default' => ['required', 'boolean']
        ]);
    }
}
