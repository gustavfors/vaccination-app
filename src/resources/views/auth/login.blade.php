@extends('layouts.app')

@section('content')
<main class="container mx-auto flex h-screen">
    <div class="flex my-auto items-center">
       
        <div class="w-6/12 px-12">
            
            <section class="flex flex-col break-words bg-white shadow-custom rounded-lg p-16">

                <!-- <header class="font-semibold bg-gray-900 text-white py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    {{ __('Login') }}
                </header> -->

                <div class="mb-6">
                    <h3 class="font-semibold text-2xl text-gray-900 tracking-wide">Welcome To Healthzone</h3>
                </div>
                
           

                <form class="w-full" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="flex flex-wrap">
                        <label for="email" class="block text-gray-900 font-bold mb-2 text-sm">
                            <!-- {{ __('E-Mail Address') }}: -->
                            {{ __('Email') }}:
                        </label>

                        <input id="email" type="email"
                            class="form-input w-full px-4 py-4 rounded-lg bg-gray-200 @error('email') border-red-500 @enderror" name="email" autocomplete="off" value="{{ old('email') }}" required>

                        @error('email')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap mt-4">
                        <label for="password" class="block block text-gray-900 font-bold mb-2 text-sm">
                            {{ __('Password') }}:
                        </label>

                        <input id="password" type="password" class="form-input w-full px-4 py-4 bg-gray-200 rounded-lg @error('password') border-red-500 @enderror" name="password" autocomplete="off" required>

                        @error('password')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- <div class="flex items-center mt-4">
                        <label class="inline-flex items-center text-sm text-gray-700" for="remember">
                            <input type="checkbox" name="remember" id="remember" class="form-checkbox"
                                {{ old('remember') ? 'checked' : '' }}>
                            <span class="ml-2">{{ __('Remember Me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                        <a class="text-sm text-green-600 hover:text-green-700 whitespace-no-wrap no-underline hover:underline ml-auto font-semibold"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                    </div> -->

                    <div class="flex flex-wrap mt-6">
                        <button type="submit"
                        class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-green-600 hover:bg-green-700 sm:py-4">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('register'))
                        <p class="w-full text-xs text-center text-gray-700 mt-4">
                            {{ __("Don't have an account?") }}
                            <a class="text-green-600 hover:text-green-700 no-underline hover:underline" href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        </p>
                        @endif
                    </div>
                </form>

            </section>
        </div>

         <div class="w-6/12 px-12">
            <img src="/img/test.png" alt="">
        </div>
    </div>
</main>
@endsection
