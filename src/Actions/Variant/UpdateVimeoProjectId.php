<?php

namespace Eduka\Cube\Actions\Variant;

use Eduka\Cube\Models\Variant;

class UpdateVimeoProjectId
{
    public static function update(Variant $variant, string $vimeoProjectId)
    {
        return $variant->update([
            'vimeo_project_id' => $vimeoProjectId,
        ]);
    }
}
