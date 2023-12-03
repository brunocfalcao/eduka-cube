<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Models\VideoCompleted;

class VideoCompletedObserver
{
    public function saving(VideoCompleted $videoCompleted)
    {
        $this->validate($videoCompleted, [
            'video_id' => ['required', 'exists:videos,id'],
            'user_id' => ['required', 'exists:users,id'],
        ]);
    }
}
