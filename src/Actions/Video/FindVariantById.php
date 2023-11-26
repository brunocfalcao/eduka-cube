<?php

namespace Eduka\Cube\Actions\Video;

use Eduka\Cube\Models\Variant;

class FindVariantById
{
    public static function find(int $id): Variant
    {
        return Variant::find($id);
    }
}
