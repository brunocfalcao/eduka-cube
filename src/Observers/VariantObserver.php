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

        $variants = Variant::where('course_id', $variant->course_id);

        // First one? Then is default must be true.
        if (! $variants->exists()) {
            $variant->is_default = true;
        }

        // Is default? Then assure all other variants will be false.
        elseif ($variant->is_default) {
            $variants = Variant::where('course_id', $variant->course_id);
            $variants->update(['is_default' => true]);
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
