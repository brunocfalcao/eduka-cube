<?php

namespace Eduka\Cube\Validators;

use Brunocfalcao\LaravelHelpers\Classes\ExtendedFormRequestValidator;

class ChapterValidator extends ExtendedFormRequestValidator
{
    public function rules()
    {
        return [
            'course_id' => ['required', 'exists:courses,id'],
            'index' => ['required'],
            'name' => ['required', 'string'],
            'description' => ['nullable'],
            'vimeo_uri' => ['nullable', 'string'],
            'vimeo_folder_id' => ['nullable', 'string'],
        ];
    }
}
