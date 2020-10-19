<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Vaccination;
use App\Models\Vaccine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        //get variables
        $page = $request->page ?? 1;

        $user = Auth::user();

        $vaccinationProfile = $request->vaccinationProfile ?? 'everyone';
        $vaccinationProfileName = 'everyone';

        $recommendationProfile = $request->recommendationProfile ?? 'everyone';
        $recommendationProfileName = 'everyone';

        $recommendationPriority = $request->recommendationPriority ?? 'all';

        $eventTime = $request->eventTime ?? 30;

        $validatedTimes = [30, 90, 180, 365];

        if (!in_array($eventTime, $validatedTimes)) {
            $eventTime = 30;
        }

        //profiles belonging to the user
        $userProfileIds = ['everyone'];
        foreach($user->profiles as $profile) {
            array_push($userProfileIds, $profile->id);
        }

        //users can only access their own profiles
        if (!in_array($vaccinationProfile, $userProfileIds)) {
            $vaccinationProfile = 'everyone';
        }

        //users can only access their own recommendations
        if (!in_array($recommendationProfile, $userProfileIds)) {
            $recommendationProfile = 'everyone';
        }


        $recommendations = [];

        foreach (Vaccine::all() as $vaccine) {
            
            foreach (Profile::where('user_id', $user->id)->get() as $profile) {
                
                if ($vaccine->age <= Carbon::parse($profile->born)->age) {

                    if ($vaccine->gender == $profile->gender || $vaccine->gender === "all") {
                            
                        // if (!$profile->vaccinations->where('vaccine_id', $vaccine->id)->first() || $profile->vaccinations->where('vaccine_id', $vaccine->id)->first()->expire < today()) {
                        if (!$profile->vaccinations->where('vaccine_id', $vaccine->id)->first() || $profile->vaccinations->where('vaccine_id', $vaccine->id)->first()->expire < today()) {

                            array_push($recommendations, [
                                "profile_name" => $profile->name,
                                "profile_id" => $profile->id,
                                "profile_avatar" => $profile->avatar,
                                "vaccine_id" => $vaccine->id,
                                "vaccine_name" => $vaccine->name,
                                "priority" => $vaccine->priority
                            ]);

                        }
                    }
                }
            }
        }

        $recommendations = collect($recommendations);

        if ($recommendationPriority != 'all') {
            $recommendations = $recommendations->where('priority', $recommendationPriority);
        }

        if ($recommendationProfile != 'everyone') {
            $recommendations = $recommendations->where('profile_id', $recommendationProfile);
            $recommendationProfileName = Profile::where('id', $recommendationProfile)->first()->name;
            $recommendationProfiles = Profile::where('user_id', $user->id)->where('id', '!=', $recommendationProfile)->get();
        } else {
            $recommendationProfiles = Profile::where('user_id', $user->id)->get();
        }

        $perPage = 4;

        $paginator = new LengthAwarePaginator($recommendations->forPage($page, $perPage), $recommendations->count(), $perPage, $page, ['path'=>url('home')]);

        $events = Vaccination::selectRaw('*, (`expire`) AS `time`, ("e") AS `type`')->whereRaw('`user_id` = '.$user->id.' AND `expire` < (CURDATE() + INTERVAL '.$eventTime.' DAY) AND `expire` > CURDATE()')
                    ->union(Vaccination::selectRaw('*, (`date`) AS `time`, ("s") AS `type`')->whereRaw('`user_id` = '.$user->id.' AND `date` > CURDATE() AND `date` < (CURDATE() + INTERVAL '.$eventTime.' DAY)'))
                    ->orderByRaw('`TIME` ASC')
                    ->paginate(3, ['*'], 'events');

        if ($vaccinationProfile == 'everyone') {
            $vaccinations = Vaccination::where('user_id', $user->id)->orderBy('created_at', 'DESC')->paginate(6, ['*'], 'vaccinations');
            $vaccinationProfiles = Profile::where('user_id', $user->id)->get();
        } else {
            $vaccinations = Vaccination::where('user_id', $user->id)->where('profile_id', $vaccinationProfile)->orderBy('created_at', 'DESC')->paginate(6, ['*'], 'vaccinations');
            $vaccinationProfileName = Profile::where('id', $vaccinationProfile)->first()->name;
            $vaccinationProfiles = Profile::where('user_id', $user->id)->where('id', '!=', $vaccinationProfile)->get();
        }

        return view('start', [
            'events' => $events,
            'vaccinations' => $vaccinations,
            'today' => today(),
            'user' => Auth::user(),
            'vaccines' => Vaccine::all(),
            'recommendations' => $paginator,
            'vaccinationProfile' => $vaccinationProfile,
            'vaccinationProfileName' => $vaccinationProfileName,
            'vaccinationProfiles' => $vaccinationProfiles,
            'recommendationProfile' => $recommendationProfile,
            'recommendationProfileName' => $recommendationProfileName,
            'recommendationProfiles' => $recommendationProfiles,
            'recommendationPriority' => $recommendationPriority,
            'eventTime' => $eventTime
        ]);
    }
}
