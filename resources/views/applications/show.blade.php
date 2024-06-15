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

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                @forelse ($application->logs as $log)
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if ($log->level === 'error')
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-semibold uppercase">
                                {{ $log->level }}
                            </span>
                        @elseif ($log->level === 'warning')
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-semibold uppercase">
                                {{ $log->level }}
                            </span>
                        @elseif ($log->level === 'info')
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-semibold uppercase">
                                {{ $log->level }}
                            </span>
                        @elseif ($log->level === 'debug')
                            <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs font-semibold uppercase">
                                {{ $log->level }}
                            </span>
                        @elseif ($log->level === 'emergency')
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-semibold uppercase">
                                {{ $log->level }}
                            </span>
                        @elseif ($log->level === 'alert')
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-semibold uppercase">
                                {{ $log->level }}
                            </span>
                        @elseif ($log->level === 'critical')
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-semibold uppercase">
                                {{ $log->level }}
                            </span>
                        @elseif ($log->level === 'notice')
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold uppercase">
                                {{ $log->level }}
                            </span>
                        @endif
                        <p>{{ $log->message }}</p>
                        <p>{{ $log->created_at->format('F d Y H:i') }}</p>
                    </div>
                @empty
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p>No logs found for this application.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
