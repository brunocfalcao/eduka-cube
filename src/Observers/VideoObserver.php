<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\HasCanonicals;
use Brunocfalcao\LaravelHelpers\Traits\HasUuids;
use Eduka\Cube\Events\Videos\VideoChapterUpdatedEvent;
use Eduka\Cube\Events\Videos\VideoDeletedEvent;
use Eduka\Cube\Events\Videos\VideoReplacedEvent;
use Eduka\Cube\Events\Videos\VideoUpdatedEvent;
use Eduka\Cube\Models\Chapter;
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
        // Lets update vimeo/youtube with the new video information.
        if (($video->wasChanged('name') || $video->wasChanged('description'))
            && $video->vimeo_uri) {
            event(new VideoUpdatedEvent($video));
        }

        // We need to replace the current vimeo video.
        if ($video->wasChanged('temp_filename_path')) {
            event(new VideoReplacedEvent($video));
        }

        // We nede to replace/remove from the current chapter and add to the new one.
        if ($video->wasChanged('chapter_id') && $video->vimeo_uri) {
            event(new VideoChapterUpdatedEvent($video));
        }
    }

    public function deleted(Video $video)
    {
        if ($video->vimeo_uri) {
            event(new VideoDeletedEvent([
                'vimeo_uri' => $video->vimeo_uri,
                'name' => $video->name,
                'admin' => $video->course->admin,
            ]));
        }
    }
}
