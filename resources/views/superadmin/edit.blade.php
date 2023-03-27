<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">{{ $user->name }}</h3>
                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4 ">
                            <label for="name" class="block text-black dark:text-gray-300 font-medium mb-2">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-input rounded-md shadow-sm w-full @error('name') border-red-500 @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
                            @error('name')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-input rounded-md shadow-sm w-full @error('email') border-red-500 @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
                            @error('email')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-input rounded-md shadow-sm w-full @error('password') border-red-500 @enderror" name="password" autocomplete="new-password">
                            @error('password')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">{{ __('Confirm Password') }}</label>
                            <input id="password_confirmation" type="password" class="form-input rounded-md shadow-sm w-full" name="password_confirmation" autocomplete="new-password">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
