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

        // If the incoming variant is not marked as default, check the default status for the course
        if (!$variant->is_default) {
            // Check if there's already a default variant for this course
            $hasDefault = Variant::where('course_id', $variant->course_id)
                             ->where('is_default', true)
                             ->exists();

            // If no default variant exists, make the oldest variant the default
            if (!$hasDefault) {
                $oldestVariant = Variant::where('course_id', $variant->course_id)
                                    ->oldest()
                                    ->first();

                if ($oldestVariant) {
                    $oldestVariant->is_default = true;
                    $oldestVariant->save();
                }
            }
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
