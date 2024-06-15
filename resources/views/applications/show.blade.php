<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Viewing Application - :label', ['label' => $application->label]) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <div>
                    <div class="max-w-xl mx-auto bg-gray-50 border border-gray-200 mt-6 rounded-lg">
                        <li class="list-none">
                            <div class="p-3">
                                <h2 class="text-sm font-semibold text-gray-900 dark:text-gray-200">
                                    {{ __('Application ID:') }}
                                </h2>
                                <p class="text-xs text-gray-800 dark:text-gray-100">
                                    {{ $application->id }}
                                </p>
                                <h2 class="text-sm font-semibold text-gray-900 dark:text-gray-200">
                                    {{ __('Application Secret Key:') }}
                                </h2>
                                <p class="text-xs text-gray-800 dark:text-gray-100">
                                    {{ $application->secret_key }}
                                </p>
                            </div>
                        </li>
                    </div>
                </div>
                <div>
                    <a href="{{ route('applications.regenerate-secret-key', $application) }}" wire:navigate>
                        <x-secondary-button>
                            {{ __('Regenerate Secret Key') }}
                        </x-secondary-button>
                    </a>
                </div>
            </div>
            <h1 class="mt-6 font-bold text-2xl">
                {{ __('Application Log') }}
            </h1>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <textarea class="w-full h-96 p-3 border border-gray-400 overflow-hidden rounded-lg bg-gray-200" readonly>@forelse ($logs as $log)[{{ $log->created_at }}] - {{ $log->level }} - {{ $log->message }}@if (!$loop->last){{ PHP_EOL }}@endif @empty{{ __('No logs available.') }}@endforelse
                </textarea>
            </div>
        </div>
    </div>
</x-app-layout>
