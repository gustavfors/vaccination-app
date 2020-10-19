<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaccination;
use App\Models\Profile;
use App\Models\Vaccine;
use Illuminate\Support\Facades\Auth;

class VaccinationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function index()
    // {
    //     $vaccines = Vaccine::all();

    //     return view('vaccines', [
    //         'vaccines' => $vaccines
    //     ]);
    // }

    public function create(Request $request)
    {
        $vaccineId = $request->vaccineId;
        $profileId = $request->profileId;

        if ($vaccineId && $profileId) {
            $profiles = Profile::where('id', $profileId)->get();
            $vaccines = vaccine::where('id', $vaccineId)->get();
        } else {
            $profiles = Profile::where('user_id', Auth::user()->id)->get();
            $vaccines = Vaccine::all();
        }

        return view('vaccinations.create', [
            'profiles' => $profiles,
            'vaccines' => $vaccines
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('access-profile', Profile::where('id', $request->profile)->firstOrFail());

        $vaccination = new Vaccination();
        $vaccination->user_id = Auth::user()->id;
        $vaccination->profile_id = $request->profile;
        $vaccination->vaccine_id = $request->vaccine;
        $vaccination->date = $request->date;
        $vaccination->expire = $vaccination->date->add(Vaccine::where('id', $request->vaccine)->first()->active_for, 'days');
        $vaccination->save();

        return redirect('/home');
    }

    public function edit(Request $request)
    {
        $vaccination = Vaccination::where('id', $request->vaccination)->firstOrFail();

        return view('vaccinations.edit', [
            'vaccination' => $vaccination,
        ]);
    }

    public function update(Request $request)
    {
        $vaccination = Vaccination::where('id', $request->vaccination)->firstOrFail();

        $this->authorize('access-profile', Profile::where('id', $vaccination->profile_id)->firstOrFail());

        $vaccination->date = $request->date;
        $vaccination->expire = $vaccination->date->add(Vaccine::where('id', $vaccination->vaccine_id)->first()->active_for, 'days');
        $vaccination->save();

        return redirect('/home');
    }

    public function destroy(Request $request)
    {
        $vaccination = Vaccination::where('id', $request->vaccination)->firstOrFail();

        $this->authorize('access-profile', Profile::where('id', $vaccination->profile_id)->firstOrFail());

        $vaccination->delete();
        return redirect('/home');
    }
}
