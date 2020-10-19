@extends('layouts.dashboard')

@section('content')

<section class="flex mt-12">

    <div class="w-4/12 bg-white rounded-lg py-8 px-10 text-gray-900 mr-6 shadow-custom flex flex-col">
        <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium mb-1">{{ $today->toFormattedDateString() }}</h3>
                    <p class="text-gray-600 text-sm">
                    
                    Coming up
                    @if ($eventTime == 30)
                        this month
                    @elseif ($eventTime == 90)
                        this quarter
                    @elseif ($eventTime == 180)
                        this half year
                    @elseif ($eventTime == 365)
                        this year
                    @endif
                    </p>
                </div>
                <form action="/home" method="GET">
                    <div class="relative">
                        @if ( isset($_GET['vaccinations']) )
                            <input type="hidden" name="vaccinations" value="{{ $_GET['vaccinations'] }}">
                        @endif

                        @if ( isset($_GET['vaccinationProfile']) )
                            <input type="hidden" name="vaccinationProfile" value="{{ $_GET['vaccinationProfile'] }}">
                        @endif

                        @if ( isset($_GET['recommendationPriority']) )
                            <input type="hidden" name="recommendationPriority" value="{{ $_GET['recommendationPriority'] }}">
                        @endif
                        <select class="block text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded-lg leading-tight" onchange="this.form.submit()" name="eventTime">
                           <option>Next {{ $eventTime }} days</option>
                                @if ($eventTime != 30)
                                <option value="30">Next 30 days</option>
                                @endif
                                @if ($eventTime != 90)
                                <option value="90">Next 90 days</option>
                                @endif
                                @if ($eventTime != 180)
                                <option value="180">Next 180 days</option>
                                @endif
                                @if ($recommendationPriority != 365)
                                <option value="365">Next 360 days</option>
                                @endif
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </form>
            </div>
        
        <div class="mt-6">

            @foreach ($events as $event)
                @if ($event->type === 'e')
                    <div class="timeline flex items-start mb-8">
                        <span class="material-icons bg-red-300 text-red-700 p-2 rounded-full">error_outline</span>
                        <div class="ml-4 pt-3">
                            <h4 class="text-sm mb-0 leading-tight font-semibold text-gray-900">In {{ $event->time->diffForHumans(null, true) }}</h4>
                            <p class="text-gray-600 text-xs" style="max-width: 180px;">{{ $event->profile->name }}'s {{ $event->vaccine->name }} Vaccination Expires</p>
                        </div>
                    </div>
                @else
                    <div class="timeline flex items-start mb-8">
                        <span class="material-icons bg-green-300 text-green-700 p-2 rounded-full">schedule</span>
                        <div class="ml-4 pt-3">
                            <h4 class="text-sm mb-0 leading-tight font-semibold text-gray-900">In {{ $event->time->diffForHumans(null, true) }}</h4>
                            <p class="text-gray-600 text-xs" style="max-width: 180px;">{{ $event->profile->name }}'s {{ $event->vaccine->name }} Vaccination is Scheduled</p>
                        </div>
                    </div>
                @endif
            @endforeach

            
        </div>
        <div class="mt-auto">
            {{ $events->appends($_GET)->links() }}
        </div>
    </div>

    <div class="w-8/12 bg-white rounded-lg py-8 px-10 text-gray-900 ml-6 shadow-custom flex flex-col">
        <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium mb-1">Recommendations</h3>
                    <p class="text-gray-600 text-sm">Consider The Following</p>
                </div>
                <div class="flex">
                    <form action="/home" method="GET" class="mr-4">
                        <div class="relative">
                            @if ( isset($_GET['page']) )
                                <input type="hidden" name="page" value="{{ $_GET['page'] }}">
                            @endif

                            @if ( isset($_GET['events']) )
                                <input type="hidden" name="events" value="{{ $_GET['events'] }}">
                            @endif

                            @if ( isset($_GET['recommendationProfile']) )
                                <input type="hidden" name="recommendationProfile" value="{{ $_GET['recommendationProfile'] }}">
                            @endif

                            @if ( isset($_GET['vaccinationProfile']) )
                                <input type="hidden" name="vaccinationProfile" value="{{ $_GET['vaccinationProfile'] }}">
                            @endif

                            @if ( isset($_GET['eventTime']) )
                                <input type="hidden" name="eventTime" value="{{ $_GET['eventTime'] }}">
                            @endif
                            <select class="block text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded-lg leading-tight" onchange="this.form.submit()" name="recommendationPriority">
                                <option>{{ ucFirst($recommendationPriority) }}</option>
                                @if ($recommendationPriority != 'high')
                                <option value="high">High</option>
                                @endif
                                @if ($recommendationPriority != 'medium')
                                <option value="medium">Medium</option>
                                @endif
                                @if ($recommendationPriority != 'low')
                                <option value="low">Low</option>
                                @endif
                                @if ($recommendationPriority != 'all')
                                <option value="all">All</option>
                                @endif
                               
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </form>
                    
                    <form action="/home" method="GET">
                        <div class="relative">
                            @if ( isset($_GET['vaccinations']) )
                                <input type="hidden" name="vaccinations" value="{{ $_GET['vaccinations'] }}">
                            @endif

                            @if ( isset($_GET['events']) )
                                <input type="hidden" name="events" value="{{ $_GET['events'] }}">
                            @endif

                            @if ( isset($_GET['vaccinationProfile']) )
                                <input type="hidden" name="vaccinationProfile" value="{{ $_GET['vaccinationProfile'] }}">
                            @endif

                            @if ( isset($_GET['recommendationPriority']) )
                                <input type="hidden" name="recommendationPriority" value="{{ $_GET['recommendationPriority'] }}">
                            @endif

                            @if ( isset($_GET['eventTime']) )
                                <input type="hidden" name="eventTime" value="{{ $_GET['eventTime'] }}">
                            @endif
                            <select class="block text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded-lg leading-tight" onchange="this.form.submit()" name="recommendationProfile">
                                <option>{{ ucFirst($recommendationProfileName) }}</option>
                                @foreach ($recommendationProfiles as $profile)
                                    <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                                @endforeach
                                @if ($recommendationProfileName != 'everyone')
                                    <option value="everyone">Everyone</option>
                                @endif
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        <table class="w-full text-right mt-6">

            <tr class="text-sm">
                <th class="text-left">Name</th>
                <th>Vaccine</th>
                <th>Priority</th>
                <th>Action</th>
            </tr>
            @forelse ($recommendations as $recommendation)
            <tr class="font-medium text-sm">
                <td class="text-left flex items-center"><img src="/storage/{{ $recommendation['profile_avatar'] }}" style="height:35px; width: 35px;" class="rounded-full mr-3 profile-picture">{{ $recommendation['profile_name'] }}</td>
                <td>{{ $recommendation['vaccine_name'] }}</td>

                @if ($recommendation['priority'] === 'high')
                <td><span class="bg-red-300 px-3 py-1 rounded-full text-xs text-red-700">{{ $recommendation['priority'] }}</span></td>
                @elseif ($recommendation['priority'] === 'medium')
                <td><span class="bg-yellow-300 px-3 py-1 rounded-full text-xs text-yellow-700">{{ $recommendation['priority'] }}</span></td>
                @elseif ($recommendation['priority'] === 'low')
                <td><span class="bg-blue-300 px-3 py-1 rounded-full text-xs text-blue-700">{{ $recommendation['priority'] }}</span></td>
                @endif
                <td>
                    <form action="/vaccinations/create" method="POST">
                    @csrf
                        <input type="hidden" name="vaccineId" value="{{ $recommendation['vaccine_id'] }}">
                        <input type="hidden" name="profileId" value="{{ $recommendation['profile_id'] }}">
                        <button type="submit" class="material-icons text-xl">book_online</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr class="font-medium text-sm">
                <td class="text-left border-0 text-gray-900">No recommendations...</td>
            </tr>
            @endforelse
            
        </table>
        <div class="mt-5" style="padding: 0 15px;">    
            
            {{ $recommendations->appends($_GET)->links() }}
        </div>

        
    </div>
</section>

<section class="mt-12">
        <div class="w-full bg-white rounded-lg py-8 px-10 text-gray-900 shadow-custom flex flex-col">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium mb-1">Vaccinations Overview</h3>
                    <p class="text-gray-600 text-sm">Showing results for everyone</p>
                </div>
                <div class="flex">
                    <form action="/home" method="GET">
                        <div class="relative">
                            @if ( isset($_GET['page']) )
                                <input type="hidden" name="page" value="{{ $_GET['page'] }}">
                            @endif

                            @if ( isset($_GET['events']) )
                                <input type="hidden" name="events" value="{{ $_GET['events'] }}">
                            @endif

                            @if ( isset($_GET['recommendationProfile']) )
                                <input type="hidden" name="recommendationProfile" value="{{ $_GET['recommendationProfile'] }}">
                            @endif

                            @if ( isset($_GET['recommendationPriority']) )
                                <input type="hidden" name="recommendationPriority" value="{{ $_GET['recommendationPriority'] }}">
                            @endif

                            @if ( isset($_GET['eventTime']) )
                                <input type="hidden" name="eventTime" value="{{ $_GET['eventTime'] }}">
                            @endif
                            <select class="block text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded-lg leading-tight" onchange="this.form.submit()" name="vaccinationProfile">
                                <option>{{ ucFirst($vaccinationProfileName) }}</option>
                                @foreach ($vaccinationProfiles as $profile)
                                    <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                                @endforeach
                                @if ($vaccinationProfileName != 'everyone')
                                    <option value="everyone">Everyone</option>
                                @endif
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div>
                <table class="w-full text-right mt-6">
            
                    <tr class="text-sm">
                        <th class="text-left">Name</th>
                        <th>Vaccine</th>
                        <th>Vaccination Date</th>
                        <th>Expires In</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    @forelse ( $vaccinations as $vaccination)

                    <tr class="font-medium text-sm">
                        <td class="text-left flex items-center"><img src="/storage/{{ $vaccination->profile->avatar }}" style="height:35px; width: 35px;"
                                class="rounded-full mr-3 profile-picture">{{ $vaccination->profile->name }}</td>
                        <td>{{ $vaccination->vaccine->name }}</td>
                        <td>{{ $vaccination->date->isoFormat('YYYY-MM-DD') }}</td>
                        

                        @if ( $today > $vaccination->expire)
                            <td>{{ $vaccination->expire->diffForHumans(null, true)}} ago</td>
                            <td><span class="bg-red-300 px-3 py-1 rounded-full text-xs text-red-700">Expired</span></td>
                        @elseif ( $today < $vaccination->date )
                            <td>N/A</td>
                            <td><span class="bg-yellow-300 px-3 py-1 rounded-full text-xs text-yellow-700">Scheduled</span></td>
                        @else
                            <td>{{ $vaccination->expire->diffForHumans(null, true)  }}</td>
                            <td><span class="bg-green-300 px-3 py-1 rounded-full text-xs text-green-700">Active</span></td>
                        @endif
                        <td>
                            <div class="flex">
                            <form action="/vaccinations/edit" method="POST" class="ml-auto">
                                @csrf
                                <button type="submit" value="{{ $vaccination->id }}" name="vaccination" class="material-icons text-xl">edit</button>
                            </form>
                            <form action="/vaccinations" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" value="{{ $vaccination->id }}" name="vaccination" class="material-icons ml-1 text-xl">delete</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="font-medium text-sm">
                        <td class="text-left border-0">No vaccinations yet...</td>
                    </tr>
                    @endforelse
            
                </table>
            </div>
            <div class="mt-5" style="padding: 0 15px;">
                {{ $vaccinations->appends($_GET)->links() }}
            </div>
        </div>
</section>
@endsection
   