<?php

namespace Eduka\Cube\Actions\Video;

use Eduka\Cube\Models\Variant;
use Eduka\Cube\Models\Video;

class GetVariantFromVideo
{
    public static function get(Video $video): Variant
    {
        if ($video->relationLoaded('chapter')) {

            $chapter = $video->chapter;

            if ($chapter->relationLoaded('variant')) {
                return $chapter->variant;
            }
            $chapter = $chapter->load('variant');

            return $chapter->variant;
        }

        $video = $video->load('chapter.variant');

        return $video->chapter->variant;
    }
}
