<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Application') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <form method="POST" action="{{ route('applications.update', $application) }}">
                        @csrf
                        @method('PUT')
                        <div class="mt-4">
                            <x-input-label for="label" :value="__('Application Label')"/>
                            <x-text-input id="label" class="block mt-1 w-full" type="text" name="label"
                                     value="{{ old($application->label) }}" required autofocus/>
                            <x-input-error class="mt-2" :messages="$errors->get('label')" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="label" :value="__('Application Label')"/>
                            <x-text-input id="site_url" class="block mt-1 w-full" type="text" name="site_url"
                                     value="{{ old($application->site_url) }}" required/>
                            <x-input-error class="mt-2" :messages="$errors->get('label')" />
                        </div>
                        <div class="flex items center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Update Application') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('applications.destroy', $application) }}">
                        @csrf
                        @method('DELETE')
                        <p class="text-sm text-gray-800 dark:text-gray-100">
                            {{ __('Are you sure you want to delete this application? This will remove all logs.') }}
                        </p>
                        <div class="flex items
                        center justify-end mt-4">
                            <x-danger-button class="ml-4">
                                {{ __('Delete Application') }}
                            </x-danger-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
