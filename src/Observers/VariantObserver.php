<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Brunocfalcao\LaravelHelpers\Traits\HasCanonicals;
use Brunocfalcao\LaravelHelpers\Traits\HasUuids;
use Eduka\Cube\Models\Variant;
use Illuminate\Validation\Rule;

class VariantObserver
{
    use CanValidateObserverAttributes, HasCanonicals, HasUuids;

    public function saving(Variant $variant)
    {
        $this->upsertCanonical($variant, 'name');
        $this->ensureCorrectDefaultVariant($variant);

        $validationRules = [
            'canonical' => ['required', Rule::unique('variants')->ignore($variant->id)],
            'description' => ['nullable'],
            'lemon_squeezy_variant_id' => ['nullable', 'string'],
            'lemon_squeezy_price_override' => ['nullable', 'numeric'],
            'is_default' => ['boolean'],
        ];

        $this->validate($variant, $validationRules);
    }

    protected function ensureCorrectDefaultVariant($variant)
    {
        $variants = Variant::where('course_id', $variant->course_id);

        // First one? Then this is_default must be true.
        if (! $variants->exists()) {
            $variant->is_default = true;
        }

        // Is default? Then assure all other variants will be false.
        elseif ($variant->is_default) {
            $variants = Variant::where('course_id', $variant->course_id);
            $variants->update(['is_default' => false]);
        }
    }
}
