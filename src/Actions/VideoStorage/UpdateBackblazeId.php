<?php

namespace Eduka\Cube\Actions\VideoStorage;

use Eduka\Cube\Models\VideoStorage;

class UpdateBackblazeId
{
    public static function handle(VideoStorage $videoStorage, string $backblazeId)
    {
        $videoStorage->update([
            'backblaze_id' => $backblazeId,
        ]);
    }
}
