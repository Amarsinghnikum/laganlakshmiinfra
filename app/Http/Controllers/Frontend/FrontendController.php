<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.pages.index');
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function properties()
    {
        return view('frontend.pages.properties');
    }

    public function propertyDetails()
    {
        return view('frontend.pages.property-details');
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function privacyPolicy()
    {
        return view('frontend.pages.privacy-policy');
    }

    public function termsConditions()
    {
        return view('frontend.pages.terms-conditions');
    }

    public function dataSafety()
    {
        return view('frontend.pages.data-safety');
    }

    public function dataDeletion()
    {
        return view('frontend.pages.data-deletion');
    }
}
