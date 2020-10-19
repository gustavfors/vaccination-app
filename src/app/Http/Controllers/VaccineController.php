<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaccine;

class VaccineController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('admin');
        $vaccines = Vaccine::all();

        return view('vaccines', [
            'vaccines' => $vaccines
        ]);
    }

    public function create(Request $request)
    {
        $this->authorize('admin');
        return view('vaccines.create');
    }

    public function edit(Request $request)
    {
        $this->authorize('admin');
        $vaccine = Vaccine::where('id', $request->vaccineId)->firstOrFail();

        return view('vaccines.edit', [
            'vaccine' => $vaccine
        ]);
    }

    public function update(Request $request)
    {
        $this->authorize('admin');
        $vaccine = Vaccine::where('id', $request->vaccineId)->firstOrFail();

        $vaccine->name = $request->vaccineName;
        $vaccine->gender = $request->vaccineGender;
        $vaccine->active_for = $request->vaccineDuration;
        $vaccine->priority = $request->vaccinePriority;
        $vaccine->age = $request->vaccineAge;
        $vaccine->save();

        return redirect('/vaccines');

    }

    public function store(Request $request)
    {
        $this->authorize('admin');
        $vaccine = new Vaccine();
        $vaccine->name = $request->vaccineName;
        $vaccine->description = 'none';
        $vaccine->gender = $request->vaccineGender;
        $vaccine->active_for = $request->vaccineDuration;
        $vaccine->priority = $request->vaccinePriority;
        $vaccine->age = $request->vaccineAge;
        $vaccine->save();

        return redirect('/vaccines');
    }

    public function destroy(Request $request)
    {
        $this->authorize('admin');
        $vaccination = Vaccine::where('id', $request->vaccineId)->firstOrFail();

        $vaccination->delete();
        return redirect('/vaccines');
    }
}
