<?php

namespace Eduka\Cube\Concerns;

use Illuminate\Support\Str;

trait UsesCanonicals
{
    public function checkCanonical($model, string $attribute = null)
    {
        $attribute = $attribute ?? 'canonical';

        if (!blank($model->{$attribute})) {
            return;
        }

        $groups = [];

        for ($i = 0; $i < 4; $i++) {
            $groups[] = strtolower(Str::random(4));
        }

        $model->{$attribute} = implode('-', $groups);
    }
}
