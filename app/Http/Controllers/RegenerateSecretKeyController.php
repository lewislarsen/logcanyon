<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RegenerateSecretKeyController extends Controller
{
    public function __invoke(Request $request, Application $application): RedirectResponse
    {
        Gate::authorize('regenerate-secret', $application);

        $application->regenerateSecretKey();

        return redirect()->route('applications.show', $application);

    }
}
