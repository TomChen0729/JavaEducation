<style>
    *{
        background: url('/images/start/startnoword.svg');
        background-repeat: no-repeat;
        background-position: top;
        background-attachment: fixed;
        background-size: cover;
        color: #333333;
    }
</style>

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="/images/title/register.svg" alt="">
        </x-slot>

        <div class="mb-4 text-sm text-gray-600" style="font-size: 15px; color: #333333;">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <img src="{{ asset('images/title/forgetpwd.svg') }}" alt="Logo" class="mb-4">

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" style="background: #fff; border: 2px solid #5b5b5b;" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button style="background: #333333; color: #fff; box-shadow: 0 0 10px rgb(100, 100, 100);">
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
