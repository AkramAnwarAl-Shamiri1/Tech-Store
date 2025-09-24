<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    protected function isAdmin(User $user): bool
    {
        return $user->role && $user->role->name === 'Admin';
    }

    protected function isVendor(User $user): bool
    {
        return $user->role && $user->role->name === 'Vendor';
    }

    protected function isCustomer(User $user): bool
    {
        return $user->role && $user->role->name === 'Customer';
    }

    protected function isSupport(User $user): bool
    {
        return $user->role && $user->role->name === 'Support';
    }

    public function viewAny(User $user)
    {
        return $this->isAdmin($user) || $this->isSupport($user);
    }

    public function view(User $user, Transaction $transaction)
    {
        return $this->isAdmin($user);
    }

    public function create(User $user)
    {
        return $this->isAdmin($user) || $this->isVendor($user);
    }

    public function update(User $user, Transaction $transaction)
    {
        return $this->isAdmin($user);
    }

    public function delete(User $user, Transaction $transaction)
    {
        return $this->update($user, $transaction);
    }
}
