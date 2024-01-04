<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Brunocfalcao\LaravelHelpers\Traits\HasCanonicals;
use Eduka\Cube\Events\Videos\VideoNameChanged;
use Eduka\Cube\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class VideoObserver
{
    use CanValidateObserverAttributes, HasCanonicals;

    public function saving(Video $video)
    {
        $this->checkCanonical($video);

        if (empty($video->uuid)) {
            $video->uuid = (string) Str::uuid();
        }

        if (empty($video->created_by)) {
            if (Auth::id()) {
                $video->created_by = Auth::id();
            }
        }

        $this->validate($video, [
            'name' => ['required', 'string'],
            'description' => ['nullable'],
            'canonical' => ['required', Rule::unique('videos')->ignore($video->id)],
            'vimeo_id' => ['nullable', 'string'],
            'duration' => ['nullable', 'integer'],
            'uuid' => ['required', 'string'],
            'created_by' => ['required', 'exists:users,id'],
            'meta_title' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
        ]);
    }

    public function saved(Video $video)
    {
        if ($video->wasChanged('name') && $video->vimeo_id) {
            event(new VideoNameChanged($video));
        }
    }
}
