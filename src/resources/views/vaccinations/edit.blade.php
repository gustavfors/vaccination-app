@extends('layouts.dashboard')

@section('content')


<section class="mt-12">

    <div class="w-6/12 mx-auto bg-white rounded-lg py-8 px-10 text-gray-900 shadow-custom">
        <div>
            <h3 class="text-lg font-medium mb-1">Editing {{ $vaccination->profile->name }}'s {{ $vaccination->vaccine->name }} vaccination</h3>
            <p class="text-gray-600 text-sm">Today: Monday, Sep 20</p>
        </div>
        
        <form action="/vaccinations" method="POST" class="mt-6">
            @csrf
            @method('PATCH')
            <div class="mt-4">
                <input type="hidden" value="{{ $vaccination->id }}" name="vaccination">
                <label for="date" class="block text-gray-900 font-bold mb-2 text-sm">Vaccination Date:</label>
                <input type="date" required name="date" id="date" class="mt-2 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value="{{ $vaccination->date->isoFormat('YYYY-MM-DD') }}">
            </div>
            <button type="submit" class="mt-4 w-full select-none font-medium whitespace-no-wrap p-3 rounded-lg text-sm leading-normal no-underline text-gray-100 bg-green-600 hover:bg-green-700 sm:py-4">
                Update Vaccination
            </button>

        </form>

    </div>

</section>

@endsection