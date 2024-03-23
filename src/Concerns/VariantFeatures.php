<?php

namespace Eduka\Cube\Concerns;

use Eduka\Cube\Models\Variant;

trait VariantFeatures
{
    public function ensureCorrectDefaultVariant()
    {
        $variants = Variant::where('course_id', $this->course_id);

        // First one? Then this is_default must be true.
        if (! $variants->exists()) {
            $this->is_default = true;
        }

        // Is default? Then assure all other variants will be false.
        elseif ($this->is_default) {
            $variants = Variant::where('course_id', $this->course_id);
            $variants->update(['is_default' => false]);
        }
    }
}
