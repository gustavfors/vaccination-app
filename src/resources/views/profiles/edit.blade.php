@extends('layouts.dashboard')

@section('content')


<section class="mt-12">

    <div class="w-6/12 mx-auto bg-white rounded-lg py-8 px-10 text-gray-900 shadow-custom">
        <div>
            <h3 class="text-lg font-medium mb-1">Editing {{ $profile->name }}'s profile</h3>
            <p class="text-gray-600 text-sm">Today: Monday, Sep 20</p>
        </div>
        
        <form action="/profiles" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            @method('PATCH')
            <input type="hidden" name="profileId" value="{{ $profile->id }}">
            <label for="profileName" class="block text-gray-900 font-bold mb-2 text-sm">Name:</label>
            <input type="text" name="profileName" required value="{{ $profile->name }}" class="mt-2 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

            <div class="relative mt-4">
                <label for="profileGender" class="block text-gray-900 font-bold mb-2 text-sm">Gender:</label>
                <select name="profileGender" required class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="female" @if ($profile->gender == 'female') selected @endif>Female</option>
                    <option value="male" @if ($profile->gender == 'male') selected @endif>Male</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                </div>
            </div>

            <label for="profileBorn" class="block text-gray-900 font-bold mb-2 text-sm mt-4">Birth Date:</label>
            <input type="date" name="profileBorn" required value="{{ $profile->born->isoFormat('YYYY-MM-DD') }}" class="mt-2 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

            <label for="profilePicture" class="block text-gray-900 font-bold mb-2 text-sm mt-4">Profile Picture:</label>
            <div class="flex items-center justify-between">
                <input type="file" name="profilePicture" class="mt-2 w-9/12 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <img src="/storage/{{ $profile->avatar }}" alt="avatar" class="ml-6 w-2/12" style="max-width: 100%;">
            </div>
            <button type="submit" class="mt-6 w-full select-none font-medium whitespace-no-wrap p-3 rounded-lg text-sm leading-normal no-underline text-gray-100 bg-green-600 hover:bg-green-700 sm:py-4">
                Update Profile
            </button>

        </form>

    </div>

</section>

@endsection