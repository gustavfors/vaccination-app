@extends('layouts.app')

@section('content')
<main class="container mx-auto flex h-screen">
    <div class="flex my-auto items-center">
        <div class="w-6/12 px-12">
            <section class="flex flex-col break-words bg-white shadow-custom rounded-lg p-16">

                <!-- <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    {{ __('Register') }}
                </header> -->

                <div class="mb-6">
                    <h3 class="font-semibold text-2xl text-gray-900 tracking-wide">Register Account</h3>
                </div>

                <form class="w-full" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="flex flex-wrap">
                        <label for="name" class="block text-gray-900 font-bold mb-2 text-sm">
                            {{ __('Name') }}:
                        </label>

                        <input id="name" type="text" class="form-input w-full px-4 py-4 rounded-lg bg-gray-200 @error('name')  border-red-500 @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="John Doe">

                        @error('name')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap mt-4">
                        <label for="email" class="block text-gray-900 font-bold mb-2 text-sm">
                            {{ __('E-Mail Address') }}:
                        </label>

                        <input id="email" type="email"
                            class="form-input w-full px-4 py-4 rounded-lg bg-gray-200 @error('email') border-red-500 @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" placeholder="john@example.com">

                        @error('email')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

         

                    <div class="relative mt-4">
                        <label for="profileGender" class="block text-gray-900 font-bold mb-2 text-sm">Gender:</label>
                        <select name="profileGender" required class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                        </div>
                    </div>

                    <label for="profileBorn" class="block text-gray-900 font-bold mb-2 text-sm mt-4">Birth Date:</label>
                    <input type="date" name="profileBorn" required class="mt-2 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

                    <label for="profilePicture" class="block text-gray-900 font-bold mb-2 text-sm mt-4">Profile Picture:</label>
                    <input type="file" name="profilePicture" required class="mt-2 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">


                    <div class="flex flex-wrap mt-4">
                        <label for="password" class="block text-gray-900 font-bold mb-2 text-sm">
                            {{ __('Password') }}:
                        </label>

                        <input id="password" type="password"
                            class="form-input w-full px-4 py-4 rounded-lg bg-gray-200 @error('password') border-red-500 @enderror" name="password"
                            required autocomplete="new-password">

                        @error('password')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap mt-4">
                        <label for="password-confirm" class="block text-gray-900 font-bold mb-2 text-sm">
                            {{ __('Confirm Password') }}:
                        </label>

                        <input id="password-confirm" type="password" class="form-input w-full px-4 py-4 rounded-lg bg-gray-200"
                            name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="flex flex-wrap mt-4">
                        <button type="submit"
                            class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-green-600 hover:bg-green-700 sm:py-4">
                            {{ __('Register') }}
                        </button>

                        <p class="w-full text-xs text-center text-gray-700 my-6 sm:text-sm sm:my-8">
                            {{ __('Already have an account?') }}
                            <a class="text-green-600 hover:text-green-700 no-underline hover:underline" href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        </p>
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