<?php

namespace Eduka\Cube\Scopes;

use Eduka\Cube\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class UserScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $user = Auth::id() ?
                User::withoutGlobalScope($this)->firstWhere('id', Auth::id()) :
                null;

        // No user or running in console? Exit.
        if (! $user ||
            app()->runningInConsole()) {
            return $builder;
        }

        // Get course, no matter what variant he belongs to.
        $course = $user->variants->first()->course;

        // Scope users only for the logged user admin course.
        return $builder
                ->whereIn('id', function ($query) use ($course) {
                    $query->selectRaw('distinct user_variant.user_id')
                          ->from('user_variant')
                          ->whereIn('variant_id', $course->variants->pluck('id'));
                });
    }
}
