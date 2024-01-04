<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Models\Chapter;
use Eduka\Cube\Models\Course;
use Illuminate\Validation\Rule;

class ChapterObserver
{
    use CanValidateObserverAttributes;

    public function saving(Chapter $chapter)
    {
        $validationRules = [
            'course_id' => ['required', Rule::unique('chapters')->ignore($chapter->id)],
            'name' => ['required', 'string'],
            'description' => ['nullable'],
            'vimeo_uri_key' => ['nullable', 'string'],
        ];

        $this->validate($chapter, $validationRules);
    }

    public function created(Chapter $chapter)
    {
        /**
         * If the course id exists/changed, add the chapter to all variants
         * ONLY if there are no variants already attached.
         */
        if ($chapter->isDirty('course_id')) {
            if (! $chapter->variants()->exists()) {
                foreach (Course::find($chapter->course_id)->variants as $variant) {
                    $chapter->variants()->attach($variant->id);
                }
            }
        }
    }
}
