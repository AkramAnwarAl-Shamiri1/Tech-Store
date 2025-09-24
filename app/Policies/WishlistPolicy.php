<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Auth\Access\HandlesAuthorization;

class WishlistPolicy
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

    public function view(User $user, Wishlist $wishlist)
    {
        if ($this->isAdmin($user)) return true;
        if ($user->id === $wishlist->user_id) return true;
        return false;
    }

    public function create(User $user)
    {
        return $this->isAdmin($user) || $this->isVendor($user);
    }

    public function update(User $user, Wishlist $wishlist)
    {
        if ($this->isAdmin($user)) return true;
        if ($user->id === $wishlist->user_id) return true;
        return false;
    }

    public function delete(User $user, Wishlist $wishlist)
    {
        return $this->update($user, $wishlist);
    }
}
