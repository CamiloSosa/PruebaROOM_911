<x-app-layout>
	<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center; height: 2vw;">
            Access Room
        </h2>
    </x-slot>

	<div class="my-4">
        <x-auth-card>

            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-100 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ url('/access-room') }}">
                @csrf

                <!-- First Name -->
                <div class="mt-4">
                    <x-label for="user_id" :value="__('User ID')" />

                    <input id="user_id" class="form-control" type="number" name="user_id" :value="old('user_id')" required autofocus />
                </div>

                  <!-- Last Name -->
                <div class="mt-4">
                    <x-label for="user_pin" :value="__('PIN')" />

                    <x-input id="user_pin" class="block mt-1 w-full" type="text" name="user_pin" :value="old('user_pin')" required autofocus />
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-info">Enter</button>
                </div>
            </form>
        </x-auth-card>
    </div>

</x-app-layout>
