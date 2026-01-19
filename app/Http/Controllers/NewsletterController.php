<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function newsletterStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email'
        ]);

        Newsletter::create([
            'email' => $request->email
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Thank you for subscribing!'
        ]);
    }    
}
