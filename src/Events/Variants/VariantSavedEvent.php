<?php

namespace Eduka\Cube\Events\Variants;

use Eduka\Cube\Models\Variant;

class VariantSavedEvent
{
    public Variant $variant;

    public function __construct(Variant $variant)
    {
        $this->variant = $variant;
    }
}
