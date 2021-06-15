<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <span style="color: red;">@error('name'){{$message}}@enderror</span>
            </div>
            <!--User Name -->
            <div>
                <x-label for="username" :value="__('UserName')" />

                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
                <span style="color: red;">@error('username'){{$message}}@enderror</span>
            </div>
            <!-- dob -->
            <div>
                <x-label for="dob" :value="__('dob')" />

                <x-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob')" required autofocus />
                <span style="color: red;">@error('dob'){{$message}}@enderror</span>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                <span style="color: red;">@error('email'){{$message}}@enderror</span>
            </div>

            <!-- Roles -->
            <div>
           
                <x-label for="role" :value="__('Role')"/>
                 <select id="role" class="block mt-1 w-full" type="text" name="role" :value="old('role')" required autofocus >
                    <option selected> Roles</option>
                    <option value="1">Admin</option>
                    <option value="2">User</option>
                    <option value="3">others</option>
                    </select>
                   
                    <span style="color: red;">@error('role'){{$message}}@enderror</span>
            </div>
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password"  class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation"  :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>