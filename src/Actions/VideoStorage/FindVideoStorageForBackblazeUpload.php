<?php

namespace Eduka\Cube\Actions\VideoStorage;

use Eduka\Cube\Models\VideoStorage;

class FindVideoStorageForBackblazeUpload
{
    public static function find(int $videoStorageId)
    {
        return VideoStorage::with([
            'video' => function ($video) {
                $video->with([
                    'chapter' => function ($chapter) {
                        $chapter->with([
                            'variant' => function ($variant) {
                                $variant->with('course');
                            },
                        ]);
                    },
                ]);
            },
        ])->find($videoStorageId);
    }
}
