<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\HasCanonicals;
use Brunocfalcao\LaravelHelpers\Traits\HasUuids;
use Eduka\Cube\Events\Episodes\EpisodeChapterUpdatedEvent;
use Eduka\Cube\Events\Episodes\EpisodeDeletedEvent;
use Eduka\Cube\Events\Episodes\EpisodeReplacedEvent;
use Eduka\Cube\Events\Episodes\EpisodeUpdatedEvent;
use Eduka\Cube\Models\Chapter;
use Eduka\Cube\Models\Episode;
use Illuminate\Validation\Rule;

class EpisodeObserver
{
    use HasCanonicals, HasUuids;

    public function saving(Episode $episode)
    {
        $this->upsertCanonical($episode, $episode->name);
        $this->upsertUuid($episode);
        $episode->incrementByGroup('chapter_id');

        $extraValidationRules = [
            'uuid' => ['required', Rule::unique('episodes')->ignore($episode->id)],
            'canonical' => ['required', Rule::unique('episodes')->ignore($episode->id)],
        ];

        $episode->validate($extraValidationRules);
    }

    public function saved(Episode $episode)
    {
        // Lets update vimeo/youtube with the new episode information.
        if (($episode->wasChanged('name') || $episode->wasChanged('description'))
            && $episode->vimeo_uri) {
            event(new EpisodeUpdatedEvent($episode));
        }

        // We need to replace the current vimeo episode.
        if ($episode->wasChanged('temp_filename_path')) {
            event(new EpisodeReplacedEvent($episode));
        }

        // We nede to replace/remove from the current chapter and add to the new one.
        if ($episode->wasChanged('chapter_id') && $episode->vimeo_uri) {
            event(new EpisodeChapterUpdatedEvent($episode));
        }
    }

    public function deleted(Episode $episode)
    {
        if ($episode->vimeo_uri) {
            event(new EpisodeDeletedEvent([
                'vimeo_uri' => $episode->vimeo_uri,
                'name' => $episode->name,
                'admin' => $episode->course->admin,
            ]));
        }
    }
}