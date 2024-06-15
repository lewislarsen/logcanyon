<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ApplicationPolicy
{
    public function view(User $user, Application $application): Response
    {
        return $user->id === $application->user_id
            ? Response::allow()
            : Response::deny('You do not own this application.');
    }

    public function update(User $user, Application $application): Response
    {
        return $user->id === $application->user_id
            ? Response::allow()
            : Response::deny('You do not own this application.');
    }

    public function forceDelete(User $user, Application $application): Response
    {
        return $user->id === $application->user_id
            ? Response::allow()
            : Response::deny('You do not own this application.');
    }
}
