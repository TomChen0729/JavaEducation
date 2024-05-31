<style>
    *{
        background: url('/images/start/startnoword.svg');
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
        color: #333333;
    }
</style>

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <img src="{{ asset('images/title/login.svg') }}" alt="Logo" class="mb-4">

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" style="background: #fff; border: 2px solid #5b5b5b;" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" style="background: #fff; border: 2px solid #5b5b5b;" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" style="background: #fff; border: 2px solid #5b5b5b;" />
                    <span class="ms-2 text-sm text-gray-600" style="color: #333333;">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"  style="margin-right: 20px; color: #333333; font-weight: bold;" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" style="color: #333333; font-weight: bold;" href="{{ route('register') }}">
                        {{ __('Go to Register Page!') }}
                </a>

                <x-button class="ms-4" style="background: #333333; color: #fff; box-shadow: 0 0 10px rgb(100, 100, 100);">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
