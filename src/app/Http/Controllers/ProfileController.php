<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->name = $request->profileName;
        $profile->born = $request->profileBorn;
        $profile->gender = $request->profileGender;
        $profile->avatar = $request->profilePicture->store('avatars');
        
        $profile->save();

        return redirect('/family');
    }

    public function edit(Request $request)
    {
        $profile = Profile::where('id', $request->profileId)->firstOrFail();

        return view('profiles.edit', [
            'profile' => $profile
        ]);
    }

    public function update(Request $request)
    {
        $profile = Profile::where('id', $request->profileId)->firstOrFail();

        $this->authorize('access-profile', $profile);

        $profile->name = $request->profileName;
        $profile->born = $request->profileBorn;
        $profile->gender = $request->profileGender;
        if ($request->profilePicture) {
            $profile->avatar = $request->profilePicture->store('avatars');
        }
        $profile->save();

        return redirect('/family');
    }

    public function destroy(Request $request)
    {
        $profile = Profile::where('id', $request->profileId)->firstOrFail();

        $this->authorize('access-profile', $profile);

        $profile->delete();
        return redirect('/family');
    }
}
