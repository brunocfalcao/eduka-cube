<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Events\Variants\VariantSavedEvent;
use Eduka\Cube\Models\Variant;

class VariantObserver
{
    public function saved(Variant $variant)
    {
        event(new VariantSavedEvent($variant));
    }

    public function saving(Variant $variant)
    {
        $variant->upsertCanonical();
        $variant->upsertUuid();
        $variant->ensureCorrectDefaultVariant();
        $variant->validate();
    }
}
