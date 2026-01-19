<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;

class CityController extends Controller
{
    public function states()
    {
        $states = State::orderBy('name', 'asc')->get();

        $countryName = 'India';

        return view('backend.pages.location.states-index', compact('states', 'countryName'));
    }

    public function cities()
    {
        $cities = City::with('state')
            ->orderBy('city', 'asc')
            ->get();

        return view('backend.pages.location.cities-index', compact('cities'));
    }
}
