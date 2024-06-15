<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Applications') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end">
                <a href="{{ route('applications.create') }}" wire:navigate>
                    <x-primary-button>
                        {{ __('Create Application') }}
                    </x-primary-button>
                </a>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @forelse ($applications as $application)
                        <div class="flex justify-between">
                            <div>
                                <p class="font-semibold text-lg">{{ $application->label }}</p>
                                <p><a href="{{ $application->site_url }}" target="_blank" class="text-indigo-500 hover:text-indigo-600 hover:underline ease-in-out">
                                        {{ $application->site_url }}
                                    </a>
                                </p>
                                <p class="text-sm text-gray-600 font-medium">
                                    Last Logs Received: {{ $application?->last_logs_sent_at?->diffForHumans() ?? 'Never' }}
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('applications.show', $application) }}" wire:navigate>
                                    <x-secondary-button>
                                        {{ __('View Logs') }}
                                    </x-secondary-button>
                                </a>
                                <a href="{{ route('applications.edit', $application) }}" wire:navigate>
                                    <x-secondary-button>
                                        {{ __('Edit App') }}
                                    </x-secondary-button>
                                </a>
                            </div>
                        </div>
                    @empty
                        <p>{{ __('No applications found.') }}</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
