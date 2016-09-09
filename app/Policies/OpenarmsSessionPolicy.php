<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\OpenarmsSession;

class OpenarmsSessionPolicy
{
    use HandlesAuthorization;


    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user)
    {
        return $user->hasRole('admin');
    }

    public function manage(User $user)
    {
        return $user->hasRole('admin');
    }
}
