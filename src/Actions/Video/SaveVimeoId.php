<?php

namespace Eduka\Cube\Actions\Video;

use Eduka\Cube\Models\Video;
use Eduka\Cube\Models\VideoStorage;

class SaveVimeoId
{
    public static function save(Video $video, VideoStorage $videoStorage, string $vimeoId)
    {
        self::saveInVideo($video, $vimeoId);
        self::saveInVideoStorage($videoStorage, $vimeoId);
    }

    public static function saveInVideoStorage(VideoStorage $videoStorage, string $vimeoId)
    {
        return $videoStorage->update([
            'vimeo_id' => $vimeoId,
        ]);
    }

    public static function saveInVideo(Video $video, string $vimeoId)
    {
        return $video->update([
            'vimeo_id' => $vimeoId,
        ]);
    }

}
