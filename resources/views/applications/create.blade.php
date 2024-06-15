<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Application') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <form method="POST" action="{{ route('applications.store') }}">
                        @csrf
                        <div class="mt-4">
                            <x-input-label for="label" :value="__('Application Label')"/>
                            <x-text-input id="label" class="block mt-1 w-full" type="text" name="label" required autofocus/>
                            <x-input-error class="mt-2" :messages="$errors->get('label')" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="site_url" :value="__('Application URL')"/>
                            <x-text-input id="site_url" class="block mt-1 w-full" type="text" name="site_url" required/>
                            <x-input-error class="mt-2" :messages="$errors->get('site_url')" />
                        </div>
                        <div class="flex items center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create Application') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
