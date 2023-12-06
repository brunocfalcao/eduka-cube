<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VideoObserver
{
    use CanValidateObserverAttributes;

    public function saving(Video $video)
    {
        if (empty($video->uuid)) {
            $video->uuid = (string) Str::uuid();
        }

        if (empty($video->created_by)) {
            if (Auth::id()) {
                $video->created_by = Auth::id();
            }
        }

        $this->validate($video, [
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'description' => ['nullable'],
            'vimeo_id' => ['nullable', 'string', 'min:1', 'max:255'],
            'duration' => ['nullable', 'integer', 'min:0', 'max:4294967295'],
            'uuid' => ['required', 'string', 'min:1', 'max:36'],
            'created_by' => ['required', 'exists:users,id'],
            'meta_title' => ['nullable', 'string', 'min:1', 'max:255'],
            'meta_description' => ['nullable', 'string', 'min:1', 'max:255'],
            'meta_canonical_url' => ['nullable', 'string', 'min:1', 'max:255'],
        ]);
    }
}
