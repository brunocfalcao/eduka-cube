<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Events\Chapters\ChapterCreatedEvent;
use Eduka\Cube\Events\Chapters\ChapterDeletedEvent;
use Eduka\Cube\Events\Chapters\ChapterRenamedEvent;
use Eduka\Cube\Events\Chapters\ChapterUpdatedEvent;
use Eduka\Cube\Models\Chapter;
use Eduka\Cube\Models\Course;

class ChapterObserver
{
    public function saving(Chapter $chapter)
    {
        $chapter->incrementByGroup('course_id');

        $chapter->validate();
    }

    public function updated(Chapter $chapter)
    {
        if ($chapter->wasChanged('name')) {
            event(new ChapterRenamedEvent($chapter));
        }

        event(new ChapterUpdatedEvent($chapter));
    }

    public function forceDeleted(Chapter $chapter)
    {
        event(new ChapterDeletedEvent($chapter));
    }

    public function created(Chapter $chapter)
    {
        /**
         * If the course id exists/changed, add the chapter to all course
         * variants ONLY if no course variants are already attached to
         * this chapter.
         */
        if ($chapter->isDirty('course_id')) {
            // Chapter doesn't have variants?
            if (! $chapter->variants()->exists()) {
                // Add this chapter to all course variants.
                foreach (Course::find($chapter->course_id)->variants as $variant) {
                    $chapter->variants()->attach($variant->id);
                }
            }
        }

        event(new ChapterCreatedEvent($chapter));
    }
}
