@extends('layouts.dashboard')

@section('content')

<section class="flex mt-12">

    <div class="w-4/12 bg-white rounded-lg py-8 px-10 text-gray-900 mr-6 shadow-custom flex flex-col">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-medium mb-1">Add Profile</h3>
              
            </div>
        </div>
        
        <form action="/profiles" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            <label for="profileName" class="block text-gray-900 font-bold mb-2 text-sm">Name:</label>
            <input type="text" name="profileName" placeholder="John Doe" required class="mt-2 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

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

            <button type="submit" class="mt-6 w-full select-none font-medium whitespace-no-wrap p-3 rounded-lg text-sm leading-normal no-underline text-gray-100 bg-green-600 hover:bg-green-700 sm:py-4">
                Add Profile
            </button>

        </form>
    </div>

    <div class="w-8/12 bg-white rounded-lg py-8 px-10 text-gray-900 ml-6 shadow-custom flex flex-col">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-medium mb-1">Family Overview</h3>
            </div>
        </div>

        <table class="w-full text-right mt-6">

            <tr class="font-medium text-sm">
                <th class="text-left">Name</th>
                <th class="text-right">Age</th>
                <th>Action</th>
            </tr>

            @foreach ($user->profiles as $profile)
                <tr class="font-medium text-sm">
                    <td class="text-left flex items-center"><img src="/storage/{{ $profile->avatar }}" style="height:35px; width: 35px;" class="rounded-full mr-3 profile-picture">{{ $profile->name }}</td>
                    <td class="text-right">{{ $profile->born->age }}</td>
                    <td>
                        <div class="flex">
                        <form action="/profiles/edit" method="POST" class="ml-auto">
                            @csrf
                            <button type="submit" value="{{ $profile->id }}" name="profileId" class="material-icons text-xl">edit</button>
                        </form>
                        <form action="/profiles" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" value="{{ $profile->id }}" name="profileId" class="material-icons ml-1 text-xl">delete</button>
                        </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            
        </table>
     
    </div>
</section>


@endsection
   