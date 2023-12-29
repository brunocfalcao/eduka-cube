<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Models\VideoStorage;

class VideoStorageObserver
{
    use CanValidateObserverAttributes;

    public function saving(VideoStorage $videoStorage)
    {
        $this->validate($videoStorage, [
            'video_id' => ['required', 'exists:videos,id'],
            'vimeo_id' => ['nullable', 'string', 'min:1', 'max:255'],
            'backblaze_id' => ['nullable', 'string', 'min:1', 'max:255'],
            'path_on_disk' => ['nullable', 'string', 'min:1', 'max:255'],
        ]);
    }
}
