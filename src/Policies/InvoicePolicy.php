<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Invoice;
use Eduka\Cube\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Invoice $invoice)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Invoice $invoice)
    {
        return true;
    }

    public function delete(User $user, Invoice $invoice)
    {
        return true;
    }

    public function restore(User $user, Invoice $invoice)
    {
        return true;
    }

    public function forceDelete(User $user, Invoice $invoice)
    {
        return true;
    }
}
