<?php

namespace Eduka\Cube\Actions\VideoStorage;

use Eduka\Cube\Models\VideoStorage;

class FindVideoStorageForBackblazeUpload
{
    public static function find(int $videoStorageId)
    {
        return VideoStorage::with(['video'])->find($videoStorageId);
    }
}
