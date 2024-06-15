<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function index(Request $request): View
    {
        return view('applications.index', [
            'applications' => Application::query()
                ->where('user_id', $request->user()->id)
                ->get(),
        ]);
    }

    public function create(): View
    {
        return view('applications.create');
    }

    public function store(ApplicationRequest $request): RedirectResponse
    {
        $application = $request->user()->applications()->create([
            'label' => $request->get('label'),
            'site_url' => $request->get('site_url'),
            'secret_key' => bin2hex(random_bytes(16)),
        ]);

        return redirect()->route('applications.show', $application);
    }

    public function show(Application $application): View
    {
        Gate::authorize('view', $application);

        return view('applications.show', [
            'application' => $application,
        ]);
    }

    public function edit(Application $application): View
    {
        Gate::authorize('update', $application);

        return view('applications.edit', [
            'application' => $application,
        ]);
    }

    public function update(ApplicationRequest $request, Application $application): RedirectResponse
    {
        Gate::authorize('update', $application);

        $application->update($request->validated());

        return redirect()->route('applications.show', $application);
    }

    public function destroy(Application $application): RedirectResponse
    {
        Gate::authorize('forceDelete', $application);

        $application->delete();

        return redirect()->route('applications.index');
    }
}
