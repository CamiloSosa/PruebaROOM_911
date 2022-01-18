<div class="my-4">
	<x-auth-card>

		<x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-100 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ $action }}">
            @csrf

            <!-- First Name -->
            <div class="mt-4">
                <x-label for="firstname" :value="__('First Name')" />

                <x-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname', $user->firstname)" required autofocus />
            </div>

              <!-- Last Name -->
            <div class="mt-4">
                <x-label for="lastname" :value="__('Last Name')" />

                <x-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname', $user->lastname)" required autofocus />
            </div>

            <!-- Department-->
            <div class="mt-4">
                <x-label for="department" :value="__('Department')" />

                <select name="department_id" class="px-4 w-full block py-3 rounded-full">
                    @foreach($departments as $department)
                        <option value="{{$department->id}}" {{ old('department_id', $user->department_id) == $department->id ? 'selected' : '' }} >
                            {{$department->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Select --}} 
            <div class="mt-4">
                <x-label for="roles" :value="__('Roles')" />

                <select name="role_id" class="px-4 w-full block py-3 rounded-full">
                    @foreach($roles as $role)
                        <option value="{{$role->id}}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }} >
                            {{$role->name}}
                        </option>
                    @endforeach
                </select>

            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full"
                                placeholder='example@gmail.com'
                                type="email" 
                                name="email" 
                                :value="old('email', $user->email)" required />
            </div>

            @if($text == 'Create')
	            <!-- Password -->
	            <div class="mt-4">
	                <x-label for="password" :value="__('Password')" />

	                <x-input id="password" class="block mt-1 w-full"
	                                placeholder='Min. 8 characters'
	                                type="password"
	                                name="password"
	                                required autocomplete="new-password" />
	            </div>

	            <!-- Confirm Password -->
	            <div class="mt-4">
	                <x-label for="password_confirmation" :value="__('Confirm Password')" />

	                <x-input id="password_confirmation" class="block mt-1 w-full"
	                                type="password"
	                                name="password_confirmation" required />
	            </div>
	        @endif
            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    {{ $text }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</div>