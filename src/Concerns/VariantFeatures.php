<?php

namespace Eduka\Cube\Concerns;

use Eduka\Cube\Models\Variant;

trait VariantFeatures
{
    /**
     * Returns this variant price. The variant price is given
     * by the variant price itself.
     */
    public function price()
    {
        if ($this->price_override) {
            return $this->price_override;
        }

        $gateway = new $this->course->payments_gateway_class($this->product_id);

        return $gateway->price();
    }

    /**
     * Updates the variants collection for a respective course
     * with the right variant default (=true).
     */
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
