<?php

namespace Eduka\Cube\Actions\Video;

use Eduka\Cube\Models\Variant;

class UpdateVariantBucket
{
    public static function update(Variant $variant, string $bucketName): Variant
    {
        $variant->update(['backblaze_bucket_name' => $bucketName]);

        $variant->fresh();

        return $variant;
    }
}
