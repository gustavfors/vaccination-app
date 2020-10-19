@extends('layouts.dashboard')

@section('content')


<section class="mt-12">

    <div class="w-6/12 mx-auto bg-white rounded-lg py-8 px-10 text-gray-900 shadow-custom">
        <div>
            <h3 class="text-lg font-medium mb-1">Add Vaccine</h3>
            <p class="text-gray-600 text-sm">Today: Monday, Sep 20</p>
        </div>
        
        <form action="/vaccines" method="POST" class="mt-6">
            @csrf
            <label for="vaccineName" class="block text-gray-900 font-bold mb-2 text-sm">Vaccine Name:</label>
            <input type="text" required name="vaccineName" class="mt-2 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

            <div class="relative mt-4">
                <label for="vaccineGender" class="block text-gray-900 font-bold mb-2 text-sm">Gender:</label>
                <select required name="vaccineGender" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="all">All</option>
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                </div>
            </div>

            <label for="vaccineDuration" class="block text-gray-900 font-bold mb-2 text-sm mt-4">Active For (days):</label>
            <input type="number" required name="vaccineDuration" class="mt-2 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

            <label for="vaccineAge" class="block text-gray-900 font-bold mb-2 text-sm mt-4">Minimum Age Recommendation (0 for all ages):</label>
            <input type="number" required name="vaccineAge" class="mt-2 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

            <div class="relative mt-4">
                <label for="vaccinePriority" class="block text-gray-900 font-bold mb-2 text-sm">Vaccine:</label>
                <select required name="vaccinePriority" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                </div>
            </div>

            <button type="submit" class="mt-6 w-full select-none font-medium whitespace-no-wrap p-3 rounded-lg text-sm leading-normal no-underline text-gray-100 bg-green-600 hover:bg-green-700 sm:py-4">
                Add Vaccine
            </button>

        </form>

    </div>

</section>

@endsection