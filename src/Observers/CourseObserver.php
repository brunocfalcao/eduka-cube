<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Brunocfalcao\LaravelHelpers\Traits\HasCanonicals;
use Eduka\Cube\Models\Course;
use Illuminate\Validation\Rule;

class CourseObserver
{
    use CanValidateObserverAttributes, HasCanonicals;

    public function saving(Course $course)
    {
        $this->upsertCanonical($course, 'name');

        $validationRules = [
            'name' => ['required', 'string'],
            'canonical' => ['required', Rule::unique('courses')->ignore($course->id)],
            'domain' => ['required', 'string', Rule::unique('domains')->ignore($course->id)],
            'provider_namespace' => ['nullable', 'string'],
            'prelaunched_at' => ['nullable'],
            'launched_at' => ['nullable'],
            'retired_at' => ['nullable'],
            'is_active' => ['nullable', 'boolean'],
            'is_ppp_enabled' => ['nullable', 'boolean'],
            'lemon_squeezy_store_id' => ['nullable', 'string'],
            'vimeo_uri_key' => ['nullable', 'string'],
            'backblaze_bucket_name' => ['nullable', 'string'],
        ];

        $this->validate($course, $validationRules);
    }

    public function created(Course $course)
    {
        /**
         * 1. Create a new Vimeo top-level folder.
         * 2. Create a new Backblaze bucket.
         * 3. Create a new YoutTube playlist.
         */
    }
}
