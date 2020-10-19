@extends('layouts.dashboard')

@section('content')

<section class="flex mt-12">

    <div class="w-4/12 bg-white rounded-lg py-8 px-10 text-gray-900 mr-6 shadow-custom flex flex-col">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-medium mb-1">Add Vaccine</h3>
            </div>
        </div>
        
        <form action="/vaccines" method="POST" class="mt-6">
            @csrf
            <label for="vaccineName" class="block text-gray-900 font-bold mb-2 text-sm">Vaccine Name:</label>
            <input type="text" required name="vaccineName" class="mt-2 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

            <div class="relative mt-4">
                <label for="vaccineGender" class="block text-gray-900 font-bold mb-2 text-sm">Gender:</label>
                <select name="vaccineGender" required class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="all">All</option>
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                </div>
            </div>

            <label for="vaccineDuration" class="block text-gray-900 font-bold mb-2 text-sm mt-4">Days Active:</label>
            <input type="number" required name="vaccineDuration" class="mt-2 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

            <label for="vaccineAge" class="block text-gray-900 font-bold mb-2 text-sm mt-4">Minimum Age Recommendation (0 for all ages):</label>
            <input type="number" required name="vaccineAge" class="mt-2 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

            <div class="relative mt-4">
                <label for="vaccinePriority" class="block text-gray-900 font-bold mb-2 text-sm">Priority:</label>
                <select name="vaccinePriority" required class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
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

    <div class="w-8/12 bg-white rounded-lg py-8 px-10 text-gray-900 ml-6 shadow-custom flex flex-col">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-medium mb-1">Vaccines Overview</h3>
            </div>
        </div>

        <table class="w-full text-right mt-6">

            <tr class="font-medium text-sm">
                <th class="text-left">Vaccine Name</th>
                <th class="text-right">Days Active</th>
                <th class="text-right">Priority</th>
                <th class="text-right">Gender</th>
                <th>Action</th>
            </tr>

            @foreach ($vaccines as $vaccine)
                <tr class="font-medium text-sm">
                    <td class="text-left items-center">{{ $vaccine->name }}</td>
                    <td class="text-right">{{ $vaccine->active_for }}</td>
                     @if ($vaccine->priority === 'high')
                    <td><span class="bg-red-300 px-3 py-1 rounded-full text-xs text-red-700">{{ $vaccine->priority }}</span></td>
                    @elseif ($vaccine->priority === 'medium')
                    <td><span class="bg-yellow-300 px-3 py-1 rounded-full text-xs text-yellow-700">{{ $vaccine->priority }}</span></td>
                    @elseif ($vaccine->priority === 'low')
                    <td><span class="bg-blue-300 px-3 py-1 rounded-full text-xs text-blue-700">{{ $vaccine->priority }}</span></td>
                    @endif
                    <td class="text-right">{{ $vaccine->gender }}</td>
                    <td>
                        <div class="flex">
                            <form action="/vaccines/edit" method="POST" class="ml-auto">
                                @csrf
                                <button type="submit" value="{{ $vaccine->id }}" name="vaccineId" class="material-icons text-xl">edit</button>
                            </form>
                            <form action="/vaccines" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" value="{{ $vaccine->id }}" name="vaccineId" class="material-icons ml-1 text-xl">delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach

        </table>
     
    </div>
</section>


@endsection
   