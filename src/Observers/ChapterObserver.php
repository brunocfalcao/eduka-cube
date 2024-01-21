<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Events\Chapters\ChapterCreatedEvent;
use Eduka\Cube\Events\Chapters\ChapterDeletedEvent;
use Eduka\Cube\Events\Chapters\ChapterRenamedEvent;
use Eduka\Cube\Events\Chapters\ChapterUpdatedEvent;
use Eduka\Cube\Models\Chapter;
use Eduka\Cube\Models\Course;
use Illuminate\Support\Facades\Auth;

class ChapterObserver
{
    public function saving(Chapter $chapter)
    {
        if (Auth::id()) {
            // Associate this course with the logged admin user.
            // It's not the best practise, but it only happens on Nova.
            $chapter->course_id = Auth::user()->course_id_as_admin;
        }

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

        if (config('eduka.events.observers') === true) {
            event(new ChapterCreatedEvent($chapter));
        }
    }
}
