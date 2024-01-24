<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\HasCanonicals;
use Brunocfalcao\LaravelHelpers\Traits\HasUuids;
use Eduka\Cube\Models\Variant;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class VariantObserver
{
    use HasCanonicals, HasUuids;

    public function saving(Variant $variant)
    {
        $this->upsertCanonical($variant, $variant->name);
        $this->ensureCorrectDefaultVariant($variant);

        if (blank($variant->uuid)) {
            $variant->uuid = (string) Str::uuid();
        }

        $extraValidationRules = [
            'canonical' => ['required', Rule::unique('variants')->ignore($variant->id)],
        ];

        $variant->validate($extraValidationRules);
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
