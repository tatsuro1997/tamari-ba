<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Road;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $roads = Road::with('tags', 'roadImages', 'user')->orderBy('created_at', 'desc')->take(3)->get();

        return view('user.welcome', compact('roads'));
    }

    public function terms_of_service()
    {
        return view('user.terms_of_service');
    }

    public function privacy_policy()
    {
        return view('user.privacy_policy');
    }

    public function v2_welcome()
    {
        return view('v2.welcome');
    }
}
