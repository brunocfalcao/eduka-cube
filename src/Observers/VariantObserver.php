<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Models\Variant;
use Illuminate\Support\Str;

class VariantObserver
{
    use CanValidateObserverAttributes;

    public function saving(Variant $variant)
    {
        if (blank($variant->uuid)) {
            $variant->uuid = (string) Str::uuid();
        }

        $this->validate($variant, [
            'uuid' => ['required', 'string', 'min:1', 'max:36'],
            'canonical' => ['required', 'string', 'min:1', 'max:255'],
            'course_id' => ['required', 'exists:courses,id'],
            'description' => ['nullable'],
            'lemon_squeezy_variant_id' => ['nullable', 'numeric'],
            'lemon_squeezy_price_override' => ['nullable', 'numeric'],
        ]);
    }
}
