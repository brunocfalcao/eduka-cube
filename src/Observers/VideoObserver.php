<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Models\Video;
use Illuminate\Support\Str;

class VideoObserver
{
    use CanValidateObserverAttributes;

    public function saving(Video $video)
    {
        if (empty($video->uuid)) {
            $video->uuid = (string) Str::uuid();
        }

        $this->validate($video, [
            'name' => 'required',
            'uuid' => 'required',
        ]);
    }
}
