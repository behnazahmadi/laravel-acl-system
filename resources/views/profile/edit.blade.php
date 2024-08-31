<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Profile Information Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Two-Factor Authentication Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Two-Factor Authentication') }}</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('you can enable or disable 2-fa authentication') }}
                    </p>

                    <form method="POST" action="{{ route('user.enable_2fa') }}" class="mt-4">
                        @csrf
                        <div class="flex items-center">
                            <label for="enable_2fa" class="inline-flex items-center">
                                <input id="enable_2fa" type="checkbox" name="enable_2fa"
                                       {{ $user->two_factor_enabled ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-600">
                                    {{ $user->two_factor_enabled ? __('Disable Two-Factor Authentication') : __('Enable Two-Factor Authentication via Email') }}
                                </span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>{{ __('Update 2FA Settings') }}</x-primary-button>
                        </div>

                        @if (session('status') === '2fa-updated')
                            <p class="mt-2 text-sm text-green-600">{{ __('Two-Factor Authentication settings have been updated.') }}</p>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Delete User Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
