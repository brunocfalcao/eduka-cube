<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Brunocfalcao\LaravelHelpers\Traits\HasCanonicals;
use Eduka\Cube\Events\Videos\VideoNameChanged;
use Eduka\Cube\Models\Video;
use Illuminate\Validation\Rule;

class VideoObserver
{
    use CanValidateObserverAttributes, HasCanonicals;

    public function saving(Video $video)
    {
        $this->upsertCanonical($video, 'name');
        $this->upsertUuid($video);

        $validationRules = [
            'name' => ['required', 'string'],
            'description' => ['nullable'],
            'course_id' => ['required', 'exists:courses,id'],
            'uuid' => ['required', Rule::unique('videos')->ignore($video->id)],
            'canonical' => ['required', Rule::unique('videos')->ignore($video->id)],
            'duration' => ['nullable', 'integer'],
            'is_visible' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'is_free' => ['nullable', 'boolean'],
            'vimeo_id' => ['nullable', 'string'],
            'filename' => ['nullable', 'string'],
        ];

        $this->validate($video, $validationRules);
    }

    public function saved(Video $video)
    {
        if ($video->wasChanged('name') && $video->vimeo_id) {
            event(new VideoNameChanged($video));
        }
    }
}
