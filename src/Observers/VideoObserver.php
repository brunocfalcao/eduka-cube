<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\HasCanonicals;
use Brunocfalcao\LaravelHelpers\Traits\HasUuids;
use Eduka\Cube\Events\Videos\VideoNameChanged;
use Eduka\Cube\Models\Video;
use Illuminate\Validation\Rule;

class VideoObserver
{
    use HasCanonicals, HasUuids;

    public function saving(Video $video)
    {
        $this->upsertCanonical($video, $video->name);
        $this->upsertUuid($video);
        $video->incrementByGroup('chapter_id');

        $extraValidationRules = [
            'uuid' => ['required', Rule::unique('videos')->ignore($video->id)],
            'canonical' => ['required', Rule::unique('videos')->ignore($video->id)],
        ];

        $video->validate($extraValidationRules);
    }

    public function saved(Video $video)
    {
        if ($video->wasChanged('name') && $video->vimeo_id) {
            event(new VideoNameChanged($video));
        }
    }
}
