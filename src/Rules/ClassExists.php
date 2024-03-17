<?php

namespace Eduka\Cube\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class ClassExists implements Rule
{
    /**
     * Validate that a given class name (namespace) exists.
     *
     * This method is called when the rule is used as a callable.
     *
     * @param  string  $attribute  Name of the attribute being validated.
     * @param  mixed  $value  The value of the attribute.
     */
    public function __invoke(string $attribute, $value, $fail): bool
    {
        if (! class_exists($value)) {
            $fail("The {$attribute} is not a valid class.");

            return false;
        }

        return true;
    }

    /**
     * Perform validation logic.
     *
     * @param  string  $attribute  Name of the attribute being validated.
     * @param  mixed  $value  The value of the attribute.
     * @param  Closure  $fail  The failure callback.
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Since this class is intended to be used as an invokable,
        // the passes method can simply call the __invoke method.
        return $this->__invoke($attribute, $value, function ($message) {
            // Normally, you might handle a failure case here,
            // but since we're using this in a Laravel custom validation rule context,
            // the actual handling of failures is done in the validator extension.
        });
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute does not exist.';
    }
}
