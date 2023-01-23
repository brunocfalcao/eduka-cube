<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Tag;
use Eduka\Cube\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Tag $tag)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Tag $tag)
    {
        return true;
    }

    public function delete(User $user, Tag $tag)
    {
        return true;
    }

    public function restore(User $user, Tag $tag)
    {
        return true;
    }

    public function forceDelete(User $user, Tag $tag)
    {
        return true;
    }
}
